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
    //$tipo = $_POST['tipo'];
    $operador = $_SESSION['ide'];
    $tiempo = $_POST['tiempo'];
    $tipo_gestion = $_POST['tipo_gestion'];
    
    $fecha_gestion = date('Y-m-d H:i:s');
    
    $script = "SELECT id_alternativo  FROM `tipos_gestion` WHERE id=".$tipo_gestion;
    $arr_response["q1"] = $script;
        
    $descripcion = '';
    $fila = mysqli_fetch_array(mysqli_query($enlace, $script));
    if(!isset($fila['id_alternativo'])){
        $arr_response["msj"] = "No se econtró tipo gestión con id:".$tipo_gestion;
        
    }
    else{
        $tipo = $fila['id_alternativo'];
        $arr_response["id_alternativo"]=$tipo;
        
        if ($tipo>0) {
            $fichero ="log_guardar_tiempo_otros_".date("Ymd").".log"; 
            $fecha_log=date("Y-m-d H:i:s");
            $log="--------".$fecha_log."-------------".PHP_EOL;
            $log.="operador:".$operador."-cliente:".$cliente."-tiempo:".$tiempo."-tipo:".$tipo.PHP_EOL;
            
        	mysqli_query($enlace, "DELETE FROM `clientes_gestionados_otros` WHERE id_cliente='$cliente' AND id_tipo_geston = ".$tipo_gestion);
        	$sql_insert = "INSERT INTO `clientes_gestionados_otros`(`id_operador`, `id_cliente`,`fecha_gestion`,`id_tipo_gestion`  ) 
        	VALUES ($operador,'$cliente','$fecha_gestion',$tipo_gestion)";
        	$arr_response["sql_insert"]=$sql_insert;
        	$result = mysqli_query($enlace, $sql_insert);
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
        $sql_t_gestion = "INSERT INTO `tiempo_gestion`(`id_operador`, `id_cliente`, `tiempo_total`, `tipo`) VALUES ($operador,'$cliente','$tiempo','$tipo')";
        
        $arr_response["sql_t_gestion"]=$sql_t_gestion;
        mysqli_query($enlace,$sql_t_gestion );
        mysqli_query($enlace, "DELETE FROM `tiempo_gestion` WHERE `id_cliente`='NO_MOSTRAR'");
        mysqli_query($enlace, "DELETE FROM `tiempo_gestion` WHERE `tiempo_total`='00:00:00'");
        
        
    }
    include 'QuitDB.php';
    
    echo json_encode($arr_response);
    
}