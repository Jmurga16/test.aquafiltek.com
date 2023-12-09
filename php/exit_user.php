<?php 
include("connect.php");
session_start();

$tiempo_inactivo=$_POST['tiempoI'];
$tiempo_almorzando =$_POST['almuerzo'];
$hora_salida=$_POST['hora'];
$hora_entrada=$_SESSION['horaIn'];
$direccion=$_SESSION['ip'];
$diaI=$_SESSION['diaIn'];
$identificador=$_SESSION['ide'];

$script = "UPDATE `HorariosIngreso` SET `hora_salida`='$hora_salida',`tiempo_inactivo`='$tiempo_inactivo',`tiempo_almuerzo`='$tiempo_almorzando' WHERE hora_ingreso='$hora_entrada' and direccion_ip ='$direccion' and dia='$diaI' and id_operador='$identificador'";
	if(mysqli_query($enlace,$script)){
		include("QuitDB.php");
		if (ini_get("session.use_cookies")) {
		    $params = session_get_cookie_params();
    		setcookie(session_name(), '', time() - 42000,
        	$params["path"], $params["domain"],
        	$params["secure"], $params["httponly"]
    		);
		}
		if(session_destroy())
			echo 1;
		else
			echo 0;		
	}
	else
	{
		printf ("Error realizando la conexion, por favor intente de nuevo mas tarde <br>");
    	printf("Errormessage: %s\n", mysqli_error($enlace));
		include("QuitDB.php");
		echo 0;
	}

 ?>