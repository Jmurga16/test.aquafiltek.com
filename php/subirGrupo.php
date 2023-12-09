<?php 
include("connect.php");

$nuevos = $_POST['nuevos'];
$idgrupo = $_POST['idgrupo'];
$fecha = date('Y-m-d');
$tipo = $_POST['tipo'];

foreach($nuevos as $val)
{
    mysqli_query($enlace,"INSERT INTO grupo_asignacion (`id_cliente`,`id_grupo`,`fecha_asginacion`,`tipo`) VALUES ('$val','$idgrupo','$fecha',$tipo)");

}



include("QuitDB.php");
 ?>
