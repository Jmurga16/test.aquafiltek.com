<?php
include "connect.php";

$filtro = $_POST['filtro'];

$script = "UPDATE filtros SET r_urgentes = $filtro WHERE id = 1";

$resultado = mysqli_query($enlace, $script);

if($resultado)
{
	echo 1;
}
else
{
	echo 0;
}

include "QuitDB.php";
?>