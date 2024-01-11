<?php
include("../../connect.php");

$id = $_POST['id'];
$query = "";
$filtro_disponible = $_POST['filtro_disponible'];
$filtro_asignado = $_POST['filtro_asignado'];


echo "
<div class='row mb-3'>
    <div class='col-md-6'>

        <ul class='list-group'>
            
";

$query = "SELECT * FROM DatosClientes 
            WHERE inactivo = 0 
            AND codigo NOT IN (SELECT id_cliente FROM grupo_asignacion LEFT JOIN DatosClientes on grupo_asignacion.id_cliente = DatosClientes.codigo WHERE DatosClientes.inactivo = 0)
            AND  (nombre_completo LIKE '%$filtro_disponible%' OR fecha_subida LIKE '%$filtro_disponible%')
            ORDER BY fecha_subida DESC, nombre_completo ASC";
$clientesNuevos = mysqli_query($enlace, $query);

while ($response = mysqli_fetch_array($clientesNuevos)) {

    if ($response['fecha_subida'])
        $fechasub = $response['fecha_subida'] . " | ";
    else
        $fechasub = "";

    echo "
        <li class='list-group-item d-flex justify-content-between align-items-center'>     
            " . $fechasub . " 
            " . $response['nombre_completo'] . "            
            <button type='button' class='btn btn-primary' title='Agregar' onclick=agregarClienteAGrupo('" . $response['codigo'] . "') >
                <i class='fa fa-play'></i>
            </button>            
        </li>
    ";
}

echo "
        </ul>
    </div>
    
    <div class='col-md-6'>

        <ul class='list-group'>
";

$query = "SELECT * FROM grupo_asignacion LEFT JOIN DatosClientes on grupo_asignacion.id_cliente = DatosClientes.codigo 
            WHERE id_grupo = '" . $id . "' AND DatosClientes.inactivo = 0
            AND (nombre_completo LIKE '%$filtro_asignado%' OR fecha_subida LIKE '%$filtro_asignado%') 
            ORDER BY `grupo_asignacion`.`fecha_asginacion` ASC";
$clientesAsignados = mysqli_query($enlace, $query);

while ($res = mysqli_fetch_array($clientesAsignados)) {

    echo "
        <li class='list-group-item d-flex justify-content-between align-items-center'>                                    
            <button type='button' class='btn btn-danger ' style='transform: rotate(180deg);' title='Remover' onclick=retirarClienteDeGrupo('" . $res['codigo'] . "')>
                <i class='fa fa-play'></i>
            </button>        
            " . $res['nombre_completo'] . "    
        </li>
    ";
}

echo    "</ul>
    </div>   
</div>
";


include("../../QuitDB.php");
