<?php
include "connect.php";

$porciones = explode(":", trim($_POST["hora"]));
$fd=str_pad($porciones[0], 2, "0", STR_PAD_LEFT);
$fd1=str_pad($porciones[1], 2, "0", STR_PAD_LEFT);
$fd2=str_pad($porciones[2], 2, "0", STR_PAD_LEFT);

$hora = $fd.":".$fd1.":".$fd2;	 



$newDate1 = strtotime ( '-59 minute' , strtotime($hora) ) ; 
$inicio = date ( 'H:i:s' , $newDate1); 

//28072021
$id_gestion = isset($_POST["id_gestion"])?(int)$_POST["id_gestion"]:-1;


$newDate2 = strtotime ( '+59 minute' , strtotime($hora) ) ; 
$fin = date ( 'H:i:s' , $newDate2); 



$query = "SELECT ga.primaryk as id, dc.nombre_completo, dc.telefono, di.user, STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y') as fecha, ga.hora_acepto
FROM `Gestion_acepto` AS ga 
JOIN DatosClientes as dc on dc.codigo=ga.codigo_cliente 
join Clientes_gestionados as cg on cg.id_cliente=ga.codigo_cliente 
join DatosIngreso as di on di.id=cg.id_operador where (STR_TO_DATE(ga.fecha_acepto, '%d/%m/%Y'))='".$_REQUEST["fecha"]."' and 
(TIME_FORMAT(ga.hora_acepto, '%H:%i:%s')) BETWEEN '".$inicio."' and  '".$fin."' and ga.primaryk != ".$id_gestion." ";






$resultado = mysqli_query($enlace, $query);
$fila = mysqli_fetch_array($resultado);

if (mysqli_num_rows($resultado) > 0) {

	$conr["mensaje"]=$fila["hora_acepto"];
	$conr["estado"]="false";
	
} else {
	$conr["estado"]="insertar";
}







echo json_encode($conr);

include "QuitDB.php";
?>