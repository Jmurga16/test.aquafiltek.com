<?php 
include("connect.php");

$provincia = $_POST['provincia'];
$nombre = $_POST['nombre'];
$canton = $_POST['canton'];
$comentario = $_POST['comentario'];
$parroquia = $_POST['parroquia'];

$sql = "INSERT INTO grupos (nombre, idprov, idcanton, idparroquia, comentario) VALUES ('$nombre','$provincia','$canton','$parroquia','$comentario')";
$ejecutar = mysqli_query($enlace,$sql);


include("QuitDB.php");
 ?>
