<?php

include "../../connect.php";

//buscar 3 por gestionar por si acaso
$hoy_dia = date('d');
$hoy_mes = date('m');
$hoy_anual = date('Y');

$idUsuario = $_POST['idUsuario'];
$estadosSelected = $_POST['estadosSelected'];

$where = " WHERE 1=1 ";

$query1 = "SELECT codigo, nombre_completo, direccion, estado, fecha_gestion  FROM `DatosClientes` 
            INNER JOIN `Grupo_Asignacion` ON (DatosClientes.codigo = Grupo_Asignacion.id_cliente AND tipo = 1)
                AND  Grupo_Asignacion.id_grupo IN (SELECT id_grupo FROM Grupo_Asignacion WHERE id_cliente = " . $idUsuario . " AND tipo = 2) ";



foreach ($estadosSelected as $key => $value) {
    if ($key == 0) {
        $where .= ' ' . " AND estado = '" . $value . "'";
    } else {
        $where .= ' ' . " OR estado = '" . $value . "'";
    }
}

$query = $query1 . ' ' . $where;


$query .= " AND actual_gestion = 0 AND inactivo = 0 AND nombre_completo != '-CLIENTE REPETIDO-' 

            AND fecha_gestion < '" . $hoy_anual . "-" . $hoy_mes . "-" . $hoy_dia . "'
                        
            EXCEPT 

            SELECT codigo, nombre_completo, direccion, estado, fecha_gestion  FROM `DatosClientes` 
            INNER JOIN `Grupo_Asignacion` ON (DatosClientes.codigo = Grupo_Asignacion.id_cliente AND tipo = 1)
            AND  Grupo_Asignacion.id_grupo IN (SELECT id_grupo FROM Grupo_Asignacion WHERE id_cliente = " . $idUsuario . " AND tipo = 2)
            INNER JOIN Operador_x_cliente ON DatosClientes.codigo = Operador_x_cliente.codigo_cliente AND Operador_x_cliente.id_operador != " . $idUsuario . "

            UNION

            SELECT codigo, nombre_completo, direccion, estado, fecha_gestion  FROM `DatosClientes` 
            INNER JOIN `Grupo_Asignacion` ON (DatosClientes.codigo = Grupo_Asignacion.id_cliente AND tipo = 1)
            AND  Grupo_Asignacion.id_grupo IN (SELECT id_grupo FROM Grupo_Asignacion WHERE id_cliente = " . $idUsuario . " AND tipo = 2)
            INNER JOIN Operador_x_cliente ON DatosClientes.codigo = Operador_x_cliente.codigo_cliente AND Operador_x_cliente.id_operador = " . $idUsuario . "

            ORDER BY fecha_gestion DESC 
            ";


$nuevo_script = mysqli_query($enlace, $query);

$ia = 1;
while ($response = mysqli_fetch_array($nuevo_script)) {

    echo "<tr id='" . $response['codigo'] . "tr' >
        <td align=center> 
            <input type='checkbox' id='" . $response['codigo'] . "' value='" . $response['codigo'] . "' onchange='selpg(this.value)' style='position:relative; z-index: 100;' >
        </td>
        <td style='cursor:pointer' onclick=selectRowUnicoCliente('" . $response['codigo'] . "')  >" . $response['codigo'] . "</td>
        <td style='cursor:pointer' onclick=selectRowUnicoCliente('" . $response['codigo'] . "')  >" . $response['nombre_completo'] . "</td>
        <td style='cursor:pointer' onclick=selectRowUnicoCliente('" . $response['codigo'] . "')  ><small>" . $response['direccion'] . "</small></td>
        <td style='cursor:pointer' onclick=selectRowUnicoCliente('" . $response['codigo'] . "')  >" . $response['estado'] . "</td>
        <td style='cursor:pointer' onclick=selectRowUnicoCliente('" . $response['codigo'] . "')  >" . $response['fecha_gestion'] . "</td>
        </tr>";

    $ia++;
}

include("../../QuitDB.php");
