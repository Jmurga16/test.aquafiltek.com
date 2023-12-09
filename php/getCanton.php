<?php 
include("connect.php");

$provincia = $_POST['provincia'];

$script="SELECT * FROM cantones WHERE idprov = '$provincia'";

$resultado=mysqli_query($enlace,$script);

$tabla = "<option value=''>--SELECCIONE--</option>";
while($res = mysqli_fetch_array($resultado))
{
    $tabla .= "<option value='".$res['id_canton']."'>".$res['canton_desc']."</option>";
}


echo $tabla;
include("QuitDB.php");
 ?>
