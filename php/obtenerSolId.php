<?php
include "connect.php";

$script = "SELECT * FROM sol_edicion_id LEFT JOIN DatosClientes on sol_edicion_id.id_cliente = DatosClientes.codigo";

$resultado = mysqli_query($enlace, $script);
$total = "";
while ($fila = mysqli_fetch_array($resultado)) {
	$script1 = "SELECT `user` from DatosIngreso WHERE id =".$fila['id_operador']."";
	$resultado2 = mysqli_query($enlace,$script1);
	$res = mysqli_fetch_array($resultado2);

	


	$total .= "<tr><th scope='row'>".$fila['id_cliente']."</th><td>".$fila['nombre_completo']."</td><td>".$fila['fecha']."</td><td>".$res['user']."</td><td><input type='button' class='btn btn-success' onclick=autorizar_edit('".$fila['codigo']."') value='Autorizar'> </td></tr>";

}
echo $total;
include "QuitDB.php";
?>