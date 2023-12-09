<?php
include 'connect.php';
$total='';
$result = mysqli_query($enlace, "SELECT codigo,nombre_completo,direccion FROM `DatosClientes` WHERE 1 ORDER BY nombre_completo");

while ($fila = mysqli_fetch_array($result)) {
    $total.='<tr><td> </td> <td>' . $fila['codigo'] . '</td> <td>' . $fila['nombre_completo'] . '</td> <td>' . $fila['direccion'] . '</td></tr>';
}
include 'QuitDB.php';

echo json_encode($total);


?>
