<?php 
error_reporting(0);
header('content-type: application/json; charset=utf-8');
//en caso de json en vez de jsonp habría que habilitar CORS:
header("access-control-allow-origin: *");

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
	
	
	$retorna["ide"]=$fila['id'];
	$retorna["usuario"]=$fila['user'];
	$retorna["permisos"]=$fila['permiso_agregar'];


	/*session_start();
	$_SESSION['ide']=$fila['id'];
	$_SESSION['usuario']=$fila['user'];
	$_SESSION['permisos']=$fila['permiso_agregar'];*/
		if($fila['user']=="admin" || $fila['user']=="Aquafiltek_ADM")
		{
			//$_SESSION['TipoUsuario']=1;		
			//echo 1;
			$retorna["TipoUsuario"]=1;

		}else{
			if($fila['tipo']==0)
			{
				//$_SESSION['TipoUsuario']=1;		
				//echo 1;
				$retorna["TipoUsuario"]=2;

			}
			if($fila['tipo']==1)
			{
				//$_SESSION['TipoUsuario']=2;		
				//echo 2;	
				$retorna["TipoUsuario"]=3;
	
			}
		}
		
	}
	else{
		//echo -1;
		$retorna["TipoUsuario"]=-1;

	}

}
else{
	//echo 0;
	$retorna["TipoUsuario"]=0;

}
include("QuitDB.php");


echo json_encode($retorna);

 ?>
