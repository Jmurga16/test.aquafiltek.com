<?php
include "connect.php";
$id_user = $_POST['id_act'];


$nud=explode("-",$_POST['fecha']);
$fecha_llamada=$nud[2]."/".$nud[1]."/".$nud[0];

//$fecha_llamada = $_POST['fecha'];
$hora_llamada = $_POST['hora'];
$comentario = $_POST['comentario'];
$tipoA = $_POST['tipo'];
$mensajeA="";

if ($tipoA == "vl") {
	$tipoA = "Volver a llamar";
	$mensajeA= "Volver a llamar";
} else if ($tipoA == "nr") {
	$tipoA = "No responde";
	$mensajeA= "No responde";
} else if ($tipoA == "ot") {
	$tipoA = "Otro estado";
	$mensajeA= "Otro estado";
} else if ($tipoA == "eq") {
	$tipoA = "Equivocado";
	$mensajeA= "Equivocado";

} else if ($tipoA == "av") {
	$tipoA = "Averiado";
	$mensajeA=  "Averiado";

} else if ($tipoA == "ac") {
	$mensajeA = "POSTVENTA CLIENTE SOLICITO VOLVER A LLAMAR";
	$tipoA = "Volver a llamar";
}
if ($tipoA == "vi") {//14082021
	$tipoA = "Volver a llamar Importante";
	$mensajeA= "Volver a llamar Importante";
}

$script = "SELECT `comentarios_gestion`,`comentarios` FROM `DatosClientes` WHERE codigo='$id_user'";
$fila = mysqli_fetch_array(mysqli_query($enlace, $script));
$comentarioA = $fila['comentarios_gestion'];
$coment_historial = $fila['comentarios'];

$comentHistorico = $comentarioA . "\n" . $coment_historial;
$comentFinal = '\n----------INICIA COMENTARIO----------- \n' . $fecha_llamada . "\n" . $hora_llamada . '\n' . $mensajeA . '\n' . $comentario . '\n----------TERMINA COMENTARIO-----------';

$script1 = "UPDATE `DatosClientes` SET `comentarios`='$comentHistorico', `comentarios_gestion`='$comentFinal',`estado`='$tipoA' WHERE codigo='$id_user'";
mysqli_query($enlace, $script1);

$script = "INSERT INTO `llamadasProgramadas`( `id_cliente`, `fecha_llamada`, `hora_llamada`) VALUES ('$id_user','$fecha_llamada','$hora_llamada')";
echo mysqli_query($enlace, $script);

?>