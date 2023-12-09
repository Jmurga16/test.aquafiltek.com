<?php
error_reporting(0);

include "connect.php";



//buscar 3 por gestionar por si acaso
$hoy_dia = date('d');
$hoy_mes = date('m');
$hoy_anual = date('Y');
$hoy_anual = $hoy_anual-1;


$n_script = "SELECT * FROM `DatosClientes` WHERE estado = 'Por gestionar' AND actual_gestion = 0 AND inactivo = 0 AND fecha_gestion < '".$hoy_anual."-".$hoy_mes."-".$hoy_dia."' LIMIT 20";
$nuevo_script = mysqli_query($enlace,$n_script);
$ia = 1;
while($pguser = mysqli_fetch_array($nuevo_script))
{
	
	echo "<tr>
	<td align=center> <input type='checkbox' value='".$pguser['codigo']."' onchange='selpg(this.value)'></td>
	<td>".$pguser['codigo']."</td>
	<td>".$pguser['nombre_completo']."</td>
	<td>".$pguser['direccion']."</td>
	<td>".$pguser['fecha_gestion']."</td>
	</tr>";
	
	$ia++;
}




?>
