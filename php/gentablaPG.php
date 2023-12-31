<?php
include("connect.php");
session_start();

$clientes = $_POST['clientes'];

echo "<table class='table table-bordered table-striped'>
<tr>";

foreach ($clientes as $val) {
    $data = mysqli_query($enlace, "SELECT * FROM DatosClientes WHERE codigo = '" . $val . "'");
    $res = mysqli_fetch_array($data);

    echo "
    <td onclick=showdata('" . $res['codigo'] . "')>"
        . $res['direccion'] . "
    <br><br>
    <strong>" . $res['nombre_completo'] . "</strong>
    <br><br>
    " . $res['estado'] . "
    </td>";
}

echo "</tr></table>";

echo "<div id='botones'></div>";

echo "<div id='comentariosPG'>
</div>";
?>