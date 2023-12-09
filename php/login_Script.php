<?php 
include("connect.php");

$user = $_POST['usuario'];
$pass= md5($clavePrivada.$_POST['password']);
$script="SELECT * FROM DatosIngreso where user='$user'";

$resultado=mysqli_query($enlace,$script);

if(mysqli_num_rows($resultado)==1){
	$script="SELECT * FROM DatosIngreso where user='$user' and password='$pass'";
	$resultado=mysqli_query($enlace,$script);
	if(mysqli_num_rows($resultado)==1){
	$fila = mysqli_fetch_array($resultado);
	session_start();
	$_SESSION['ide']=$fila['id'];
	$_SESSION['usuario']=$fila['user'];
	$_SESSION['permisos']=$fila['permiso_agregar'];
	if($fila['user']=="Aquafiltek_ADM")
	{
		$_SESSION['TipoUsuario']=1;		
		echo 1;
	}
	else {
		$_SESSION['TipoUsuario']=2;		
		echo 2;	
	}
	}
	else{
		echo -1;
	}

}
else{
	echo 0;
}
include("QuitDB.php");
 ?>
