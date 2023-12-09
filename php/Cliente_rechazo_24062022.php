<?php
include "connect.php";

$id_cliente = $_POST['id_act'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$comenta = $_POST['comentario'];
$comentarioA;

$script = "SELECT `comentarios_gestion` FROM `DatosClientes` WHERE codigo='$id_cliente'";

$script = "SELECT `comentarios_gestion`,`comentarios` FROM `DatosClientes` WHERE codigo='$id_cliente'";

$fila = mysqli_fetch_array(mysqli_query($enlace, $script));
$comentarioA = $fila['comentarios_gestion'];
$coment_historial = $fila['comentarios'];

$comentHistorico = $comentarioA . "\n" . $coment_historial;

$comentFinal = '\n----------INICIA COMENTARIO----------- \n' . $fecha . "\n" . $hora . '\n' . 'Rechazó' . '\n' . $comenta . '\n----------TERMINA COMENTARIO-----------';

$script = "UPDATE `DatosClientes` SET `comentarios`='$comentHistorico',`comentarios_gestion`='$comentFinal',`estado`='Rechazo' WHERE codigo='$id_cliente'";
echo mysqli_query($enlace, $script);

?>