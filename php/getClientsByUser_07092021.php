<?php
include("connect.php");
$identificador= $_POST['ide'];
$fecha_hoy=$_POST['hoy'];
$total='';
$script = "SELECT lp.id_cliente,lp.fecha_llamada,lp.hora_llamada,dc.coordenadas,dc.nombre_completo
FROM llamadasProgramadas AS lp
inner join Clientes_gestionados as cg
inner join DatosClientes as dc
ON lp.id_cliente=cg.id_cliente
AND dc.codigo=lp.id_cliente
AND lp.realizada=0
AND lp.fecha_llamada='$fecha_hoy'
AND cg.id_operador=$identificador
ORDER BY dc.coordenadas";




$resultado = mysqli_query($enlace, $script);
// echo $script;
while ($fila = mysqli_fetch_array($resultado)) {
    $total.=$fila['id_cliente']."|".$fila['fecha_llamada']."|".$fila['hora_llamada']."|".$fila['coordenadas']."|".$fila['nombre_completo']."=";
}
echo $total;
include("QuitDB.php");

