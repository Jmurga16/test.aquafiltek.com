<?php
include("connect.php");
$identificador= $_POST['ide'];



$date=date('Y-m-d');
$nueva=date("Y-m-d",strtotime($date."- 30 days")); 


$total='';
$script = "SELECT lp.id_cliente,lp.fecha_llamada,lp.hora_llamada,dc.coordenadas,dc.nombre_completo, 
STR_TO_DATE(lp.fecha_llamada, '%d/%m/%Y') as fes
FROM llamadasProgramadas AS lp
inner join Clientes_gestionados as cg
inner join DatosClientes as dc
ON lp.id_cliente=cg.id_cliente
AND dc.codigo=lp.id_cliente
AND lp.realizada=0
AND STR_TO_DATE(lp.fecha_llamada, '%d/%m/%Y') BETWEEN  '$nueva' and '$date'
AND cg.id_operador=$identificador
ORDER by fes desc";



$resultado = mysqli_query($enlace, $script);
// echo $script;
while ($fila = mysqli_fetch_array($resultado)) {
    $total.=$fila['id_cliente']."|".$fila['fecha_llamada']."|".$fila['hora_llamada']."|".$fila['coordenadas']."|".$fila['nombre_completo']."=";
}
//echo $total;
include("QuitDB.php");

//$retorna["mensaje"]=$total;
echo json_encode($total);

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
