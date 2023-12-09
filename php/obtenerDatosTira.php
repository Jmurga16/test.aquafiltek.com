<?php
session_start();
$arr_respuesta = ['error'=>true,'msj'=>''];

if(!isset($_SESSION['ide']) || $_SESSION['ide'] == NULL){
    $arr_respuesta['msj']='Debe iniciar sesión';
    echo json_encode($arr_respuesta);

    exit();
}
include "connect.php";



$sql = "SELECT * from tira_informativa";

$resultado = mysqli_query($enlace, $sql);
if($resultado){
    while ($fila_aux = mysqli_fetch_array($resultado)) {
       $arr_respuesta['datos']['permanente'] =  $fila_aux['permanente'];
       $arr_respuesta['datos']['minutos'] =  $fila_aux['minutos'];
       $arr_respuesta['datos']['mensaje'] =  $fila_aux['mensaje'];
       
    }
    $arr_respuesta['error'] = false;
    
	
}
else{
    $arr_respuesta['msj'] = 'Error al obtener datos de tira informativa ';
}
echo json_encode($arr_respuesta);

?>