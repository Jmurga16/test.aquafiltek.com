<?php
include("connect.php");
$identificador= $_POST['ide'];
$fecha_hoy=$_POST['hoy'];
$hoy = date('Y-m-d');

$hour_ago = strtotime('-1 hour');
$hora = date('H:i:s',$hour_ago);
$total='';
$minuto_inicio = date('H:i:00');//strtotime('-5 minutes');
$minuto_fin = date('H:i:00');
$script = "SELECT lp.id_cliente,lp.fecha_llamada,lp.hora_llamada,dc.coordenadas,dc.nombre_completo
FROM llamadasProgramadas AS lp
inner join Clientes_gestionados as cg
inner join DatosClientes as dc
ON lp.id_cliente=cg.id_cliente
AND dc.codigo=lp.id_cliente
AND lp.realizada=0
AND lp.fecha_llamada='$fecha_hoy' 
AND cg.id_operador=$identificador AND STR_TO_DATE(hora_llamada,'%H:%i:%s') = '$minuto_inicio'
ORDER BY dc.coordenadas";
//22092021 se cambia para que el cliente aparezca a otro usuario si no se llamó después de una hora se vuelve todo a normalidad
//$hora AND STR_TO_DATE(hora_llamada,'%H:%i:%s') BETWEEN '$minuto_inicio' and '$minuto_fin' 
$f_hoy = date("Y-m-d");
$h_hoy = date("H:i:s");
//$hora_bd = date_create('2000-01-01 ' . $fila_aux['hora_acepto']);
    	
//echo $script;exit();


$archivo = 'a_gcbuser_err'.date('Ymd').'.log';
//$log='-------------'.date('H:i:s').PHP_EOL;
$resultado = mysqli_query($enlace, $script);
//$log.=$script.PHP_EOL;
if($resultado){
    //$log.='correcto 1 SC2 '.PHP_EOL;
while ($fila = mysqli_fetch_array($resultado)) {
    //07092021 omitir todas las fechas futuras
    $temp_id = $fila['id_cliente'];
    //$script2 = "SELECT * from Gestion_acepto WHERE STR_TO_DATE(fecha_acepto,'%d/%m/%Y')  >= '$f_hoy' AND codigo_cliente = '$temp_id' ";
    $script2 = "SELECT * from llamadasProgramadas WHERE STR_TO_DATE(fecha_llamada,'%d/%m/%Y')  > '$f_hoy' AND id_cliente = '$temp_id' ";
    
    //$log.=$script2.PHP_EOL;
    $resultado = mysqli_query($enlace, $script2);
    if($resultado){
        $gestiones = FALSE;
                
        while ($fila2 = mysqli_fetch_array($resultado)) {
            if( !$gestiones ){
                $gestiones = TRUE;
            }else{
                break;
            }
        }
        if( !$gestiones ){
             $total.=$fila['id_cliente']."|".$fila['fecha_llamada']."|".$fila['hora_llamada']."|".$fila['coordenadas']."|".$fila['nombre_completo']."=";
  
        }
    }
    else{
        $err = mysqli_error($enlace);
        //$log.=$err.PHP_EOL;
    }
   

}
}
else{echo $script;
    echo mysqli_error($enlace);
}
//$log.=PHP_EOL;
//file_put_contents($archivo, $log, FILE_APPEND);

echo $total;
include("QuitDB.php");

