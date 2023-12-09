<?php
$id= $_POST['id'];
include 'connect.php';
mysqli_query($enlace,"UPDATE `DatosClientes` SET `actual_gestion`=1 WHERE codigo='$id'");
include 'QuitDB.php';
 ?>
