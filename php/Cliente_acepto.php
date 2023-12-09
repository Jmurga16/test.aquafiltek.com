<?php
include "connect.php";
session_start();

$porciones = explode(":", trim($_POST["hora"]));
$fd=str_pad($porciones[0], 2, "0", STR_PAD_LEFT);
$fd1=str_pad($porciones[1], 2, "0", STR_PAD_LEFT);
$fd2=str_pad($porciones[2], 2, "0", STR_PAD_LEFT);

$hora = $fd.":".$fd1.":".$fd2;		   


$nud=explode("-",$_POST['fecha']);
$fecha=$nud[2]."/".$nud[1]."/".$nud[0];

$fecha_gestion = date("d-m-Y");
$hora_gestion = date("h:i:s");


//14082021
$id_tipo_gestion = isset($_POST['id_tipo_gestion'])?(int)$_POST['id_tipo_gestion']:1;

$id_cliente = $_POST['id_act'];

$comenta = $_POST['comentario'];
$comentarioA;

$script = "SELECT `comentarios_gestion`,`comentarios` FROM `DatosClientes` WHERE codigo='$id_cliente'";

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

$str_estado = '';
switch( $id_tipo_gestion ){
    case 1:
        $str_estado = 'Acepto';
        break;
    case 2:
        $str_estado = 'Inspección';
        break;
    case 3:
        $str_estado = 'Cobros';
        break;
    default :
        $str_estado = 'Acepto';
        break;
    
    
}
$comentFinal = '\n----------INICIA COMENTARIO----------- \n' . $fecha . " " . $hora . ' - ' . $str_estado . '\n' . $comenta . '\n----------TERMINA COMENTARIO-----------';

//agrego comentario a nueva tabla

$script = "INSERT INTO comentarios (comentario, fecha, hora, estado, id_cliente, fecha_gestion, hora_gestion, id_operador) VALUES ('$comenta','$fecha','$hora', '$str_estado','$id_cliente','$fecha_gestion','$hora_gestion','$_SESSION[ide]')";
$ejecutar_comment = mysqli_query($enlace,$script);





$puede = 1;

$resultado = mysqli_query($enlace, "SELECT `hora_acepto`,primaryk, id_tipo_gestion FROM `Gestion_acepto` WHERE `fecha_acepto`='$fecha' ");
$hora_subir = date_create('2000-01-01 ' . $hora);
if( $id_tipo_gestion == 1 ){ //acepto
    while ($fila_aux = mysqli_fetch_array($resultado)) {
    	$hora_bd = date_create('2000-01-01 ' . $fila_aux['hora_acepto']);
    	$dteDiff = $hora_subir->diff($hora_bd);
    	$totDif = intval($dteDiff->format('%r%h'));
    	$totDif_min = intval($dteDiff->format('%i'));
    	if( $fila_aux['id_tipo_gestion'] == 1 ){
        	if ($totDif < 0) {
        		$totDif *= -1;
        		//break;
        	}
        	if ($totDif < 1) {
        		$puede = 0;
        		$hora_conflicto = $fila_aux['hora_acepto']."-".$fila_aux['id_tipo_gestion']."-".$fila_aux['primaryk'];
        		//break;
        	}
    	}
    	else{
    	    if ($totDif == 0 && $totDif_min < 0) {
        		$totDif *= -1;
        		//break;
        	}
        	if ($totDif == 0 && $totDif_min <= 15) {
        		$puede = 0;
        		$hora_conflicto = $fila_aux['hora_acepto']."-".$totDif."--".$hora_subir->format("H:i:s")."-".$hora_bd->format("H:i:s")."-".$fila_aux['id_tipo_gestion'];
        		//$hora_conflicto = $fila_aux['hora_acepto'];
        		//break;
        	}    
    	}
    
    }
}
else{// 2 3 cobros inspeccion 15 minutos diff
    while ($fila_aux = mysqli_fetch_array($resultado)) {
    	$hora_bd = date_create('2000-01-01 ' . $fila_aux['hora_acepto']);
    	$dteDiff = $hora_subir->diff($hora_bd);
    	$totDif_hora = intval($dteDiff->format('%r%h'));

    	$totDif = intval($dteDiff->format('%i'));
    	if ($totDif_hora == 0 && $totDif < 0) {
    		$totDif *= -1;
    		//break;
    	}
    	if ($totDif_hora == 0 && $totDif == 0) {//16092021 <=15
    		$puede = 0;
    		//$hora_conflicto = $fila_aux['hora_acepto']."-".$totDif."--".$hora_subir->format("H:i:s")."-".$hora_bd->format("H:i:s");
    		$hora_conflicto = $fila_aux['hora_acepto'].'-difhora:'.$totDif_hora.'--dif:'.$totDif.'-ha:'.$fila_aux['hora_acepto'];
    		//break;
    	}
    
    }
}

if ($puede != 1) {
	echo "-3~" . $hora_conflicto;
} else {
    if( trim($id_cliente) == '' ){//21102021
         echo "-3~" . 'cliente vacio';
    }
    else{
    $fichero ="log_gestion_".date("Ymd").".log"; 
    /*antes de la tabla de comentarios
	$script = "UPDATE `DatosClientes` SET `comentarios`='$comentHistorico', `comentarios_gestion`='',`estado`='$str_estado' WHERE codigo='$id_cliente'";
    */
	$script = "UPDATE `DatosClientes` SET `comentarios`='$comentHistorico',`comentarios_gestion`='',`estado`='$str_estado' WHERE codigo='$id_cliente'";
	$log=$script.PHP_EOL;
    $res=mysqli_query($enlace, $script);
    $log.='res:'.$res.PHP_EOL;
    file_put_contents($fichero, $log, FILE_APPEND );
   
	//$operador = $_SESSION['ide'];
	$script = "INSERT INTO `Gestion_acepto`(`codigo_cliente`, `hora_acepto`, `fecha_acepto`,`id_tipo_gestion` ) VALUES ('$id_cliente','$hora','$fecha',$id_tipo_gestion)";
	echo mysqli_query($enlace, $script);
    }
}

?>