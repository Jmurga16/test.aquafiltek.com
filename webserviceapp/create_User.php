<?php 
include("connect.php");
if($_POST){

$user=mysqli_real_escape_string($enlace,$_POST['usuario']);
$script="SELECT * FROM DatosIngreso where user='$user'";
$result = mysqli_query($enlace,$script);
$total= mysqli_num_rows($result);
if($total>0){
	echo -1;
}
else{
	$user=mysqli_real_escape_string($enlace,$_POST['usuario']);
	$pass = md5($clavePrivada.$_POST['password']);
	$name = $_POST['nombre'];
	$tipo = $_POST['tipo'];
	$script = "INSERT INTO DatosIngreso (name,user,password,tipo) VALUES ('$name','$user','$pass','$tipo')";
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
}

}

 ?>