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

//mg operador actual

$operador = $_POST['ide'];

//buscar fecha de filtro de recordatorios

$date=date('Y-m-d');

$getFilter = mysqli_query($enlace,"SELECT r_urgentes FROM filtros WHERE id = 1");
$gf = mysqli_fetch_array($getFilter);


    $nueva=date("Y-m-d",strtotime($date."- ".$gf['r_urgentes']." days")); 

    // AND STR_TO_DATE(lp.fecha_llamada, '%d/%m/%Y') BETWEEN  '$nueva' and '$date'

    //buscamos recordatorios vencidos de otros operadores

    $data = mysqli_query($enlace,"SELECT * FROM llamadasProgramadas WHERE id_operador != '".$operador."' AND realizada = 0 AND STR_TO_DATE(fecha_llamada, '%d/%m/%Y') < '$nueva' ORDER BY fecha_llamada DESC");
    $ndata = mysqli_num_rows($data);

    if($ndata != 0)
    {
        //genero el IN de id_clientes
        $in = '';
        $i = 1;
        while($res_data = mysqli_fetch_array($data))
        {
            if($i == $ndata)
            {
                $in .= "'".$res_data['id_cliente']."'";
            }
            else
            {
                $in .= "'".$res_data['id_cliente']."',";
            }
            


            $i++;
        }

        $script="SELECT `codigo`,`coordenadas`, `nombre_completo`, (0*0) AS distance, (1*1) AS desatendido FROM `DatosClientes` WHERE codigo IN (".$in.")  AND nombre_completo != '-CLIENTE REPETIDO-'"; 
        
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
            if( count($arr_fechas) >= 1 )
            continue;
            
            //15102021
            $sql_dos_meses = "SELECT primaryk, STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y')  AS fecha FROM Gestion_acepto WHERE codigo_cliente = '".$fila['codigo']."' AND
            STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') >= DATE_SUB(NOW(), INTERVAL 3 MONTH) AND STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') <= '$hoy' 
            ORDER BY STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') ";
            $res_check=mysqli_query($enlace, $sql_dos_meses);
            if( $res_check ){
                
                while ($filas_acepto_check = mysqli_fetch_array($res_check)) {
                
                    $arr_fechas[] = $filas_acepto_check['fecha'];
                }
            }
            if( count($arr_fechas) >= 1 )
            continue;
            //fin 15102021
            
            $sql = "SELECT llamadasProgramadas.* , STR_TO_DATE(llamadasProgramadas.fecha_llamada,'%d/%m/%Y')  AS fecha FROM llamadasProgramadas 
            WHERE id_cliente = '".$fila['codigo']."' AND
            STR_TO_DATE(llamadasProgramadas.fecha_llamada,'%d/%m/%Y') >= '$hoy' ORDER BY STR_TO_DATE(llamadasProgramadas.fecha_llamada,'%d/%m/%Y') ";
            $res=mysqli_query($enlace, $sql);
            //$arr_fechas = [];
            if( $res ){
                
                while ($filas_acepto = mysqli_fetch_array($res)) {
                
                    $arr_fechas[] = $filas_acepto['fecha_llamada'];//fecha 24092021
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

    }
    else
    {
        $script="SELECT primaryk,`codigo`,`coordenadas`, `nombre_completo`, fecha_acepto, hora_acepto , 
        (((acos(sin((".$user_lat."*pi()/180)) * sin((`lat`*pi()/180)) + cos((".$user_lat."*pi()/180)) * cos((`lat`*pi()/180)) * cos(((".$user_lng." - `lng`)*pi()/180)))) * 180/pi()) * 60 * 1.6) AS distance FROM `DatosClientes` 
        LEFT JOIN Gestion_acepto ON Gestion_acepto.codigo_cliente = DatosClientes.codigo WHERE actual_gestion=0 AND DatosClientes.inactivo=0 AND 
        ( STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') <= DATE_SUB(NOW(), INTERVAL 3 MONTH) OR Gestion_acepto.codigo_cliente IS NULL)
         GROUP BY Gestion_acepto.codigo_cliente  HAVING distance <= 5 
        ORDER BY distance , Gestion_acepto.primaryk ASC, STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') ASC "; //coordenadas 30 LIMIT 16
    
        
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
            if( count($arr_fechas) >= 1 )
            continue;
            
            //15102021
            $sql_dos_meses = "SELECT primaryk, STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y')  AS fecha FROM Gestion_acepto WHERE codigo_cliente = '".$fila['codigo']."' AND
            STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') >= DATE_SUB(NOW(), INTERVAL 3 MONTH) AND STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') <= '$hoy' 
            ORDER BY STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') ";
            $res_check=mysqli_query($enlace, $sql_dos_meses);
            if( $res_check ){
                
                while ($filas_acepto_check = mysqli_fetch_array($res_check)) {
                
                    $arr_fechas[] = $filas_acepto_check['fecha'];
                }
            }
            if( count($arr_fechas) >= 1 )
            continue;
            //fin 15102021
            
            $sql = "SELECT llamadasProgramadas.* , STR_TO_DATE(llamadasProgramadas.fecha_llamada,'%d/%m/%Y')  AS fecha FROM llamadasProgramadas 
            WHERE id_cliente = '".$fila['codigo']."' AND
            STR_TO_DATE(llamadasProgramadas.fecha_llamada,'%d/%m/%Y') >= '$hoy' ORDER BY STR_TO_DATE(llamadasProgramadas.fecha_llamada,'%d/%m/%Y') ";
            $res=mysqli_query($enlace, $sql);
            //$arr_fechas = [];
            if( $res ){
                
                while ($filas_acepto = mysqli_fetch_array($res)) {
                
                    $arr_fechas[] = $filas_acepto['fecha_llamada'];//fecha 24092021
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

    }




//09092021 SE CAMBIA CONDICIÓN DESC A ASC PARA TOMAR EN CUENTA LOS CLIENTES MÁS ANTIGUOS
/*
SELECT primaryk,`codigo`,`coordenadas`, `nombre_completo`, fecha_acepto, hora_acepto , (((acos(sin((-2.135052*pi()/180)) * sin((`lat`*pi()/180)) + cos((-2.135052*pi()/180)) * cos((`lat`*pi()/180)) * cos((( -79.862840 - `lng`)*pi()/180)))) * 180/pi()) * 60 * 1.6) AS distance FROM `DatosClientes` LEFT JOIN Gestion_acepto ON Gestion_acepto.codigo_cliente = DatosClientes.codigo WHERE actual_gestion=0 AND ( STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') <= DATE_SUB(NOW(), INTERVAL 3 MONTH) OR Gestion_acepto.codigo_cliente IS NULL) GROUP BY Gestion_acepto.codigo_cliente HAVING distance <= 5 ORDER BY distance , Gestion_acepto.primaryk ASC, STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') ASC LIMIT 50

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
