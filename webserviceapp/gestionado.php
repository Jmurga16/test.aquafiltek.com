<?php 
include("connect.php");
$iden_actual= $_POST['id_act'];
			$script ="SELECT * FROM `DatosClientes` WHERE codigo='$iden_actual'";
			//echo 	$script;
			//exit();
			$result =mysqli_query($enlace,$script);
			$fila = mysqli_fetch_array($result);
			
//echo $fila[0];
include("QuitDB.php");

echo json_encode($fila[0]);
 ?>	