<?php
include("connect.php");
$identificador= $_POST['ide'];

$tipo = $_POST['tipo'];



$date=date('Y-m-d');

$getFilter = mysqli_query($enlace,"SELECT r_urgentes FROM filtros WHERE id = 1");
$gf = mysqli_fetch_array($getFilter);

if($tipo == 'usuario')
{
    $nueva=date("Y-m-d",strtotime($date."- 60 days")); 
}
else
{
    $nueva=date("Y-m-d",strtotime($date."- ".$gf['r_urgentes']." days")); 
}




$total='';
$script = "SELECT lp.id_cliente,lp.timestamp, lp.fecha_llamada,lp.hora_llamada,dc.coordenadas, dc.estado, dc.nombre_completo, 
STR_TO_DATE(lp.fecha_llamada, '%d/%m/%Y') as fes
FROM llamadasProgramadas AS lp
inner join Clientes_gestionados as cg
inner join DatosClientes as dc
ON lp.id_cliente=cg.id_cliente
AND dc.codigo=lp.id_cliente
AND lp.realizada=0
AND STR_TO_DATE(lp.fecha_llamada, '%d/%m/%Y') BETWEEN  '$nueva' and '$date'
AND cg.id_operador=$identificador
AND dc.inactivo = 0
ORDER by lp.timestamp desc";


$resultado = mysqli_query($enlace, $script);
// echo $script;
while ($fila = mysqli_fetch_array($resultado)) {
    $total.=$fila['id_cliente']."|".$fila['fecha_llamada']."|".$fila['hora_llamada']."|".$fila['coordenadas']."|".$fila['nombre_completo']."|".$fila['estado']."=";
}
echo $total;
include("QuitDB.php");

/*
SELECT lp.id_cliente,lp.fecha_llamada,lp.hora_llamada,dc.coordenadas,dc.nombre_completo
FROM llamadasProgramadas AS lp
inner join Clientes_gestionados as cg
inner join DatosClientes as dc
ON lp.id_cliente=cg.id_cliente
AND dc.codigo=lp.id_cliente
AND lp.realizada=0
AND lp.fecha_llamada='21/04/2019'
AND cg.id_operador=120
*/
