<?php


class Foo
{
    
	
	function convertir($id)
	{	
		$retorno="";

		if($id=="1"){
			$retorno="Señor";
		}
		if($id=="2"){
			$retorno= "Señora";
		}
		if($id=="3"){
			$retorno= "Hijo/a";
		}
		if($id=="4"){
			$retorno= "Asistente oficina";
		}
		if($id=="5"){
			$retorno= "Empleada domestica";
		}

		return $retorno;
	}


}

$foo = new Foo();
//echo $foo->convertir(1);  // Esto llama a $foo->Variable()


//exit();

// ide, id_ant , id_next , id_next2
include "connect.php";
$iden_actual = $_POST['id_act'];
$iden_ant = $_POST['id_ant'];
$iden_nxt = $_POST['id_next'];
$iden_nxt2 = $_POST['id_next2'];
$total = "";

$script1 = "SELECT * FROM `DatosClientes` WHERE codigo ='$iden_actual'";
$script2 = "SELECT * FROM `DatosClientes` WHERE codigo ='$iden_nxt'";
$script3 = "SELECT * FROM `DatosClientes` WHERE codigo ='$iden_nxt2'";
$script4 = "SELECT * FROM `DatosClientes` WHERE codigo ='$iden_ant'";
$scripto="SELECT di.user as operador, cg.fecha_gestionp FROM Clientes_gestionados as cg INNER JOIN DatosIngreso as di ON cg.id_operador=di.id AND cg.id_cliente='$iden_actual'";



$resultado = mysqli_query($enlace, $script1);
$fila = mysqli_fetch_array($resultado);
$dataO = mysqli_fetch_array(mysqli_query($enlace,$scripto));
$total .= $fila['codigo'] . "~" . $fila['coordenadas'] . "~" . $fila['nombre_completo'] . "~" . $fila['Datos_factura'] . "~" . $fila['direccion'] . "~" . $fila['telefono'] . "~" .$fila['telefono_oficina'] . "~" . $fila['celular1'] . "~" . $fila['celular2'] . "~" . $fila['correo'] . "~" . $fila['comentarios'] . "~" . $fila['estado'] . "~" .$fila['comentarios_gestion'] . "~" . $fila['info_cisterna'] . "~" . $dataO['fecha_gestionp']. "~". $dataO['operador'] . "~" . $foo->convertir($fila['tipo_persona_tel_cliente']). "~" . $fila['obser_tel_cliente']. "~" . $foo->convertir($fila['tipo_persona_tel_of']). "~" . $fila['obser_tel_of'].  "~"  . $foo->convertir($fila['tipo_persona_cel1']). "~" . $fila['obser_cel1'].  "~"  . $foo->convertir($fila['tipo_persona_cel2']). "~" . $fila['obser_cel2'].   "|";
//$total .= $fila['codigo'] . "~" . $fila['coordenadas'] . "~" . $fila['nombre_completo'] . "~" . $fila['Datos_factura'] . "~" . $fila['direccion'] . "~" . $fila['telefono'] . "~" .$fila['telefono_oficina'] . "~" . $fila['celular1'] . "~" . $fila['celular2'] . "~" . $fila['correo'] . "~ no ~" . $fila['estado'] . "~ si ~" . $fila['info_cisterna'] . "~" . $dataO['fecha_gestionp']. "~". $dataO['operador'] . "~" . $foo->convertir($fila['tipo_persona_tel_cliente']). "~" . $fila['obser_tel_cliente']. "~" . $foo->convertir($fila['tipo_persona_tel_of']). "~" . $fila['obser_tel_of'].  "~"  . $foo->convertir($fila['tipo_persona_cel1']). "~" . $fila['obser_cel1'].  "~"  . $foo->convertir($fila['tipo_persona_cel2']). "~" . $fila['obser_cel2'].   "|";

//$total .= $fila['codigo'] . "~" . $fila['coordenadas'] . "~" . $fila['nombre_completo'] . "~" . $fila['Datos_factura'] . "~" . $fila['direccion'] . "~" . $fila['telefono'] . "~" .$fila['telefono_oficina'] . "~" . $fila['celular1'] . "~" . $fila['celular2'] . "~" . $fila['correo'] . "~ no ~" . $fila['estado'] . "~ si ~" . $fila['info_cisterna'] . "~" . $dataO['fecha_gestionp']. "~". $dataO['operador'] . "~" . $foo->convertir($fila['tipo_persona_tel_cliente']). "~" . $fila['obser_tel_cliente']. "~" . $foo->convertir($fila['tipo_persona_tel_of']). "~" . $fila['obser_tel_of'].  "~"  . $foo->convertir($fila['tipo_persona_cel1']). "~" . $fila['obser_cel1'].  "~"  . $foo->convertir($fila['tipo_persona_cel2']). "~" . $fila['obser_cel2'].   "|";

