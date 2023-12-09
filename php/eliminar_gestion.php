<?php
session_start();
$arr_respuesta = ['error'=>true,'msj'=>''];

if(!isset($_SESSION['ide']) || $_SESSION['ide'] == NULL){
    $arr_respuesta['msj']='Debe iniciar sesión';
    echo json_encode($arr_respuesta);

    exit();
}
include "connect.php";


$id_gestion = $_POST['id_gestion'];

$id_tipo_gestion = $_POST['id_tipo_gestion'];
$codigo = $_POST['codigo'];
$fecha_acepto = $_POST['fecha_acepto'];
$hora_acepto = $_POST['hora_acepto'];

$script = "SELECT `comentarios_gestion`,`comentarios` FROM `DatosClientes` WHERE codigo='$codigo'";
    $fila = mysqli_fetch_array(mysqli_query($enlace, $script));
    $comentarioA = $fila['comentarios_gestion'];
    $coment_historial = $fila['comentarios'];
    $comentHistorico = $comentarioA . "\n" . $coment_historial;
    
if( $id_tipo_gestion == -1 ){//llamada realizada
    
    $sql = "SELECT * from llamadasProgramadas WHERE id_cliente = '".$codigo."' AND  STR_TO_DATE(fecha_llamada,'%d/%m/%Y') = '$fecha_acepto'
     AND hora_llamada = '$hora_acepto'";
    $fila = mysqli_fetch_array(mysqli_query($enlace, $sql));
    if( isset($fila['id']) ){
        $comentFinal = '\n----------INICIA COMENTARIO----------- \n Se eliminó llamada importante con fecha:' . $fila['fecha_llamada'] . "\n y hora:" . 
        $fila['hora_llamada'] . '\n' . ' usuario: '. $_SESSION['usuario'] . '\n----------TERMINA COMENTARIO-----------';
        $script1 = "UPDATE `DatosClientes` SET `comentarios`='$comentHistorico', `comentarios_gestion`='$comentFinal',`estado`='Por gestionar' WHERE codigo='$codigo'";
        mysqli_query($enlace, $script1);
        $script = "DELETE FROM  `llamadasProgramadas` WHERE  id = ".$fila['id'];
    	    $result = mysqli_query($enlace, $script);
    	    if (!$result){
    	        $arr_respuesta['msj'] = 'Error al eliminar gestión';
    	        $arr_respuesta['q0'] = $script;
    
    	    }
    	    else{
    	        file_put_contents('log_delete_geston_'.date('Ymd').'.log', $script, FILE_APPEND );
    	        $arr_respuesta['error'] = false;
    	        $arr_respuesta['msj'] = 'Gestión eliminada';
    	    }    
    }
    else{
        $arr_respuesta['msj'] = 'Error al obtener datos de llamadas';
        $arr_respuesta['q1'] = $sql;
    }
}
else{
    
    /*$script = "UPDATE `DatosClientes` SET `comentarios`='$comentHistorico',`comentarios_gestion`='$comentFinal',`estado`='Acepto' WHERE codigo='$id_cliente'";
    mysqli_query($enlace, $script);
    */ 
    $puede = 1;
    
    
    $sql = "SELECT * from Gestion_acepto WHERE primaryk = '$id_gestion'";
    
    $resultado = mysqli_query($enlace, $sql);
    if($resultado){
        $fecha_acepto = '';
        $hora_acepto = '';
        
        $num_filas=0;
        while ($fila_aux = mysqli_fetch_array($resultado)) {
           $num_filas++;
           $fecha_acepto=$fila_aux['fecha_acepto'];
           $hora_acepto=$fila_aux['hora_acepto'];
           
        }
        
        if( $num_filas == 1 ){
            $comentFinal = '\n----------INICIA COMENTARIO----------- \n Se eliminó gestión con fecha:' . $fecha_acepto . "\n y hora:" . 
            $hora_acepto. '\n' . ' usuario: '. $_SESSION['usuario'] . '\n----------TERMINA COMENTARIO-----------';
            $script1 = "UPDATE `DatosClientes` SET `comentarios`='$comentHistorico', `comentarios_gestion`='$comentFinal',`estado`='Por gestionar' WHERE codigo='$codigo'";
            mysqli_query($enlace, $script1);
            
            $script = "DELETE FROM  `Gestion_acepto` WHERE  primaryk = '$id_gestion'";
    	    $result = mysqli_query($enlace, $script);
    	    if (!$result){
    	        $arr_respuesta['msj'] = 'Error al eliminar gestión';
    	        $arr_respuesta['q1'] = $script;
    	    }
    	    else{
    	        file_put_contents('log_delete_geston_'.date('Ymd').'.log', $script, FILE_APPEND );
    	        $arr_respuesta['error'] = false;
    	        $arr_respuesta['msj'] = 'Gestión eliminada';
    	    }
    
        }
        else if( $num_filas == 0){
            $arr_respuesta['msj'] = 'No hay registros con id Gestión :'.$id_gestion;
        }
        else{
            $arr_respuesta['msj'] = 'Hay más de un resultado con id:'.$id_gestion;
        }
    	
    }
    else{
        $arr_respuesta['msj'] = 'No hay registros con id Gestión :'.$id_gestion;
    }
}
echo json_encode($arr_respuesta);

?>