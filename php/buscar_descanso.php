<?php 
include("connect.php");
session_start();

if(isset($_SESSION['ide']))
{
    $id_operador = $_SESSION['ide'];

    $query= "SELECT descanso FROM DatosIngreso WHERE id = '$id_operador'";
    $ejecutar = mysqli_query($enlace,$query);

    $data = mysqli_fetch_array($ejecutar);

    $sql1 = "SELECT numeroRegistro, inicio_inactivo FROM `HorariosIngreso` WHERE id_operador = '$id_operador' ORDER BY numeroRegistro DESC LIMIT 1";
    $ejecutar1 = mysqli_query($enlace,$sql1);

    $init = mysqli_fetch_array($ejecutar1);

    if($data['descanso'] == 1 && $init['inicio_inactivo'] != '')
    {
        echo $data['descanso'];
    }
    else
    {
        $fecha = date_create();
        $times = date_timestamp_get($fecha);
        $sql1 = "UPDATE `HorariosIngreso` SET fin_inactivo = '$times' WHERE numeroRegistro = '$init[numeroRegistro]'";
        $ejecutar = mysqli_query($enlace,$sql1);

        $script1 = "UPDATE `DatosIngreso` SET `descanso`= 0 WHERE id='$id_operador'";
        $ejecutado = mysqli_query($enlace, $script1);

        echo "nada";
    }

    





}
else
{
    echo "nada";
}



include("QuitDB.php");
 ?>