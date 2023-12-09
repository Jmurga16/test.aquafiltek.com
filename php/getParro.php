<?php 
include("connect.php");

$canton = $_POST['canton'];

$script="SELECT * FROM parroquias WHERE idcanton = '$canton'";

$resultado=mysqli_query($enlace,$script);

$tabla = "<option value=''>--SELECCIONE--</option>";
while($res = mysqli_fetch_array($resultado))
{
    $tabla .= "<option value='".$res['id_parroquia']."'>".$res['parroquia_desc']."</option>";
}


echo $tabla;
include("QuitDB.php");
 ?>
