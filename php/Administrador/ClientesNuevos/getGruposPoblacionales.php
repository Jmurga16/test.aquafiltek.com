<?php
include("../../connect.php");

$script = "SELECT * FROM grupos";

$resultado = mysqli_query($enlace, $script);

$tabla = "";

while ($res = mysqli_fetch_array($resultado)) {
    $tabla .= "<option value='" . $res['id'] . "'>" . $res['nombre'] . "</option>";
}


echo $tabla;
include("../../QuitDB.php");
?>