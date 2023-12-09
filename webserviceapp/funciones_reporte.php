<?php

function get_script($fechaI, $fechaF, $operador, $orden) {
	return "
SELECT tg.`fecha_gestion` as fecha,tg.`tipo`,di.`user` AS operador ,tg.`tiempo_total` AS duracion, dc.nombre_completo AS cliente
FROM `tiempo_gestion` AS tg
INNER JOIN `DatosIngreso` AS di ON di.`id`=tg.`id_operador` AND
tg.`fecha_gestion` > STR_TO_DATE('$fechaI','%d/%m/%Y') AND
tg.`fecha_gestion` <= STR_TO_DATE('$fechaF 23:59:59','%d/%m/%Y %H:%i:%s')" . get_script_operador($operador, 1) . "
INNER JOIN `DatosClientes` AS dc ON dc.codigo=tg.id_cliente
UNION
SELECT STR_TO_DATE(CONCAT(hi.`dia`, ' ', hi.`hora_ingreso`) ,'%d/%m/%Y %H:%i:%s') AS fecha, 'LOG' as tipo,di.`user` AS operador,'' AS duracion,'' AS cliente
FROM `HorariosIngreso` as hi
INNER JOIN `DatosIngreso` AS di ON di.`id`=hi.`id_operador` AND
STR_TO_DATE(CONCAT(hi.`dia`, ' ', hi.`hora_ingreso`) ,'%d/%m/%Y %H:%i:%s') >STR_TO_DATE('$fechaI','%d/%m/%Y') AND
STR_TO_DATE(CONCAT(hi.`dia`, ' ', hi.`hora_ingreso`) ,'%d/%m/%Y %H:%i:%s') <= STR_TO_DATE('$fechaF 23:59:59','%d/%m/%Y %H:%i:%s')" . get_script_operador($operador, 1) . "
UNION
SELECT hp.`hora_realizacion` AS fecha , 'PV' AS tipo,di.`user` AS operador,'' AS duracion,dc.nombre_completo AS cliente
FROM `historial_postventa` AS hp
INNER JOIN `DatosIngreso` AS di ON di.`id`=hp.`operador` " . get_script_operador($operador, 0) . " AND
`hora_realizacion` > STR_TO_DATE('$fechaI','%d/%m/%Y') AND
`hora_realizacion` <= STR_TO_DATE('$fechaF 23:59:59','%d/%m/%Y %H:%i:%s')
INNER JOIN `DatosClientes` AS dc ON dc.codigo=hp.codigo
" . get_order($orden);
}

function get_script_operador($op, $case) {
	if ($op == -1) {
		return "";
	} else {
		if ($case == 1) {
			return " AND `id_operador`=$op ";
		} else {
			return " AND `operador`=$op ";
		}
	}
}
function get_order($orden) {
	switch ($orden) {
	case 1:
		return " ORDER BY cliente";
		break;
	case 2:
		return " ORDER BY tipo";
		break;
	case 3:
		return " ORDER BY duracion";
		break;
	case 4:
		return " ORDER BY fecha";
		break;
	default:
		return "";
		break;
	}
}
/*
0 = Tiempo perdido
1 = Volver a Llamar
2 = Acepto
3 = Rechazo
4 = Averiado
5 = No responde
6 = Equivocado
7 = Otro
 */
function get_resultado($tipo) {
	if ($tipo == "LOG" || $tipo == "PV") {
		return "";
	}

	switch ($tipo) {
	case 0:
		return "Tiempo no aprovechado";
		break;
	case 1:
		return "Volver a llamar";
		break;
	case 2:
		return "Acepto";
		break;
	case 3:
		return "Rechazo";
		break;
	case 4:
		return "Averiado";
		break;
	case 5:
		return "No responde";
		break;
	case 6:
		return "Equivocado";
		break;
	case 7:
		return "Otro";
		break;
	default:
		return "";
		break;
	}

}
function get_accion($tipo) {
	switch ($tipo) {
	case 'LOG':
		return "Inicio de sesion";
		break;
	case 'PV':
		return "Post Venta";
		break;
	default:
		return "Gestion de llamada";
		break;
	}

}
?>
