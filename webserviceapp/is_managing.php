<?php
$id = $_POST['id'];
include('./connect.php');
$result=mysqli_query($enlace,"SELECT * FROM `DatosClientes` WHERE codigo ='$id' AND actual_gestion=1");
// echo mysqli_num_rows($result);
if(mysqli_num_rows($result)==0){
  echo 0;
}else{
  echo 1;
}
include('./QuitDB.php');
 ?>
