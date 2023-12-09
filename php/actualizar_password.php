<?php 
include("connect.php");
$iden=$_POST['iden'];
$pass=md5($clavePrivada.$_POST['pass']);
$script = "UPDATE `DatosIngreso` SET `password`='$pass' WHERE id='$iden'";
	if(mysqli_query($enlace,$script)){
		include("QuitDB.php");
			echo 1;
	}
	else
	{
		printf ("Error realizando la conexion, por favor intente de nuevo mas tarde <br>");
    	printf("Errormessage: %s\n", mysqli_error($enlace));
		include("QuitDB.php");
		echo 0;
	}


 ?>