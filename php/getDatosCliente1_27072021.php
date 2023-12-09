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


	function validar_obser($dato)
	{	
		$retorno=$dato;
		if($dato=="NULL" || $dato==NULL ){
			$retorno="";
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
$principal = array(); 

if (mysqli_num_rows($resultado) > 0) {
	$principal["estatus"]="encontrado";
	$principal["codigo"]=$fila['codigo'];
	$principal["coordenadas"]=$fila['coordenadas'];
	$principal["nombre_completo"]=$fila['nombre_completo'];
	$principal["Datos_factura"]=$fila['Datos_factura'];
	$principal["direccion"]=$fila['direccion'];
	$principal["telefono"]=$fila['telefono'];
	$principal["telefono_oficina"]=$fila['telefono_oficina'];
	$principal["celular1"]=$fila['celular1'];
	$principal["celular2"]=$fila['celular2'];
	$principal["correo"]=$fila['correo'];
	$principal["comentarios"]=$fila['comentarios'];
	$principal["estado"]=$fila['estado'];
	$principal["comentarios_gestion"]=$fila['comentarios_gestion'];
	$principal["info_cisterna"]=$fila['info_cisterna'];
	$principal["fecha_gestionp"]=$dataO['fecha_gestionp'];
	$principal["operador"]=$dataO['operador'];
	$principal["tipo_persona_tel_cliente"]=$foo->convertir($fila['tipo_persona_tel_cliente']);
	$principal["obser_tel_cliente"]=$foo->validar_obser($fila['obser_tel_cliente']);
	$principal["tipo_persona_tel_of"]=$foo->convertir($fila['tipo_persona_tel_of']);
	$principal["obser_tel_of"]=$foo->validar_obser($fila['obser_tel_of']);
	$principal["tipo_persona_cel1"]=$foo->convertir($fila['tipo_persona_cel1']);
	$principal["obser_cel1"]=$foo->validar_obser($fila['obser_cel1']);
	$principal["tipo_persona_cel2"]=$foo->convertir($fila['tipo_persona_cel2']);
	$principal["obser_cel2"]=$foo->validar_obser($fila['obser_cel2']);

}
else{
	$principal["estatus"]="no_encontrado";
}



$resultado = mysqli_query($enlace, $script2);
$fila = mysqli_fetch_array($resultado);
if (mysqli_num_rows($resultado) > 0) {

	$siguiente["estatus"]="encontrado";
	$siguiente["codigo"]=$fila['codigo'];
	$siguiente["coordenadas"]=$fila['coordenadas'];
	$siguiente["nombre_completo"]=$fila['nombre_completo'];
	$siguiente["Datos_factura"]=$fila['Datos_factura'];
	$siguiente["direccion"]=$fila['direccion'];
	$siguiente["telefono"]=$fila['telefono'];
	$siguiente["telefono_oficina"]=$fila['telefono_oficina'];
	$siguiente["celular1"]=$fila['celular1'];
	$siguiente["celular2"]=$fila['celular2'];
	$siguiente["correo"]=$fila['correo'];
	$siguiente["comentarios"]=$fila['comentarios'];
	$siguiente["estado"]=$fila['estado'];
	$siguiente["comentarios_gestion"]=$fila['comentarios_gestion'];
	$siguiente["info_cisterna"]=$fila['info_cisterna'];
	$siguiente["fecha_gestion"]=$fila['fecha_gestion'];
	$siguiente["tipo_persona_tel_cliente"]=$foo->convertir($fila['tipo_persona_tel_cliente']);
	$siguiente["obser_tel_cliente"]=$foo->validar_obser($fila['obser_tel_cliente']);
	$siguiente["tipo_persona_tel_of"]=$foo->convertir($fila['tipo_persona_tel_of']);
	$siguiente["obser_tel_of"]=$foo->validar_obser($fila['obser_tel_of']);
	$siguiente["tipo_persona_cel1"]=$foo->convertir($fila['tipo_persona_cel1']);
	$siguiente["obser_cel1"]=$foo->validar_obser($fila['obser_cel1']);
	$siguiente["tipo_persona_cel2"]=$foo->convertir($fila['tipo_persona_cel2']);
	$siguiente["obser_cel2"]=$foo->validar_obser($fila['obser_cel2']);


} else {
	$siguiente["estatus"]="no_encontrado";

}




$resultado = mysqli_query($enlace, $script3);
$fila = mysqli_fetch_array($resultado);
if (mysqli_num_rows($resultado) > 0) {

	$siguiente2["estatus"]="encontrado";
	$siguiente2["codigo"]=$fila['codigo'];
	$siguiente2["coordenadas"]=$fila['coordenadas'];
	$siguiente2["nombre_completo"]=$fila['nombre_completo'];
	$siguiente2["Datos_factura"]=$fila['Datos_factura'];
	$siguiente2["direccion"]=$fila['direccion'];
	$siguiente2["telefono"]=$fila['telefono'];
	$siguiente2["telefono_oficina"]=$fila['telefono_oficina'];
	$siguiente2["celular1"]=$fila['celular1'];
	$siguiente2["celular2"]=$fila['celular2'];
	$siguiente2["correo"]=$fila['correo'];
	$siguiente2["comentarios"]=$fila['comentarios'];
	$siguiente2["estado"]=$fila['estado'];
	$siguiente2["comentarios_gestion"]=$fila['comentarios_gestion'];
	$siguiente2["info_cisterna"]=$fila['info_cisterna'];
	$siguiente2["fecha_gestion"]=$fila['fecha_gestion'];
	$siguiente2["tipo_persona_tel_cliente"]=$foo->convertir($fila['tipo_persona_tel_cliente']);
	$siguiente2["obser_tel_cliente"]=$foo->validar_obser($fila['obser_tel_cliente']);
	$siguiente2["tipo_persona_tel_of"]=$foo->convertir($fila['tipo_persona_tel_of']);
	$siguiente2["obser_tel_of"]=$foo->validar_obser($fila['obser_tel_of']);
	$siguiente2["tipo_persona_cel1"]=$foo->convertir($fila['tipo_persona_cel1']);
	$siguiente2["obser_cel1"]=$foo->validar_obser($fila['obser_cel1']);
	$siguiente2["tipo_persona_cel2"]=$foo->convertir($fila['tipo_persona_cel2']);
	$siguiente2["obser_cel2"]=$foo->validar_obser($fila['obser_cel2']);


} else {
	$siguiente2["estatus"]="no_encontrado";

}



$resultado = mysqli_query($enlace, $script4);
$fila = mysqli_fetch_array($resultado);
if (mysqli_num_rows($resultado) > 0) {


	$anterior["estatus"]="encontrado";
	$anterior["codigo"]=$fila['codigo'];
	$anterior["coordenadas"]=$fila['coordenadas'];
	$anterior["nombre_completo"]=$fila['nombre_completo'];
	$anterior["Datos_factura"]=$fila['Datos_factura'];
	$anterior["direccion"]=$fila['direccion'];
	$anterior["telefono"]=$fila['telefono'];
	$anterior["telefono_oficina"]=$fila['telefono_oficina'];
	$anterior["celular1"]=$fila['celular1'];
	$anterior["celular2"]=$fila['celular2'];
	$anterior["correo"]=$fila['correo'];
	$anterior["comentarios"]=$fila['comentarios'];
	$anterior["estado"]=$fila['estado'];
	$anterior["comentarios_gestion"]=$fila['comentarios_gestion'];
	$anterior["info_cisterna"]=$fila['info_cisterna'];
	$anterior["fecha_gestion"]=$fila['fecha_gestion'];
	$anterior["tipo_persona_tel_cliente"]=$foo->convertir($fila['tipo_persona_tel_cliente']);
	$anterior["obser_tel_cliente"]=$foo->validar_obser($fila['obser_tel_cliente']);
	$anterior["tipo_persona_tel_of"]=$foo->convertir($fila['tipo_persona_tel_of']);
	$anterior["obser_tel_of"]=$foo->validar_obser($fila['obser_tel_of']);
	$anterior["tipo_persona_cel1"]=$foo->convertir($fila['tipo_persona_cel1']);
	$anterior["obser_cel1"]=$foo->validar_obser($fila['obser_cel1']);
	$anterior["tipo_persona_cel2"]=$foo->convertir($fila['tipo_persona_cel2']);
	$anterior["obser_cel2"]=$foo->validar_obser($fila['obser_cel2']);


} else {
	$anterior["estatus"]="no_encontrado";

}




include "QuitDB.php";

$rertorna["principal"]=$principal;
$rertorna["siguiente"]=$siguiente;
$rertorna["siguiente2"]=$siguiente2;
$rertorna["anterior"]=$anterior;



echo json_encode($rertorna);



?>
