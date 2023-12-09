<?php
include "connect.php";
session_start();

$id = $_POST['id'];
$tipo = $_POST['tipo'];

if($tipo == 1)
{
	if($_SESSION['ide'] == '')
	{
		$result = 2;
	}
	else
	{
		$script = "UPDATE `sol_edicion_id` SET `status` = 1 WHERE id_cliente = '$id' AND `status` = 0";
		$ejecutar = mysqli_query($enlace,$script);

		
		if($ejecutar)
		{
			$result = 1;
		}
		else
		{
			$result = 3;
		}

	}

	


}




echo $result;
include "QuitDB.php";
?>