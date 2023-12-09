<?php 
include("connect.php");

$script="SELECT * FROM provincias";

$resultado=mysqli_query($enlace,$script);

$tabla = "";
while($res = mysqli_fetch_array($resultado))
{
    $tabla .= "<option value='".$res['id_prov']."'>".$res['prov_desc']."</option>";
}


echo $tabla;
include("QuitDB.php");
 ?>
