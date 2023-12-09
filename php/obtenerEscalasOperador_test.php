<?php
include "connect.php";
require "check_session.php";
$porciones = explode(":", trim($_POST["hora"]));
$fd=str_pad($porciones[0], 2, "0", STR_PAD_LEFT);
$fd1=str_pad($porciones[1], 2, "0", STR_PAD_LEFT);
$fd2=str_pad($porciones[2], 2, "0", STR_PAD_LEFT);

$hora = $fd.":".$fd1.":".$fd2;		   


$nud=explode("-",$_POST['fecha']);
$fecha=$nud[2]."/".$nud[1]."/".$nud[0];



$id_cliente = $_POST['id_act'];
$id_gestion = $_POST['id_gestion'];

$comenta = $_POST['comentario'];
$comentarioA;

$script = "SELECT `comentarios_gestion`,`comentarios` FROM `DatosClientes` WHERE codigo='$id_cliente'";

$fila = mysqli_fetch_array(mysqli_query($enlace, $script));
$comentarioA = $fila['comentarios_gestion'];
$coment_historial = $fila['comentarios'];

$comentHistorico = $comentarioA . "\n" . $coment_historial;

$comentFinal = '\n----------INICIA COMENTARIO----------- \n' . $fecha . "\n" . $hora . '\n' . 'Acepto' . '\n' . $comenta . '\n----------TERMINA COMENTARIO-----------';

$script = "UPDATE `DatosClientes` SET `comentarios`='$comentHistorico',`comentarios_gestion`='$comentFinal',`estado`='Acepto' WHERE codigo='$id_cliente'";
mysqli_query($enlace, $script);

$puede = 1;

$resultado = mysqli_query($enlace, "SELECT `hora_acepto` FROM `Gestion_acepto` WHERE `fecha_acepto`='$fecha' AND `primaryk`!='$id_gestion'");
//$resultado = mysqli_query($enlace, "SELECT `hora_acepto` FROM `Gestion_acepto` WHERE `primaryk`='$id_gestion'");

$hora_subir = date_create('2000-01-01 ' . $hora);
while ($fila_aux = mysqli_fetch_array($resultado)) {
	$hora_bd = date_create('2000-01-01 ' . $fila_aux['hora_acepto']);
	$dteDiff = $hora_subir->diff($hora_bd);
	$totDif = intval($dteDiff->format('%r%h'));
	if ($totDif < 0) {
		$totDif *= -1;
	}
	if ($totDif < 1) {
		$puede = 0;
		$hora_conflicto = $fila_aux['hora_acepto'];
	}

}

if ($puede != 1) {
	echo "-3~" . $hora_conflicto;
} else {

	//$operador = $_SESSION['ide'];
	$script = "UPDATE  `Gestion_acepto` SET  `hora_acepto` = '$hora', `fecha_acepto` = '$fecha' WHERE primaryk = '$id_gestion'";
	echo mysqli_query($enlace, $script);
}

?>