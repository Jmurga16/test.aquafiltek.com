<?php
include 'connect.php';

$codigo = $_POST['id'];
$fila = mysqli_fetch_array(mysqli_query($enlace, "SELECT `nombre_completo` FROM `DatosClientes` WHERE `codigo`='$codigo'"));

echo "<tr>
        <th scope=\"row\">" . $codigo . "</th>
        <td>" . $fila['nombre_completo'] . "</td>
      </tr>";
include 'QuitDB.php';
?>