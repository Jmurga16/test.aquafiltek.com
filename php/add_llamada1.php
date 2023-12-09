<?php
session_start();
include "connect.php";
$id_user = $_POST['id_act'];

if(!isset($_SESSION['ide']) || $_SESSION['ide'] == NULL){
    echo 0;
    exit();
}

$nud=explode("-",$_POST['fecha']);
$fecha_llamada=$nud[2]."/".$nud[1]."/".$nud[0];

//$fecha_llamada = $_POST['fecha'];
$hora_llamada = $_POST['hora'];
$comentario = $_POST['comentario'];
$tipoA = $_POST['tipo'];
$mensajeA="";

$fecha_gestion = date("d-m-Y");
$hora_gestion = date("h:i:s");

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

if($comentarioA == '')
{
	$comentHistorico = $coment_historial;
}
else
{
	$comentHistorico = $comentarioA . "\n" . $coment_historial;
}


$comentFinal = '\n----------INICIA COMENTARIO----------- \n' . $fecha_llamada . " " . $hora_llamada . '\n' . $mensajeA . '\n' . $comentario . '\n----------TERMINA COMENTARIO-----------';




//agrego comentario a nueva tabla

$script = "INSERT INTO comentarios (comentario, fecha, hora, estado, id_cliente, fecha_gestion, hora_gestion, id_operador) VALUES ('$comentario','$fecha_llamada','$hora_llamada', '$tipoA','$id_user','$fecha_gestion','$hora_gestion','$_SESSION[ide]')";
$ejecutar_comment = mysqli_query($enlace,$script);


$script1 = "UPDATE `DatosClientes` SET `comentarios`='$comentHistorico', `comentarios_gestion`='',`estado`='$tipoA' WHERE codigo='$id_user'";
mysqli_query($enlace, $script1);


//timestamp Marcelo Guiot

$fecha = $fecha_llamada;

	$fecha1 = str_replace('/', '-', $fecha);
	$date = "$fecha1 $hora_llamada";

	$timestamp = strtotime($date);



$script = "INSERT INTO `llamadasProgramadas`( `id_cliente`, `fecha_llamada`, `hora_llamada`, `timestamp`, id_operador ) VALUES ('$id_user','$fecha_llamada','$hora_llamada', '$timestamp', ".$_SESSION['ide'].")";
//echo $script;
$res =  mysqli_query($enlace, $script);

if(!$res){
    echo mysqli_error($enlace);
}
else{
    echo $res;
}
?>