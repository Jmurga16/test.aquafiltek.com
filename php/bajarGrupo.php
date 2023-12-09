<?php 
include("connect.php");

$nuevos = $_POST['nuevos'];
$idgrupo = $_POST['idgrupo'];
$fecha = date('Y-m-d');
$tipo = $_POST['tipo'];

foreach($nuevos as $val)
{
    mysqli_query($enlace,"DELETE FROM grupo_asignacion WHERE id_cliente = '$val' AND id_grupo = '$idgrupo' AND tipo = '$tipo'");

}



include("QuitDB.php");
 ?>
