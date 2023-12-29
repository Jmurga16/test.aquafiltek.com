<?php
include("../../connect.php");

$id_grupo = $_POST['id_grupo'];

$query = "SELECT * FROM grupo_asignacion LEFT JOIN DatosIngreso on grupo_asignacion.id_cliente = DatosIngreso.id 
            WHERE id_grupo = '" . $id_grupo . "' AND grupo_asignacion.tipo = 2";


echo "
<div class='popover-heading'>
    Asignar Operador
</div>
<div class='popover-body'>    
";


$operadores = mysqli_query($enlace, $query);
while ($response = mysqli_fetch_array($operadores)) {

echo "
    <div class='form-check'>
        <input class='form-check-input' type='checkbox' id='defaultCheck1' style='width:auto' onclick='asignarOperadorACliente(this);' value=". $response['id'] .">
        <label class='form-check-label' for='defaultCheck1'>"
            . $response['user'] ."
        </label>
    </div>";    
}


echo "
</div>
";


include("../../QuitDB.php");
