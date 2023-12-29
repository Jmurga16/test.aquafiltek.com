<?php
include("../../connect.php");

$id = $_POST['id'];

echo "
<div class='row'>
    <h2 class='primary-text'>Editar grupo</h2>
</div>
<br/>
<div class='row' style='background-color:white'>
    <div class='col-md-6'>
        <strong>Clientes asignados</strong>
        <br/>
        <br/>
        <table class='table table-striped table-bordered table-hover' id='clientes_grupo'>
            <thead>
                <tr style='background-color:black; color:white'>
                    <th>Seleccionar
                        <div class='row'><small style='margin-left:7px'>Página actual</small><input type='checkbox' id='qlpage' onchange='qTodos()'/></div>
                        <div class='row'><small style='margin-left:7px'>Todas las páginas</small><input type='checkbox' id='qlall' onchange='qTodosT()'/></div>
                    </th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Oper.</th>
                </tr>
            </thead>
            <tbody id='agregar_grupo'>";
$get_clients = mysqli_query($enlace, "SELECT * FROM grupo_asignacion LEFT JOIN DatosClientes on grupo_asignacion.id_cliente = DatosClientes.codigo WHERE id_grupo = '" . $id . "' AND DatosClientes.inactivo = 0");
while ($response = mysqli_fetch_array($get_clients)) {
    echo "<tr><td><input type='checkbox' id='" . $response['codigo'] . "' onchange=seleccionar_actual('" . $response['codigo'] . "')></td><td>" . $response['codigo'] . "</td><td>" . $response['nombre_completo'] . "</td>
    <td> 
        <div class='text-center'>
            <button type='button' class='btn btn-primary' title='Asignar Operador'  onclick=setCodigoCliente('" . $response['codigo'] . "')
                data-html='true' data-placement='top' data-popover-content='#popoverAsignarOperador' data-toggle='popover' tabindex='0' >
                <i class='fa fa-plus'></i>
            </button>       
        </div>
    </td>
    </tr>";
}

echo "
            </tbody>
        </table>
        <br/>
        <br/>
        <input type='button' class='btn btn-danger' value='Remover seleccionados' onclick = 'bajar_seleccionados(" . $id . ")'>
        <br/>
        <br/>
    </div>
    <div class='col-md-6'>
        <strong>Clientes disponibles</strong>
        <br/>
        <br/>
        <table class='table table-striped table-bordered table-hover' id='clientes_libres'>
            <thead>
                <tr style='background-color:black; color:white'>
                    <th>Seleccionar
                        <div class='row'><small style='margin-left:7px'>Página actual</small><input type='checkbox' id='slpage' onchange='seleccionarTodos()'/></div>
                        <div class='row'><small style='margin-left:7px'>Todas las páginas</small><input type='checkbox' id='slall' onchange='seleccionarTodosT()'/></div></th>
                    <th>Código</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>";
$get_clients = mysqli_query($enlace, "SELECT * FROM DatosClientes WHERE inactivo = 0 AND codigo NOT IN (SELECT id_cliente FROM grupo_asignacion LEFT JOIN DatosClientes on grupo_asignacion.id_cliente = DatosClientes.codigo WHERE DatosClientes.inactivo = 0)");
while ($gc = mysqli_fetch_array($get_clients)) {
    echo "<tr><td><input type='checkbox' id='" . $gc['codigo'] . "' onchange=seleccionar_nuevo('" . $gc['codigo'] . "')></td><td>" . $gc['codigo'] . "</td><td>" . $gc['nombre_completo'] . "</td></tr>";
}
echo "
            </tbody>
        </table>
        <br/>
        <br/>
        <input type='button' class='btn btn-success' value='Agregar seleccionados' onclick = 'subir_seleccionados(" . $id . ")'>
        <br/>
        <br/>
    </div>
</div>

<div class='row' style='background-color: white; margin-top:15px'>
    <div class='col-md-6'>
        <br/>
        <strong>Operadores asignados</strong>
        <table class='table table-striped table-bordered table-hover' id='operadores_grupo'>
            <thead>
                <tr style='background-color:black; color:white'>
                    <th>Seleccionar</th>
                    <th>Id</th>
                    <th>User</th>
                </tr>   
            </thead>
            <tbody id='agregar_grupo'>";
$get_clients = mysqli_query($enlace, "SELECT * FROM grupo_asignacion LEFT JOIN DatosIngreso on grupo_asignacion.id_cliente = DatosIngreso.id WHERE id_grupo = '" . $id . "' AND grupo_asignacion.tipo = 2");
while ($gc = mysqli_fetch_array($get_clients)) {
    echo "<tr><td><input type='checkbox' onchange=seleccionar_oper_actual('" . $gc['id'] . "')></td><td>" . $gc['id'] . "</td><td>" . $gc['user'] . "</td></tr>";
}

echo "
            </tbody>
        </table>
        <br/>
        <input type='button' class='btn btn-danger' value='Remover seleccionados' onclick = 'bajar_oper(" . $id . ")'>
        <br/>
        <br/>
    </div>
    <div class='col-md-6'>
        <br/>
        <strong>Operadores</strong>
        <table class='table table-striped table-bordered table-hover' id='operadores_libres'>
            <thead>
                <tr style='background-color:black; color:white'>
                    <th>Seleccionar</th>
                    <th>Id</th>
                    <th>User</th>
                </tr>
            </thead>
            <tbody>";
$get_clients = mysqli_query($enlace, "SELECT * FROM DatosIngreso WHERE id NOT IN (SELECT id_cliente FROM grupo_asignacion LEFT JOIN DatosIngreso on grupo_asignacion.id_cliente = DatosIngreso.id WHERE id_grupo = '" . $id . "' AND grupo_asignacion.tipo = 2)");
while ($gc = mysqli_fetch_array($get_clients)) {
    echo "<tr><td><input type='checkbox' onchange=seleccionar_operador('" . $gc['id'] . "')></td><td>" . $gc['id'] . "</td><td>" . $gc['user'] . "</td></tr>";
}
echo "
            </tbody>
        </table>
        <br/>
        <input type='button' class='btn btn-success' value='Asignar operadores' onclick = 'subir_operadores(" . $id . ")'>
        <br/>
        <br/>
    </div>
</div>
";



include("../../QuitDB.php");
