<?php
include("connect.php");
$identificador= $_POST['ide'];
$fecha_inicio=$_POST['inicio'];
$fecha_fin=$_POST['fin'];


//$fecha_inicio = strtotime($fecha_inicio);

$total='';
/*

$nueva_ini=explode("/",$fecha_inicio);
$nueva_ini_lis=$nueva_ini[2]."-".$nueva_ini[1]."-".$nueva_ini[0];

$nueva_ff=explode("/",$fecha_fin);
$nueva_ff_lis=$nueva_ff[2]."-".$nueva_ff[1]."-".$nueva_ff[0];

*/
$year=date("Y");
$semana=date("W");

$dia=date("l");

if(trim($dia)=='Sunday'){
    $semana=$semana+1;
}


$timestamp=mktime(0, 0, 0, 1, 1, $year);                             
# sumamos el timestamp de la suma de las semanas actuales
$timestamp+=$semana*7*24*60*60;                             
# restamos la posición inicial del primer dia del año
$ultimoDia=$timestamp-date("w", mktime(0, 0, 0, 1, 1, $year))*24*60*60;                             
# le restamos los dias que hay hasta llegar al lunes
$primerDia=$ultimoDia-86400*(date('N',$ultimoDia)-1);

$nueva_ini= $fecha_inicio;


$date = new DateTime('now');
$date->modify('+1 day');
$nuevo_dato = $date->format('m/d/Y');

$date1 = new DateTime('now');
$date1->modify('+7 day');
$final_dato = $date1->format('m/d/Y');



$start_date = strtotime($nuevo_dato);
$fecha_fin = strtotime($final_dato);
$nueva_ff= $fecha_fin;



$script="SELECT lp.id_cliente,lp.fecha_llamada,lp.hora_llamada,dc.coordenadas,dc.estado,dc.nombre_completo, lp.timestamp as fes
FROM llamadasProgramadas AS lp inner 
join Clientes_gestionados as cg inner 
join DatosClientes as dc ON lp.id_cliente=cg.id_cliente 
AND dc.codigo=lp.id_cliente AND lp.realizada=0 AND dc.inactivo = 0
AND lp.timestamp BETWEEN  '$start_date' and '$nueva_ff'
AND cg.id_operador=$identificador ORDER by fes asc";
//echo $script;exit();



$resultado=mysqli_query($enlace, $script);
$total="";
while ($fila = mysqli_fetch_array($resultado)) {
    echo $fila['id_cliente']."|".$fila['fecha_llamada']."|".$fila['hora_llamada']."|".$fila['coordenadas']."|".$fila['nombre_completo']."|".$fila['estado']."=";
}
include("QuitDB.php");
