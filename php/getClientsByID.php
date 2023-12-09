<?php
include 'connect.php';

$codigo = $_POST['id'];
//echo "SELECT di.user as operador FROM Clientes_gestionados as cg INNER JOIN DatosIngreso as di ON cg.id_operador=di.id AND cg.id_cliente='$codigo'";
$res = mysqli_query($enlace, "SELECT di.user as operador FROM Clientes_gestionados as cg INNER JOIN DatosIngreso as di ON cg.id_operador=di.id AND cg.id_cliente='$codigo'");
// if(mysqli_num_rows($res)){
	$row = mysqli_fetch_array($res);
	if(!empty($row['operador'])){
		echo "<b>Operador que realizó la venta</b> : ".$row['operador'];
	}
	
// }
include 'QuitDB.php';
?>