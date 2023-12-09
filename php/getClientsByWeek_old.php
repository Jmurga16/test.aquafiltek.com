<?php
include("connect.php");
$identificador= $_POST['ide'];
$fecha_inicio=$_POST['inicio'];
$fecha_fin=$_POST['fin'];
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

$nueva_ini_lis= date("Y-m-d",$primerDia);
$nueva_ff_lis=date("Y-m-d",$ultimoDia);
           



$script="SELECT lp.id_cliente,lp.fecha_llamada,lp.hora_llamada,dc.coordenadas,dc.nombre_completo, STR_TO_DATE(lp.fecha_llamada, '%d/%m/%Y') as fes
FROM llamadasProgramadas AS lp inner 
join Clientes_gestionados as cg inner 
join DatosClientes as dc ON lp.id_cliente=cg.id_cliente 
AND dc.codigo=lp.id_cliente AND lp.realizada=0 AND dc.inactivo = 0
AND STR_TO_DATE(lp.fecha_llamada, '%d/%m/%Y') BETWEEN  '$nueva_ini_lis' and '$nueva_ff_lis'
AND cg.id_operador=$identificador ORDER by fes asc";
//echo $script;exit();





$resultado=mysqli_query($enlace, $script);
$total="";
while ($fila = mysqli_fetch_array($resultado)) {
    echo $fila['id_cliente']."|".$fila['fecha_llamada']."|".$fila['hora_llamada']."|".$fila['coordenadas']."|".$fila['nombre_completo']."=";
}
include("QuitDB.php");
