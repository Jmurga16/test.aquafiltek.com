<?php
include "connect.php";

$script = "SELECT nombre_completo,codigo FROM DatosClientes ORDER BY nombre_completo";

$resultado = mysqli_query($enlace, $script);
$total = "";
while ($fila = mysqli_fetch_array($resultado)) {
	$total .= "<a class=\"dropdown-item\" href=\"../php/asignarOperador.php?ide=" . $fila['codigo'] . "&name=" . $fila['nombre_completo'] . "&oa=NA" . "\" target=\"_blank\">" . $fila['nombre_completo'] . "</a>";

}
echo $total;
include "QuitDB.php";
?>