<?php
include("connect.php");
$hoy_min = date('Y-m-d 00:00:00');
$hoy_max = date('Y-m-d 23:59:59');
$fin_horario = date('Y-m-d 17:00:00'); //_SESSION
$time_fin_horario = strtotime($fin_horario);
$hoy_actual = date('Y-m-d H:i:s');
$time_actual = strtotime($hoy_actual);
$fecha_buscar = isset($_POST['fecha_buscar'])?$_POST['fecha_buscar']:0;
$fichero = 'logs/abuscarhoy/abuscarhoy_'.date('Ymd').'.log';
$log=' inicia:'.date('H:i:s').PHP_EOL;
$log.='hoy_actual:'.$hoy_actual.PHP_EOL;

if($fecha_buscar != 0 ){
    $log.=' BUSCAR SIGUIENTE:'.$fecha_buscar.PHP_EOL;
    $hoy_actual =  date('Y-m-d H:i:s', strtotime('+'.$fecha_buscar.' day'));
    $hoy_min =  date('Y-m-d 00:00:00', strtotime('+'.$fecha_buscar.' day'));
    $hoy_max =  date('Y-m-d 23:59:59', strtotime('+'.$fecha_buscar.' day'));
    
    $log.='NUEVA FECHA:'.$hoy_actual.' MIN:'.$hoy_min.' -MAX:'.$hoy_max.PHP_EOL;
}
$condicion = "STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') <= '".$hoy_max."' AND 
STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') >= '".$hoy_min."'";
if( $time_actual > $time_fin_horario){
    //21092021$condicion = "STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') >= '".$hoy_actual."'";    
}
$script="SELECT primaryk, `codigo`,`coordenadas`, `nombre_completo`,fecha_acepto,hora_acepto,id_tipo_gestion FROM `DatosClientes` 
LEFT JOIN Gestion_acepto ON Gestion_acepto.codigo_cliente = DatosClientes.codigo WHERE 
".$condicion." AND DatosClientes.inactivo=0
ORDER BY STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') , Gestion_acepto.hora_acepto  "; //coordenadas
$log.=$script.PHP_EOL;

//echo $script; exit(); //GROUP BY Gestion_acepto.codigo_cliente
file_put_contents($fichero, $log,FILE_APPEND );

//26062021 actual_gestion=0 AND 
$resultado=mysqli_query($enlace, $script);
$repetidos = [];
while ($fila = mysqli_fetch_array($resultado)) {
    if( trim($fila['codigo']) != "" && !in_array(trim($fila['codigo']), $repetidos) ){
        $tipo_gestion = $fila['id_tipo_gestion'];
        if( $tipo_gestion == 1 ){
            $timestamp = strtotime($fila['hora_acepto']) + 60*60;

            $hora_fin = date('H:i:s', $timestamp);

        }
        else{
            $timestamp = strtotime($fila['hora_acepto']) + 60*15;

            $hora_fin = date('H:i:s', $timestamp);

        }
        $repetidos[] = trim($fila['codigo']);
        $int_hora = explode(":",$fila['hora_acepto'])[0];
        echo $fila['codigo']."|".$fila['coordenadas']."|".$fila['nombre_completo']."|".$fila['fecha_acepto']."|".$fila['hora_acepto']."|".$int_hora."|".$hora_fin."="; 
    }
        
}
include("QuitDB.php");
