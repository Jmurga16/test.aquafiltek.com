<?php
include("../../connect.php");


$script = "SELECT * FROM grupos";

$resultado = mysqli_query($enlace, $script);

echo "
<div class='mb-4'>
    <label for='grupo_poblacional' style='font-weight: bold;'>Grupo Poblacional a Repartir:</label>
    <select name='grupo_poblacional' id='IdGrupoPoblacional' class='form-control' onchange='getListGroupRepartirClientes(this.value)'>
        <option value=''>--SELECCIONE--</option>";
while ($res = mysqli_fetch_array($resultado)) {
    echo "<option value='" . $res['id'] . "'>" . $res['nombre'] . "</option>";
}
echo "
    </select>
</div>";


include("../../QuitDB.php");
