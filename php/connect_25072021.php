<?php 

/**** PRODUCCION */
//$enlace=mysqli_connect("46.4.20.177","aquafiltek_programmer","?W8ndp%sv*@G","aquafiltek_Operadores");
//$clavePrivada = "0%M4N&LZ43V3R!";

/**  TESTING */
//$enlace=mysqli_connect("46.4.20.177","aquafiltek_testuser","T3chPlu$","aquafiltek_testdb");
//$clavePrivada = "0%M4N&LZ43V3R!";

/*** LOCAL */
//$enlace=mysqli_connect("localhost","root","1234","bd_aquafiltek");
//$clavePrivada = "0%M4N&LZ43V3R!";

//$enlace=mysqli_connect("46.4.20.177","aquafiltek_programmer","?W8ndp%sv*@G","aquafiltek_Operadores");
//$clavePrivada = "0%M4N&LZ43V3R!";


//$enlace=mysqli_connect("localhost","root","1234","bd_aquafiltek");
//$clavePrivada = "0%M4N&LZ43V3R!";




/*
$enlace=mysqli_connect("46.4.20.177","aquafiltek_programmer","?W8ndp%sv*@G","aquafiltek_Operadores");
$clavePrivada = "0%M4N&LZ43V3R!";

$enlace=mysqli_connect("46.4.20.177","aquafiltek_testuser","T3chPlu$","aquafiltek_testdb");
$clavePrivada = "0%M4N&LZ43V3R!";

$enlace=mysqli_connect("localhost","root","1234","bd_aquafiltek");
$clavePrivada = "0%M4N&LZ43V3R!";*/





//$enlace=mysqli_connect("localhost","root","1234","bd_aquafiltek");
//$clavePrivada = "0%M4N&LZ43V3R!";

$enlace=mysqli_connect("46.4.20.177","aquafiltek_testuser","T3chPlu$","aquafiltek_testdb");
$clavePrivada = "0%M4N&LZ43V3R!";
    
	if(!$enlace){
		echo "Hubo un error al contactar la base de datos";
		echo "Errno: $mysqli_connect_errno()";
		echo "Error: $mysqli_connect_error()";
	}
		mysqli_query($enlace,"SET NAMES 'utf8'");	
 ?>	
