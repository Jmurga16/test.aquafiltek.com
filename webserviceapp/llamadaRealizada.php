<?php 
include("connect.php");

$idc=$_POST['cl'];


$script="UPDATE `llamadasProgramadas` SET `realizada`=1 WHERE id_cliente='$idc'";
echo mysqli_query($enlace,$script);
 ?>