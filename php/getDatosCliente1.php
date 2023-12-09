<?php
error_reporting(0);

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
//nuevos 27072021
$iden_nxt3 = $_POST['id_next3'];
$iden_ant2 = $_POST['id_ant2'];
$iden_ant3 = $_POST['id_ant3'];


$total = "";



//buscar 3 por gestionar por si acaso
$hoy_dia = date('d');
$hoy_mes = date('m');
$hoy_anual = date('Y');
$hoy_anual = $hoy_anual-1;


$n_script = "SELECT * FROM `DatosClientes` WHERE estado = 'Por gestionar' AND actual_gestion = 0 AND inactivo = 0 AND fecha_gestion < '".$hoy_anual."-".$hoy_mes."-".$hoy_dia."' LIMIT 4";
$nuevo_script = mysqli_query($enlace,$n_script);
$ia = 1;
while($pguser = mysqli_fetch_array($nuevo_script))
{
	if($ia == 1)
	{
		$idnpg1 = $pguser['codigo'];
	}
	elseif($ia == 2)
	{
		$idnpg2 = $pguser['codigo'];
	}
	elseif($ia == 3)
	{
		$idnpg3 = $pguser['codigo'];
	}
	else
	{
		$idnpg_act = $pguser['codigo'];
	}
	
	$ia++;
}



//reemplezar ids vacios por ids de clientes por gestionar
$script2 = "SELECT * FROM `DatosClientes` WHERE codigo ='$iden_nxt'";
$script3 = "SELECT * FROM `DatosClientes` WHERE codigo ='$iden_nxt2'";
$script5 = "SELECT * FROM `DatosClientes` WHERE codigo ='$iden_nxt3'";
$script1 = "SELECT dc.*,GROUP_CONCAT(ga.fecha_acepto) as fechas FROM `DatosClientes` as dc LEFT JOIN Gestion_acepto as ga 
ON dc.codigo = ga.codigo_cliente WHERE dc.codigo ='$iden_actual' ORDER BY STR_TO_DATE(ga.fecha_acepto, '%d/%m/%Y') DESC LIMIT 5";

/*
if($iden_nxt == '-1')
{
	$script2 = "SELECT * FROM `DatosClientes` WHERE codigo ='$idnpg1'";
}
if($iden_nxt2 == '-1')
{
	$script3 = "SELECT * FROM `DatosClientes` WHERE codigo ='$idnpg2'";
}
if($iden_nxt3 == '-1')
{
	$script5 = "SELECT * FROM `DatosClientes` WHERE codigo ='$idnpg3'";
}

*/

if($iden_actual == '-1')
{
	$script1 = "SELECT dc.*,GROUP_CONCAT(ga.fecha_acepto) as fechas FROM `DatosClientes` as dc LEFT JOIN Gestion_acepto as ga 
ON dc.codigo = ga.codigo_cliente WHERE dc.codigo ='$idnpg_act' ORDER BY STR_TO_DATE(ga.fecha_acepto, '%d/%m/%Y') DESC LIMIT 5";

}
$rertorna['sql']=$script1;


$script4 = "SELECT * FROM `DatosClientes` WHERE codigo ='$iden_ant'";
//27072021
$script6 = "SELECT * FROM `DatosClientes` WHERE codigo ='$iden_ant2'";
$script7 = "SELECT * FROM `DatosClientes` WHERE codigo ='$iden_ant3'";




$scripto="SELECT di.user as operador, cg.fecha_gestionp FROM Clientes_gestionados as cg INNER JOIN DatosIngreso as di ON cg.id_operador=di.id AND cg.id_cliente='$iden_actual'";





