<?php 
include("connect.php");

$id = $_POST['id'];

$lib = "DELETE FROM grupo_asignacion WHERE id_grupo = '".$id."'";
$ejeclib = mysqli_query($enlace,$lib);

$sql = "DELETE FROM grupos WHERE id = '".$id."'";
$ejecutar = mysqli_query($enlace,$sql);


include("QuitDB.php");
 ?>
