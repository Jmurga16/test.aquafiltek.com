<?php 
include("connect.php");
session_start();

$idcliente = $_POST['idced'];
$id_operador = $_SESSION['ide'];
$fecha = date('Y-m-d');
$hora = date('h:i:s');
$status = 0;


$script = "INSERT INTO `sol_edicion_id` (id_operador, id_cliente, fecha, hora, `status`) VALUES ('$id_operador','$idcliente','$fecha','$hora','$status')";
$ejecutar = mysqli_query($enlace,$script);
if($ejecutar)
{
    echo 1;
}
else
{
    if($id_operador == '')
    {
        echo 2;
    }
    else
    {
        echo 3;
    }
    
}



include "QuitDB.php";






?>