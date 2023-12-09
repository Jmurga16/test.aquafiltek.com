<?php
include('connect.php');
session_start();

$activar = $_POST['activar'];
if(isset($_SESSION['ide']))
{
    $id_operador = $_SESSION['ide'];

    if($activar == 1)
    {
        $script1 = "UPDATE `DatosIngreso` SET `descanso`= 1 WHERE id='$id_operador'";
        $ejecutado = mysqli_query($enlace, $script1);
        if($ejecutado)
        {

            $fecha = date_create();
            $times = date_timestamp_get($fecha);

            $sql = "SELECT numeroRegistro FROM HorariosIngreso WHERE id_operador = '$id_operador' ORDER BY numeroRegistro DESC LIMIT 1";
            $num_reg = mysqli_query($enlace, $sql);
            $num = mysqli_fetch_array($num_reg);

            $sql1 = "UPDATE `HorariosIngreso` SET inicio_inactivo = '$times' WHERE numeroRegistro = '$num[numeroRegistro]'";
            $ejecutar = mysqli_query($enlace,$sql1);

        }
    }
    else
    {
        $script1 = "UPDATE `DatosIngreso` SET `descanso`= 0 WHERE id='$id_operador'";
        $ejecutado = mysqli_query($enlace, $script1);
        if($ejecutado)
        {

            $fecha = date_create();
            $times = date_timestamp_get($fecha);

            $sql = "SELECT numeroRegistro FROM HorariosIngreso WHERE id_operador = '$id_operador' ORDER BY numeroRegistro DESC LIMIT 1";
            $num_reg = mysqli_query($enlace, $sql);
            $num = mysqli_fetch_array($num_reg);

            $sql1 = "UPDATE `HorariosIngreso` SET fin_inactivo = '$times' WHERE numeroRegistro = '$num[numeroRegistro]'";
            $ejecutar = mysqli_query($enlace,$sql1);

        }
    }
  
       
    


}

include("QuitDB.php");


?>