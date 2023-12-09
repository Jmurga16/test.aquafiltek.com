<?php
include 'xls/simplexlsx.class.php';
include "connect.php";

$xlsx = new SimpleXLSX('Base_Datos.xlsx');

foreach ($xlsx->rows() as $fields) {
	if ($fields[0] == "") {
		exit();
	}
	$ubication = $fields[0];
	$code = $fields[1];
	$name = $fields[2];
	$dataFac = $fields[3];
	$address = $fields[4];
	$tel = $fields[5];
	$tel2 = $fields[6];
	$cel1 = $fields[7];
	$cel2 = $fields[8];
	$mail = $fields[9];
	$infoCis = $fields[10];
	$comments = $fields[11];
	$script_consulta = "SELECT `codigo`, `coordenadas`, `nombre_completo`, `direccion`, `telefono`, `correo`, `comentarios` FROM `DatosClientes` where codigo='$code'";
	$result = mysqli_query($enlace, $script_consulta);
	$total = mysqli_num_rows($result);
	if ($total != 0) {
		$fila = mysqli_fetch_array($result);
		if ($name != $fila['nombre_completo']) {
			$name = $name . ";" . $fila['nombre_completo'];
		}
		if ($address != $fila['direccion']) {
			$address = $address . " ; " . $fila['direccion'];
		}
		if ($tel != $fila['telefono']) {
			$tel = $tel . " ; " . $fila['telefono'];
		}
		if ($mail != $fila['correo']) {
			$mail = $mail . " ; " . $fila['correo'];
		}
		if ($comments != $fila['comentarios']) {
			$comments = $comments . " ; " . $fila['comentarios'];
		}
		echo "->" . $code . " <b>REPETIDO</b><br> ";
		$script = "UPDATE `DatosClientes` SET `coordenadas`='$ubication',`nombre_completo`='$name',`Datos_factura`='$dataFac',`direccion`='$address',`telefono`='$tel',`telefono_oficina`='$tel2',`celular1`='$cel1',`celular2`='$cel2',`correo`=$mail,`info_cisterna`='$infoCis',`comentarios`='$comments',`comentarios_gestion`='' WHERE codigo ='$code'";
		mysqli_query($enlace, $script) . "<br>";
	} else {
		$script = "INSERT INTO `DatosClientes`(`codigo`, `coordenadas`, `nombre_completo`, `Datos_factura`, `direccion`, `telefono`, `telefono_oficina`, `celular1`, `celular2`, `correo`, `info_cisterna`, `comentarios`, `comentarios_gestion`) VALUES ('$code','$ubication','$name','$dataFac','$address','$tel','$tel2','$cel1','$cel2','$mail','$infoCis','$comments','')";
		mysqli_query($enlace, $script);
	}
	mysqli_query($enlace, "DELETE FROM `DatosClientes` WHERE `codigo` ='CODIGOS'");
	if ($code != 'CODIGOS') {echo "<b>Cliente subido</b>";}
}
include "QuitDB.php";
?>