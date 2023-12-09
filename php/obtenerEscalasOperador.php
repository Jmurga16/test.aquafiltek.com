<?php
session_start();
$arr_respuesta = ['error'=>true,'msj'=>''];

if(!isset($_SESSION['ide']) || $_SESSION['ide'] == NULL){
    $arr_respuesta['msj']='Debe iniciar sesión';
    echo json_encode($arr_respuesta);

    exit();
}
include "connect.php";


$idoperador = isset($_POST['idoperador'])?(int)$_POST['idoperador']:-1;
if($idoperador == -1 ){
    $arr_respuesta['msj']='Debe enviar id de operador';
    echo json_encode($arr_respuesta);

    exit();

}
$sql = "SELECT * from usuario_escala WHERE usuario_id = '$idoperador'";

$resultado = mysqli_query($enlace, $sql);
if($resultado){
    $num_filas=0;
    while ($fila_aux = mysqli_fetch_array($resultado)) {
       $num_filas++;
       
       $arr_escala['id']=$fila_aux['escala_id'];
       $arr_escala['numero']=$fila_aux['numero'];
       $arr_escala['fecha']=$fila_aux['fecha'];
       $arr_respuesta['escalas'][]=$arr_escala;
    }
    $arr_respuesta['error'] = false;
    $arr_respuesta['filas'] = $num_filas;
    
	
}
else{
    $arr_respuesta['msj'] = 'Error al obtener escalas paraoperador :'.$idoperador;
}
echo json_encode($arr_respuesta);

?>