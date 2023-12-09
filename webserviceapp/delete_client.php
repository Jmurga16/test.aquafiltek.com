<?php
include 'connect.php';
$id = $_POST['id'];
echo mysqli_query($enlace,"DELETE FROM `DatosClientes` WHERE codigo ='$id'");
include 'QuitDB.php';
 ?>
