<?php
include("../../connect.php");

error_reporting(0);

$conte = array();
$busqueda = trim($_REQUEST["q"]);

$query = "SELECT DISTINCT estado FROM DatosClientes  where estado LIKE '%" . $busqueda . "%' 
        AND (estado = 'Por gestionar' OR estado = 'No responde' OR estado = 'Volver a llamar' OR estado LIKE '%Importante%')
        order by estado desc";

$result = mysqli_query($enlace, $query);
$i = 0;




while ($fila = mysqli_fetch_array($result)) {

    $conte[$i]["id"] = $fila["estado"];
    $conte[$i]["text"] = $fila["estado"];
    $i++;
}

echo json_encode($conte, JSON_UNESCAPED_SLASHES);
include '../../QuitDB.php';
?>