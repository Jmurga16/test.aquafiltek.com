<?php 


session_start();
$_SESSION['horaIn']=$_POST['hora'];
$_SESSION['ip']=$_POST['direccion'];
$_SESSION['diaIn']=$_POST['dia'];

include("connect.php");

$hora_entrada=$_POST['hora'];
$direccion=$_POST['direccion'];
$diaI=$_POST['dia'];
$identificador=$_SESSION['ide'];

$script = "INSERT INTO HorariosIngreso (id_operador,hora_ingreso,direccion_ip,dia) VALUES ('$identificador','$hora_entrada','$direccion','$diaI')";
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