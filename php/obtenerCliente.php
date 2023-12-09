<?php 
include("connect.php");

$id = $_POST['id'];

$data = mysqli_query($enlace,"SELECT * FROM DatosClientes WHERE codigo = '$id'");
$data1 = mysqli_fetch_array($data);

$tabla = "".$data1['codigo']."=".$data1['coordenadas']."=".$data1['nombre_completo']."=".$data1['Datos_factura']."=".$data1['direccion']."=".$data1['telefono']."=".$data1['tipo_persona_tel_cliente']."=".$data1['obser_tel_cliente']."=".$data1['telefono_oficina']."=".$data1['tipo_persona_tel_of']."=".$data1['obser_tel_of']."=".$data1['celular1']."=".$data1['tipo_persona_cel1']."=".$data1['obser_cel1']."=".$data1['correo']."=".$data1['comentarios']."=".$data1['info_cisterna']."=".$data1['numero_libre']."";



echo $tabla;
include("QuitDB.php");
 ?>
