<?php
$id= $_POST['id'];
include 'connect.php';
mysqli_query($enlace,"UPDATE `DatosClientes` SET `actual_gestion`=0 WHERE codigo='$id'");
echo $id;
include 'QuitDB.php';
 ?>
