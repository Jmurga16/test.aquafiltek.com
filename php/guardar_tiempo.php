<?php
include 'connect.php';
session_start();
$arr_response = ["error"=>1,"msj"=>"","data"=>0];
if(!isset($_SESSION['ide']) || $_SESSION['ide'] == NULL){
    $arr_response["msj"]="no tiene sesión";
}
else{
        
    
    if (isset($_POST['cliente'])) {
        $cliente = $_POST['cliente'];
    } else {
        $cliente = 'NO_MOSTRAR';
    }
    $tipo = $_POST['tipo'];
    $operador = $_SESSION['ide'];
    $tiempo = $_POST['tiempo'];
    
    if ($tipo>0) {
        $fichero ="log_guardar_tiempo_".date("Ymd").".log"; 
        $fecha_log=date("Y-m-d H:i:s");
        $log="--------".$fecha_log."-------------".PHP_EOL;
        $log.="operador:".$operador."-cliente:".$cliente."-tiempo:".$tiempo."-tipo:".$tipo.PHP_EOL;
        
    	mysqli_query($enlace, "DELETE FROM `Clientes_gestionados` WHERE id_cliente='$cliente'");
    	$result = mysqli_query($enlace, "INSERT INTO `Clientes_gestionados`(`id_operador`, `id_cliente`) VALUES ($operador,'$cliente')");
    	if($result){
    	    $arr_response["error"]=0;
    	    $arr_response["data"]=1;
    	    $log.="--correcto".PHP_EOL;
    	}else{
    	    $arr_response["msj"]="Error al guardar en clientes gestionados";
    	    $log.="--error query".PHP_EOL;
    	}
    	file_put_contents($fichero, $log, FILE_APPEND );
    }
    mysqli_query($enlace, "INSERT INTO `tiempo_gestion`(`id_operador`, `id_cliente`, `tiempo_total`, `tipo`) VALUES ($operador,'$cliente','$tiempo','$tipo')");
    mysqli_query($enlace, "DELETE FROM `tiempo_gestion` WHERE `id_cliente`='NO_MOSTRAR'");
    mysqli_query($enlace, "DELETE FROM `tiempo_gestion` WHERE `tiempo_total`='00:00:00'");
    include 'QuitDB.php';
    echo json_encode($arr_response);
    
}