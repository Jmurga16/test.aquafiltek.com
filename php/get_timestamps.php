<?php 
include("connect.php");
session_start();

$id_operador = $_SESSION['ide'];

if(isset($_SESSION['ide']))
{
    $query= "SELECT descanso FROM DatosIngreso WHERE id = '$id_operador'";
    $ejecutar = mysqli_query($enlace,$query);

    $desc = mysqli_fetch_array($ejecutar);
    if($desc['descanso'] == 1)
    {
        $sql = "SELECT inicio_inactivo FROM HorariosIngreso WHERE id_operador = '$id_operador' ORDER BY numeroRegistro DESC LIMIT 1";
        $script = mysqli_query($enlace, $sql);
    
        $data = mysqli_fetch_array($script);
        $fecha = date_create();
        $now = date_timestamp_get($fecha);
    
    
        $arr = array('inicio' => intval($data['inicio_inactivo']), 'actual' => $now);
        echo json_encode($arr);
    }
    else
    {
        echo "activo";
       
    }

   

}



include("QuitDB.php");
 ?>