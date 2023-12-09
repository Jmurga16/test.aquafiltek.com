<?php
include "connect.php";





$porciones = explode(":", trim($_POST["hora"]));
$fd=str_pad($porciones[0], 2, "0", STR_PAD_LEFT);
$fd1=str_pad($porciones[1], 2, "0", STR_PAD_LEFT);
$fd2=str_pad($porciones[2], 2, "0", STR_PAD_LEFT);

$hora = $fd.":".$fd1.":".$fd2;		   


$nud=explode("-",$_POST['fecha']);
$fecha=$nud[2]."/".$nud[1]."/".$nud[0];

$fecha_tecnico=$nud[0]."-".$nud[1]."-".$nud[2];

$id_cliente = $_POST['id_act'];
$tecnicos = $_POST['tecnicos'];


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

$resultado = mysqli_query($enlace, "SELECT `hora_acepto` FROM `Gestion_acepto` WHERE `fecha_acepto`='$fecha'");
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
	$script = "INSERT INTO `Gestion_acepto`(`codigo_cliente`, `hora_acepto`, `fecha_acepto`) VALUES ('$id_cliente','$hora','$fecha')";
	echo mysqli_query($enlace, $script);

	$id = mysqli_insert_id($enlace);


$fechahoy=date('Y-m-d');

	$script6 = "INSERT INTO tbl_ordenes_tecnicos(id_tecnico, fecha_registro, fecha_programada, id_referencia, id_estatu_orden, hora_programada) VALUES ('$tecnicos','$fechahoy','$fecha_tecnico','$id','1','$hora')";
	mysqli_query($enlace, $script6);




	$id_orden_tecnico = mysqli_insert_id($enlace);


	$tareasd=$_POST["detalles"];



	foreach($tareasd as $index => $value){

		
	$script9 = "INSERT INTO tbl_ordenes_tareas(id_tarea_detalle, id_orden_tecnico, check_marcado) VALUES ('$value','$id_orden_tecnico','0')";
	mysqli_query($enlace, $script9);
				

	}


}

?>