//echo $total;
//exit();


$resultado = mysqli_query($enlace, $script2);
$fila = mysqli_fetch_array($resultado);
$total = $total . "NXT~";
if (mysqli_num_rows($resultado) > 0) {
	$total = $total . $fila['codigo'] . "~" . $fila['coordenadas'] . "~" . $fila['nombre_completo'] . "~" . $fila['Datos_factura'] . "~" . $fila['direccion'] . "~" . $fila['telefono'] . "~" . $fila['telefono_oficina'] . "~" . $fila['celular1'] . "~" . $fila['celular2'] . "~" . $fila['correo'] . "~" . $fila['comentarios'] . "~" . $fila['estado'] . "~" . $fila['comentarios_gestion'] . "~" . $fila['info_cisterna'] ."~". $fila['fecha_gestion'] . "~" . $foo->convertir($fila['tipo_persona_tel_cliente']). "~" . $fila['obser_tel_cliente']. "~" . $foo->convertir($fila['tipo_persona_tel_of']). "~" . $fila['obser_tel_of'].  "~"  . $foo->convertir($fila['tipo_persona_cel1']). "~" . $fila['obser_cel1'].  "~"  . $foo->convertir($fila['tipo_persona_cel2']). "~" . $fila['obser_cel2'].   "|";
} else {
	$total = $total . "|";
}



$resultado = mysqli_query($enlace, $script3);
$fila = mysqli_fetch_array($resultado);
$total = $total . "NXT2~";
if (mysqli_num_rows($resultado) > 0) {
	$total = $total . $fila['codigo'] . "~" . $fila['coordenadas'] . "~" . $fila['nombre_completo'] . "~" . $fila['Datos_factura'] . "~" . $fila['direccion'] . "~" . $fila['telefono'] . "~" . $fila['telefono_oficina'] . "~" . $fila['celular1'] . "~" . $fila['celular2'] . "~" . $fila['correo'] . "~" . $fila['comentarios'] . "~" . $fila['estado'] . "~" . $fila['comentarios_gestion'] . "~" . $fila['info_cisterna'] . "~" . $fila['fecha_gestion'] . "~" . $foo->convertir($fila['tipo_persona_tel_cliente']). "~" . $fila['obser_tel_cliente']. "~" . $foo->convertir($fila['tipo_persona_tel_of']). "~" . $fila['obser_tel_of'].  "~"  . $foo->convertir($fila['tipo_persona_cel1']). "~" . $fila['obser_cel1'].  "~"  . $foo->convertir($fila['tipo_persona_cel2']). "~" . $fila['obser_cel2'].  "|";
} else {
	$total = $total . "|";
}


$resultado = mysqli_query($enlace, $script4);
$fila = mysqli_fetch_array($resultado);
$total = $total . "ANT~";
if (mysqli_num_rows($resultado) > 0) {
	$total = $total . $fila['codigo'] . "~" . $fila['coordenadas'] . "~" . $fila['nombre_completo'] . "~" . $fila['Datos_factura'] . "~" . $fila['direccion'] . "~" . $fila['telefono'] . "~" . $fila['telefono_oficina'] . "~" . $fila['celular1'] . "~" . $fila['celular2'] . "~" . $fila['correo'] . "~" . $fila['comentarios'] . "~" . $fila['estado'] . "~" . $fila['comentarios_gestion'] . "~" . $fila['info_cisterna'] . "~" . $fila['fecha_gestion'] . "~" . $foo->convertir($fila['tipo_persona_tel_cliente']). "~" . $fila['obser_tel_cliente']. "~" . $foo->convertir($fila['tipo_persona_tel_of']). "~" . $fila['obser_tel_of'].  "~"  . $foo->convertir($fila['tipo_persona_cel1']). "~" . $fila['obser_cel1'].  "~"  . $foo->convertir($fila['tipo_persona_cel2']). "~" . $fila['obser_cel2'].  "|";
} else {
	$total = $total . "|";
}



echo $total;
include "QuitDB.php";





?>
