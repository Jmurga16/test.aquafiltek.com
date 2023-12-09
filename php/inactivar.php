<?php 
include("connect.php");
session_start();

$idcliente = $_POST['idcliente'];
$motivo = $_POST['motivo'];
$id_operador = $_SESSION['ide'];
$fecha = date('Y-m-d');
$hora = date('h:i:s');
$tipo = $_POST['tipo'];

if($tipo == '')
{
    $script1 = "UPDATE `DatosClientes` set inactivo = 1, tipo_inactivo = 1 WHERE codigo = '$idcliente'";
}
else
{
    $script1 = "UPDATE `DatosClientes` set inactivo = 1, tipo_inactivo = '$tipo' WHERE codigo = '$idcliente'";
}


$ejecutar = mysqli_query($enlace,$script1);


    $script2 = "INSERT INTO `gestion_inactivos` (id_operador, id_cliente, motivo, fecha, hora) VALUES ('$id_operador', '$idcliente', '$motivo', '$fecha', '$hora')";
    $ejecutar2 = mysqli_query($enlace,$script2);


//agregar inactivar como una gestión

$id_tipo_gestion = 5;

$id_cliente = $idcliente;

$comenta = $motivo;
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
	case 4:
		$str_estado = 'Acepto con la competencia';
		break;
    case 5:
        $str_estado = 'Cliente inactivado';
        break;
    default :
        $str_estado = 'Acepto';
        break;
    
    
}
$comentFinal = '\n----------INICIA COMENTARIO----------- \n' . $fecha . " " . $hora . ' - ' . $str_estado . '\n' . $comenta . '\n----------TERMINA COMENTARIO-----------';


//agrego comentario a nueva tabla

$script = "INSERT INTO comentarios (comentario, fecha, hora, estado, id_cliente, id_operador) VALUES ('$comenta','$fecha','$hora', '$str_estado','$id_cliente','$_SESSION[ide]')";
$ejecutar_comment = mysqli_query($enlace,$script);

$script = "UPDATE `DatosClientes` SET `comentarios`='$comentHistorico', `comentarios_gestion`='',`estado`='$str_estado' WHERE codigo='$id_cliente'";
$res=mysqli_query($enlace, $script);
/*
    $fichero ="log_gestion_".date("Ymd").".log"; 
    
    $log=$script.PHP_EOL;
    
    $log.='res:'.$res.PHP_EOL;
    file_put_contents($fichero, $log, FILE_APPEND );
   
	//$operador = $_SESSION['ide'];
	$script = "INSERT INTO `Gestion_acepto`(`codigo_cliente`, `hora_acepto`, `fecha_acepto`,`id_tipo_gestion` ) VALUES ('$id_cliente','$hora','$fecha',$id_tipo_gestion)";
	echo mysqli_query($enlace, $script);

*/
//termina inactivar como gestión

   
        echo "1";
  





?>