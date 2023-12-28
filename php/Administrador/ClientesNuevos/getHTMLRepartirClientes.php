<?php
include("../../connect.php");

$id = $_POST['id'];
$query = "";

echo "
<div class='row mb-3'>
    <div class='col-md-6'>
        <div class='mb-2'>
            <strong >Clientes disponibles</strong>
        </div>
        <br/>
        <ul class='list-group'>
            
";

$query = "SELECT * FROM DatosClientes 
            WHERE inactivo = 0 
            AND codigo NOT IN (SELECT id_cliente FROM grupo_asignacion LEFT JOIN DatosClientes on grupo_asignacion.id_cliente = DatosClientes.codigo WHERE DatosClientes.inactivo = 0)
            ORDER BY fecha_subida DESC, nombre_completo ASC";
$clientesNuevos = mysqli_query($enlace, $query);

while ($response = mysqli_fetch_array($clientesNuevos)) {

    echo "
        <li class='list-group-item d-flex justify-content-between align-items-center'>            
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
        <div class='mb-2'>
            <strong >Clientes asignados</strong>
        </div>
        <br/>
        <ul class='list-group'>
";

$query = "SELECT * FROM grupo_asignacion LEFT JOIN DatosClientes on grupo_asignacion.id_cliente = DatosClientes.codigo 
            WHERE id_grupo = '" . $id . "' AND DatosClientes.inactivo = 0 
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
