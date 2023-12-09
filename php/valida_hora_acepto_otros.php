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

$query = "SELECT ot.id, dc.nombre_completo, dc.telefono, di.user, ot.fecha, ot.hora
FROM `otras_gestiones` AS ot 
JOIN DatosClientes as dc on dc.codigo=ot.codigo_cliente 
join clientes_gestionados_otros as cg on cg.id_cliente=ot.codigo_cliente 
join DatosIngreso as di on di.id=cg.id_operador where ot.fecha='".$_REQUEST["fecha"]."' and 
ot.hora BETWEEN '".$inicio."' and  '".$fin."' and ot.id_tipo_gestion = ".$id_gestion." ";
/*
$query = "SELECT ot.id, dc.nombre_completo, dc.telefono, di.user, STR_TO_DATE(ot.fecha_acepto,'%d/%m/%Y') as fecha, ot.hora_acepto
FROM `otras_gestiones` AS ga 
JOIN DatosClientes as dc on dc.codigo=ot.codigo_cliente 
join Clientes_gestionados as cg on cg.id_cliente=ot.codigo_cliente 
join DatosIngreso as di on di.id=cg.id_operador where (STR_TO_DATE(ot.fecha_acepto, '%d/%m/%Y'))='".$_REQUEST["fecha"]."' and 
(TIME_FORMAT(ot.hora_acepto, '%H:%i:%s')) BETWEEN '".$inicio."' and  '".$fin."' and ot.primaryk != ".$id_gestion." ";

*/

$resultado = mysqli_query($enlace, $query);
$fila = mysqli_fetch_array($resultado);
if(!$resultado){
    $conr["q"]=$query;
}
if (mysqli_num_rows($resultado) > 0) {

	$conr["mensaje"]=$fila["hora"];
	$conr["estado"]="false";
	
} else {
	$conr["estado"]="insertar";
}







echo json_encode($conr);

include "QuitDB.php";
?>