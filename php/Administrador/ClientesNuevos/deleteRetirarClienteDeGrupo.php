<?php
include("../../connect.php");

$idcliente = $_POST['idcliente'];
$idgrupo = $_POST['idgrupo'];
$tipo = $_POST['tipo'];

$query = "DELETE FROM grupo_asignacion WHERE id_cliente = '$idcliente' AND id_grupo = '$idgrupo' AND tipo = '$tipo'";

mysqli_query($enlace, $query);

include("../../QuitDB.php");

?>