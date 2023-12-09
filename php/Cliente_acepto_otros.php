<?php
include "connect.php";

$porciones = explode(":", trim($_POST["hora"]));
$fd=str_pad($porciones[0], 2, "0", STR_PAD_LEFT);
$fd1=str_pad($porciones[1], 2, "0", STR_PAD_LEFT);
$fd2=str_pad($porciones[2], 2, "0", STR_PAD_LEFT);
$arr_respuesta = ["error"=>true,"msj"=>""];
$hora = $fd.":".$fd1.":".$fd2;		   

$fecha = $_POST['fecha'];
$tipo_gestion = (int)$_POST['tipo_gestion'];

$fecha_hora = $fecha.' '.$hora;
$id_cliente = $_POST['id_act'];

$comenta = $_POST['comentario'];
$comentarioA;

$script = "SELECT descripcion  FROM `tipos_gestion` WHERE id=".$tipo_gestion;
$descripcion = '';
$fila = mysqli_fetch_array(mysqli_query($enlace, $script));
if(!isset($fila['descripcion'])){
    $arr_respuesta["msj"] = "No se econtró tipo gestión con id:".$tipo_gestion;
    }
else{
    $descripcion = $fila['descripcion'];
    $arr_respuesta['desc']=$descripcion;
    $comentFinal = '\n----------INICIA COMENTARIO----------- \n' . $fecha . ' ' . $hora . ' ' . $descripcion . '\n' . $comenta . '\n----------TERMINA COMENTARIO-----------';
    
    //$script = "UPDATE `DatosClientes` SET `comentarios`='$comentHistorico',`comentarios_gestion`='$comentFinal',`estado`='Acepto' WHERE codigo='$id_cliente'";
    
    $puede = 1;
    
    $resultado = mysqli_query($enlace, "SELECT `hora` FROM `otras_gestiones` WHERE `fecha`='$fecha'");
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
    	$arr_respuesta["msj"] = "Conflicto de hora:".$hora_conflicto;
    } else {
    
    	//$operador = $_SESSION['ide'];
    	$script = "INSERT INTO `otras_gestiones`(`codigo_cliente`, `hora`, `fecha`,`id_tipo_gestion`) VALUES ('$id_cliente','$hora','$fecha',$tipo_gestion)";
    	$res = mysqli_query($enlace, $script);
        if(!$res){
            $arr_respuesta["msj"] = "Error al crear registro ";
            $arr_respuesta["e1"] = mysqli_error($enlace);
            
        }
        else{
            $id_otra_gestion = mysqli_insert_id($enlace);
            $arr_respuesta["q2"] = $script;
            $arr_respuesta["id_otra_gestion"] = $id_otra_gestion;
            
            
            $script = "INSERT INTO `comentarios_gestion` (comentario,fecha,id_otra_gestion,codigo_cliente) 
            VALUES('$comentFinal','".$fecha_hora."',$id_otra_gestion,'".$id_cliente."')";
            $res = mysqli_query($enlace, $script);
            if(!$res){
                $arr_respuesta["msj"] = "Error al crear registro comentarios ";
                $arr_respuesta["e2"] = mysqli_error($enlace);
                $arr_respuesta["q2"] = $script;
            }
            else{
                $arr_respuesta["msj"] = " Tipo de gestión : ".$descripcion. " guardada";
                $arr_respuesta["error"] = false;
            }
            
        }
        
    }
}
echo json_encode($arr_respuesta);
?>










