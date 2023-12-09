<?php
include 'connect.php';
session_start();
$arr_response = ["error"=>1,"msj"=>"","clientes"=>[]];
if(!isset($_SESSION['ide']) || $_SESSION['ide'] == NULL){
    $arr_response["msj"]="no tiene sesión";
}
else{
     
    //$tipo = $_POST['tipo'];
    $operador = $_SESSION['ide'];
    $user_lng = $_POST['lng'];
    $user_lat = $_POST['lat'];
    $distancia = isset($_POST['distancia'])?$_POST['distancia']:0.1;
    $timestamp = strtotime("tomorrow");
    //$fecha_gestion = date('Y-m-d',$timestamp);
    $fecha_gestion = date('Y-m-d');
    $arr_codigos = [];
    $script = "SELECT dc.*, ga.fecha_acepto, ga.hora_acepto,MAX(STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y')) AS fecha,max(ga.primaryk) as p,
    (  6371 * acos ( cos ( radians($user_lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($user_lng) ) + 
    sin ( radians($user_lat) ) * sin( radians( lat ) ) ) ) AS distance
        FROM DatosClientes as dc JOIN Gestion_acepto AS ga ON dc.codigo = ga.codigo_cliente WHERE 
        STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y') <= DATE_SUB(NOW(), INTERVAL 3 MONTH)
        GROUP BY ga.primaryk
        HAVING distance <= ".$distancia." ORDER BY p DESC LIMIT 50";
    
    /*18082021
    $script = "SELECT dc.*, ga.fecha_acepto, ga.hora_acepto,MAX(STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y')) AS fecha,max(ga.primaryk) as p,
    (  6371 * acos ( cos ( radians($user_lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($user_lng) ) + 
    sin ( radians($user_lat) ) * sin( radians( lat ) ) ) ) AS distance
        FROM DatosClientes as dc JOIN Gestion_acepto AS ga ON dc.codigo = ga.codigo_cliente WHERE 
        STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y') <= '$fecha_gestion'
        GROUP BY ga.primaryk
        HAVING distance <= ".$distancia." ORDER BY p DESC LIMIT 50";
    
    */    
        
    $descripcion = '';
    $result = mysqli_query($enlace, $script);
    $arr_response["q"] = $script;
    if(!$result){
        $arr_response["msj"] = "No se econtraron clientes cercanos ";
        
    }
    else{
        while ($fila = mysqli_fetch_array($result)) {
            if(in_array($fila['codigo'],$arr_codigos))
            continue;
            
            $sql = "SELECT primaryk, STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y')  AS fecha FROM Gestion_acepto WHERE codigo_cliente = '".$fila['codigo']."' AND
            STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') >= '$fecha_gestion' ORDER BY STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') ";
            $res=mysqli_query($enlace, $sql);
            if( $res ){
                $arr_fechas = [];
                while ($filas_acepto = mysqli_fetch_array($res)) {
                
                    $arr_fechas[] = $filas_acepto['fecha'];
                }
            }
            $data['ultimas_fechas'] = $arr_fechas;
            $arr_codigos[] = $fila['codigo'];
            $data['nombre_completo'] = $fila['nombre_completo'];
            $data['codigo'] = $fila['codigo'];
            $data['distancia'] = $fila['distancia'];
            $data['Datos_factua'] = $fila['Datos_factua'];
            $data['direccion'] = $fila['direccion'];
            $data['estado'] = $fila['estado'];
            $data['fecha_hora'] = $fila['fecha'].' '.$fila['hora_acepto'];
            $data['hora_acepto'] = $fila['hora_acepto'];
            $data['fecha_acepto'] = $fila['fecha_acepto'];
            $data['lat'] = $fila['lat'];
            $data['lng'] = $fila['lng'];
            $data['coordenadas'] = $fila['coordenadas'];
            
            $arr_response["clientes"][] = $data;
            $arr_fechas = [];
        }
       $arr_response["error"] = false;
    }
    include 'QuitDB.php';
    
    echo json_encode($arr_response);
    
}