$resultado = mysqli_query($enlace, $script1);
$fila = mysqli_fetch_array($resultado);
$dataO = mysqli_fetch_array(mysqli_query($enlace,$scripto));
$principal = array(); 
$n_filas = 1;
if (mysqli_num_rows($resultado) > 0) {
    if( $n_filas > 1)
    //break;
    $n_filas++;
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
	$principal["inactivo"]=$fila['inactivo'];
    //$principal["fechas"]=$fila['fechas'];
    $principal["numero_libre"]=$fila['numero_libre'];
    $sql_fechas = "SELECT fecha_acepto, id_tipo_gestion from Gestion_acepto where codigo_cliente = '".$fila['codigo']."' ORDER BY  STR_TO_DATE(fecha_acepto, '%d/%m/%Y') DESC limit 5 ";
    $resultado_fechas = mysqli_query($enlace, $sql_fechas);
    $arr_fechas = [];
    $principal["aq_fechas"] = $sql_fechas;
    if($resultado_fechas){
        while($fila_fecha = mysqli_fetch_array($resultado_fechas)){
            $arr_fechas[]=$fila_fecha['fecha_acepto'].'|'.$fila_fecha['id_tipo_gestion'];
        }
    }
    $principal["fechas"] = implode(',',$arr_fechas);

	$nuevos_coment = "SELECT * FROM comentarios WHERE comentarios.id_cliente = '".$fila['codigo']."' ORDER BY id DESC";
	$necs = [];
	$resultnc = mysqli_query($enlace,$nuevos_coment);
	if($resultnc)
	{
		while($filacoment = mysqli_fetch_array($resultnc))
		{
			if($filacoment['id_operador'] != '')
			{
				$opid = $filacoment['id_operador'];
				$nombre_operador = mysqli_query($enlace,"SELECT * FROM DatosIngreso WHERE id = '$opid'");
				$nop = mysqli_fetch_array($nombre_operador);
				$necs[]=$filacoment['comentario'].'|'.$filacoment['fecha'].'|'.$filacoment['hora'].'|'.$filacoment['estado'].'|'.$filacoment['fecha_gestion'].'|'.$filacoment['hora_gestion'].'|'.$nop['user'];
			}
			else
			{
				$necs[]=$filacoment['comentario'].'|'.$filacoment['fecha'].'|'.$filacoment['hora'].'|'.$filacoment['estado'].'|'.$filacoment['fecha_gestion'].'|'.$filacoment['hora_gestion'].'|'.$filacoment['id_operador'];
			}
			
		}

		
	}
	else
	{
		
	}

	$principal["newc"] = implode('~',$necs);
	$principal["inactivo"] = $fila["inactivo"];

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

//siguiente 3
$resultado = mysqli_query($enlace, $script5);
$fila = mysqli_fetch_array($resultado);
if (mysqli_num_rows($resultado) > 0) {

	$siguiente3["estatus"]="encontrado";
	$siguiente3["codigo"]=$fila['codigo'];
	$siguiente3["coordenadas"]=$fila['coordenadas'];
	$siguiente3["nombre_completo"]=$fila['nombre_completo'];
	$siguiente3["Datos_factura"]=$fila['Datos_factura'];
	$siguiente3["direccion"]=$fila['direccion'];
	$siguiente3["telefono"]=$fila['telefono'];
	$siguiente3["telefono_oficina"]=$fila['telefono_oficina'];
	$siguiente3["celular1"]=$fila['celular1'];
	$siguiente3["celular2"]=$fila['celular2'];
	$siguiente3["correo"]=$fila['correo'];
	$siguiente3["comentarios"]=$fila['comentarios'];
	$siguiente3["estado"]=$fila['estado'];
	$siguiente3["comentarios_gestion"]=$fila['comentarios_gestion'];
	$siguiente3["info_cisterna"]=$fila['info_cisterna'];
	$siguiente3["fecha_gestion"]=$fila['fecha_gestion'];
	$siguiente3["tipo_persona_tel_cliente"]=$foo->convertir($fila['tipo_persona_tel_cliente']);
	$siguiente3["obser_tel_cliente"]=$foo->validar_obser($fila['obser_tel_cliente']);
	$siguiente3["tipo_persona_tel_of"]=$foo->convertir($fila['tipo_persona_tel_of']);
	$siguiente3["obser_tel_of"]=$foo->validar_obser($fila['obser_tel_of']);
	$siguiente3["tipo_persona_cel1"]=$foo->convertir($fila['tipo_persona_cel1']);
	$siguiente3["obser_cel1"]=$foo->validar_obser($fila['obser_cel1']);
	$siguiente3["tipo_persona_cel2"]=$foo->convertir($fila['tipo_persona_cel2']);
	$siguiente3["obser_cel2"]=$foo->validar_obser($fila['obser_cel2']);


} else {
	$siguiente2["estatus"]="no_encontrado";

}
//end siguiente 3

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


//anterior 2
$resultado = mysqli_query($enlace, $script6);
$fila = mysqli_fetch_array($resultado);
if (mysqli_num_rows($resultado) > 0) {


	$anterior2["estatus"]="encontrado";
	$anterior2["codigo"]=$fila['codigo'];
	$anterior2["coordenadas"]=$fila['coordenadas'];
	$anterior2["nombre_completo"]=$fila['nombre_completo'];
	$anterior2["Datos_factura"]=$fila['Datos_factura'];
	$anterior2["direccion"]=$fila['direccion'];
	$anterior2["telefono"]=$fila['telefono'];
	$anterior2["telefono_oficina"]=$fila['telefono_oficina'];
	$anterior2["celular1"]=$fila['celular1'];
	$anterior2["celular2"]=$fila['celular2'];
	$anterior2["correo"]=$fila['correo'];
	$anterior2["comentarios"]=$fila['comentarios'];
	$anterior2["estado"]=$fila['estado'];
	$anterior2["comentarios_gestion"]=$fila['comentarios_gestion'];
	$anterior2["info_cisterna"]=$fila['info_cisterna'];
	$anterior2["fecha_gestion"]=$fila['fecha_gestion'];
	$anterior2["tipo_persona_tel_cliente"]=$foo->convertir($fila['tipo_persona_tel_cliente']);
	$anterior2["obser_tel_cliente"]=$foo->validar_obser($fila['obser_tel_cliente']);
	$anterior2["tipo_persona_tel_of"]=$foo->convertir($fila['tipo_persona_tel_of']);
	$anterior2["obser_tel_of"]=$foo->validar_obser($fila['obser_tel_of']);
	$anterior2["tipo_persona_cel1"]=$foo->convertir($fila['tipo_persona_cel1']);
	$anterior2["obser_cel1"]=$foo->validar_obser($fila['obser_cel1']);
	$anterior2["tipo_persona_cel2"]=$foo->convertir($fila['tipo_persona_cel2']);
	$anterior2["obser_cel2"]=$foo->validar_obser($fila['obser_cel2']);


} else {
	$anterior["estatus"]="no_encontrado";

}

//end anterior 2

//anterior 3
$resultado = mysqli_query($enlace, $script7);
$fila = mysqli_fetch_array($resultado);
if (mysqli_num_rows($resultado) > 0) {


	$anterior3["estatus"]="encontrado";
	$anterior3["codigo"]=$fila['codigo'];
	$anterior3["coordenadas"]=$fila['coordenadas'];
	$anterior3["nombre_completo"]=$fila['nombre_completo'];
	$anterior3["Datos_factura"]=$fila['Datos_factura'];
	$anterior3["direccion"]=$fila['direccion'];
	$anterior3["telefono"]=$fila['telefono'];
	$anterior3["telefono_oficina"]=$fila['telefono_oficina'];
	$anterior3["celular1"]=$fila['celular1'];
	$anterior3["celular2"]=$fila['celular2'];
	$anterior3["correo"]=$fila['correo'];
	$anterior3["comentarios"]=$fila['comentarios'];
	$anterior3["estado"]=$fila['estado'];
	$anterior3["comentarios_gestion"]=$fila['comentarios_gestion'];
	$anterior3["info_cisterna"]=$fila['info_cisterna'];
	$anterior3["fecha_gestion"]=$fila['fecha_gestion'];
	$anterior3["tipo_persona_tel_cliente"]=$foo->convertir($fila['tipo_persona_tel_cliente']);
	$anterior3["obser_tel_cliente"]=$foo->validar_obser($fila['obser_tel_cliente']);
	$anterior3["tipo_persona_tel_of"]=$foo->convertir($fila['tipo_persona_tel_of']);
	$anterior3["obser_tel_of"]=$foo->validar_obser($fila['obser_tel_of']);
	$anterior3["tipo_persona_cel1"]=$foo->convertir($fila['tipo_persona_cel1']);
	$anterior3["obser_cel1"]=$foo->validar_obser($fila['obser_cel1']);
	$anterior3["tipo_persona_cel2"]=$foo->convertir($fila['tipo_persona_cel2']);
	$anterior3["obser_cel2"]=$foo->validar_obser($fila['obser_cel2']);


} else {
	$anterior["estatus"]="no_encontrado";

}

//end anterior 3


include "QuitDB.php";
$rertorna["principal"]=$principal;
$rertorna["siguiente"]=$siguiente;
$rertorna["siguiente2"]=$siguiente2;
$rertorna["anterior"]=$anterior;

$rertorna["siguiente3"]=$siguiente3;
$rertorna["anterior2"]=$anterior2;
$rertorna["anterior3"]=$anterior3;


echo json_encode($rertorna);



?>
