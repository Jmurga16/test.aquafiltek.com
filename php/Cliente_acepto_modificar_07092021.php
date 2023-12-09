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
    $log =PHP_EOL.'---------fecha:'.date('Y-m-d H:i:s').'-------'.PHP_EOL;
    $sql1 = "SELECT ga.fecha_acepto, ga.hora_acepto, tg.descripcion AS gestion  
    FROM `Gestion_acepto` AS ga JOIN tipos_gestion AS tg ON ga.id_tipo_gestion = tg.id WHERE  `primaryk`='$id_gestion'";
    $fichero = 'log_modificar_gestion_'.date('Ymd').'.log';
    $log.='get datos anteriores:'.$sql1.PHP_EOL;
    
    $resultado = mysqli_query($enlace, $sql1);
    if( $resultado ){
        $log.='sin err 1'.PHP_EOL;
        $fecha_acepto = '';
        $hora_acepto = '';
        $str_estado = '';
        while ($fila = mysqli_fetch_array($resultado)) {
            $log.='tiene data';
            $fecha_acepto = $fila['fecha_acepto'];
            $hora_acepto = $fila['hora_acepto'];
            $str_estado =  $fila['gestion'];
        }
        if( $fecha_acepto == '' && $hora_acepto== '' && $str_estado == '' ){
             $log.='no tiene data';
            	echo "-3~Error al obtener fecha y hora anterior";
        }
        else{
            
            
            $comenta='Fecha anterior:'.$fecha_acepto.' Hora anterior:'.$hora_acepto.'\n'.'modificado por :'.$_SESSION['usuario'].'\n'.$comenta;
            $log.=$comenta.PHP_EOL;
            $comentFinal = '\n----------INICIA COMENTARIO----------- \n' . $fecha . " " . $hora . ' ' . $str_estado . '\n' . $comenta . '\n----------TERMINA COMENTARIO-----------';

            $script = "UPDATE `DatosClientes` SET `comentarios`='$comentHistorico',`comentarios_gestion`='$comentFinal',`estado`='$str_estado' WHERE codigo='$id_cliente'";
            $res_update = mysqli_query($enlace, $script);
            if( $res_update ){
                $log.='actualizado coment'.PHP_EOL;
            }
            else{
                $log.='Err act coment:'.mysqli_error($enlace).PHP_EOL;
            }

	    //$operador = $_SESSION['ide'];
	    $script = "UPDATE  `Gestion_acepto` SET  `hora_acepto` = '$hora', `fecha_acepto` = '$fecha' WHERE primaryk = '$id_gestion'";
	    $log.=$script.PHP_EOL;
	    $res_update = mysqli_query($enlace, $script);
	    if(!$res_update){
	        $log.='Err act gestion:'.mysqli_error($enlace).PHP_EOL;
	    }
	    file_put_contents($fichero, $log, FILE_APPEND );


	    echo $res_update;
        }
    }
    else{
        $log.=mysqli_error($enlace);
        file_put_contents($fichero, $log, FILE_APPEND );
        echo "-3~" ."Error al obtener datos anteriores";

    }
}

?>