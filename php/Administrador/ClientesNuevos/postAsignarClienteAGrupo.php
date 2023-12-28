<?php
include("../../connect.php");

$idcliente = $_POST['idcliente'];
$idgrupo = $_POST['idgrupo'];
$fecha = date('Y-m-d');
$tipo = $_POST['tipo'];

$query = "INSERT INTO grupo_asignacion (`id_cliente`,`id_grupo`,`fecha_asginacion`,`tipo`) VALUES ('$idcliente','$idgrupo','$fecha',$tipo)";

mysqli_query($enlace, $query);


include("../../QuitDB.php");
?>