<?php
include "connect.php";
session_start();

$id_cliente = $_POST['id_act'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$comenta = $_POST['comentario'];
$comentarioA;

$fecha_gestion = date("d-m-Y");
$hora_gestion = date("h:i:s");

$script = "SELECT `comentarios_gestion` FROM `DatosClientes` WHERE codigo='$id_cliente'";

$script = "SELECT `comentarios_gestion`,`comentarios` FROM `DatosClientes` WHERE codigo='$id_cliente'";

$fila = mysqli_fetch_array(mysqli_query($enlace, $script));
$comentarioA = $fila['comentarios_gestion'];
$coment_historial = $fila['comentarios'];

//compruebo si esta vacio last comment

if($comentarioA != '')
{
    $comentHistorico = $comentarioA . "\n" . $coment_historial;
}
else
{
    $comentHistorico = $coment_historial; 
}



$comentFinal = '\n----------INICIA COMENTARIO----------- \n' . $fecha . "\n" . $hora . '\n' . 'Rechazó' . '\n' . $comenta . '\n----------TERMINA COMENTARIO-----------';

//agrego comentario a nueva tabla

$script = "INSERT INTO comentarios (comentario, fecha, hora, estado, id_cliente, fecha_gestion, hora_gestion, id_operador) VALUES ('$comenta','$fecha','$hora', 'Rechazo','$id_cliente','$fecha_gestion','$hora_gestion','$_SESSION[ide]')";
$ejecutar_comment = mysqli_query($enlace,$script);


$script = "UPDATE `DatosClientes` SET `comentarios`='$comentHistorico',`comentarios_gestion`='',`estado`='Rechazo' WHERE codigo='$id_cliente'";
echo mysqli_query($enlace, $script);

?>