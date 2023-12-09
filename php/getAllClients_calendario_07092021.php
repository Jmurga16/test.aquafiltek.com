<?php
include("connect.php");
//$minima_fecha = date("-2 days");
//$date = "2015-11-17";
$anio_actual = date("Y"); 
$minima_fecha = date('Y-m-d', strtotime(date("Y-m-d"). ' - 3 days'));
$coords = trim($_POST['coords']);
if( $coords != '' ){
    $arr_coords = explode(',',$coords);
    $user_lat = $arr_coords[0];
    $user_lng = $arr_coords[1];
    
}
else{
    $user_lat = -2.110662;
    $user_lng = -79.872196;
}
    
$arr_response = ['error'=>true,'msj'=>'','data'=>[]];
$hoy = date('Y-m-d');
$script="SELECT primaryk,`codigo`,`coordenadas`, `nombre_completo`, fecha_acepto, hora_acepto , 
(  6371 * acos ( cos ( radians($user_lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($user_lng) ) + 
    sin ( radians($user_lat) ) * sin( radians( lat ) ) ) ) AS distance FROM `DatosClientes` 
LEFT JOIN Gestion_acepto ON Gestion_acepto.codigo_cliente = DatosClientes.codigo WHERE actual_gestion=0 AND 
STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') <= DATE_SUB(NOW(), INTERVAL 3 MONTH) 
 GROUP BY Gestion_acepto.codigo_cliente  HAVING distance <= 5 
ORDER BY distance , Gestion_acepto.primaryk DESC, STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') DESC LIMIT 30"; //coordenadas

/*
AND STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') <= '$hoy'
AND (Gestion_acepto.id_tipo_gestion = 1 OR Gestion_acepto.id_tipo_gestion = 2)
 AND 
STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') >= '$hoy' 

SELECT primaryk,`codigo`,`coordenadas`, `nombre_completo`, fecha_acepto, hora_acepto FROM `DatosClientes` 
LEFT JOIN Gestion_acepto ON Gestion_acepto.codigo_cliente = DatosClientes.codigo WHERE actual_gestion=0 
AND STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') < '2021-08-05' GROUP BY Gestion_acepto.codigo_cliente
ORDER BY Gestion_acepto.primaryk DESC, STR_TO_DATE(Gestion_acepto.fecha_acepto+' '+Gestion_acepto.hora_acepto,'%d/%m/%Y %H:%i:%s') DESC LIMIT 3
*/
//echo $script; exit();
//AND YEAR(STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y'))=".$anio_actual."
//STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') <= '".$hoy."' AND STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y')  >='".$minima_fecha."'  

$resultado=mysqli_query($enlace, $script);
if( !$resultado ){
    $arr_response['msj'] = 'Error al obtener datos';
    $arr_response['q1'] = $script;
    
}
else{
    $arr_response['q0'] = $script;
    $arr_response['error']=false; 
    while ($fila = mysqli_fetch_array($resultado)) {
        if( trim($fila['codigo']) != "" ){
            $sql = "SELECT primaryk, STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y')  AS fecha FROM Gestion_acepto WHERE codigo_cliente = '".$fila['codigo']."' AND
            STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') >= '$hoy' ORDER BY STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') ";
            $res=mysqli_query($enlace, $sql);
            $arr_fechas = [];
            if( $res ){
                
                while ($filas_acepto = mysqli_fetch_array($res)) {
                
                    $arr_fechas[] = $filas_acepto['fecha'];
                }
            }
            if( count($arr_fechas) == 0 ){//20082021
                $fila['ultimas_fechas'] = $arr_fechas;
                $arr_response['data'][] = $fila;
                $arr_response['arr_q'][] = $sql;
                $arr_fechas=[];
                unset($fila['ultimas_fechas']);
            }
        }
        //echo $fila['codigo']."|".$fila['coordenadas']."|".$fila['nombre_completo']."|".$fila['fecha_acepto']."|".$fila['hora_acepto']."=";
    }
}
echo json_encode($arr_response);
include("QuitDB.php");
