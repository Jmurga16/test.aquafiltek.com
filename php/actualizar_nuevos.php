<?php 
include("connect.php");
$old_codigo = $_POST['ocodigo'];
$new_codigo = $_POST['ncodigo'];

$old_codigo = explode(",",$old_codigo);
$new_codigo = explode(",",$new_codigo);

$cantidad = count($new_codigo);
$i = 0;
$a = 0;

$dif = 0;
$dup = 0;
$nada = 0;
foreach($old_codigo AS $val)
{
    $val1 = trim($val," ");
    if($new_codigo[$i] == '' || $new_codigo[$i] == ' ')
    {
       $nada++;
        
    }
    else if(strlen($new_codigo[$i]) != 16)
    {
        $dif++;

    }
    else
    {
        $buscar = mysqli_query($enlace,"SELECT * FROM DatosClientes WHERE codigo = '".$new_codigo[$i]."'");
        $nb = mysqli_num_rows($buscar);
        if($nb != 0)
        {
            $dup++;
        }


    $script = "UPDATE DatosClientes SET codigo = '".$new_codigo[$i]."', actualizar_pendiente=0 WHERE codigo = '".$val."'";
    $ejecutar = mysqli_query($enlace,$script);
    $nc = mysqli_affected_rows($enlace);
   

    if($nc == 0)
    {

    }
    else
    {

        $script1 = "UPDATE grupo_asignacion SET id_cliente = '".$new_codigo[$i]."' WHERE id_cliente = '".$val."'";
        $ejecutar1 = mysqli_query($enlace,$script1);
    }

    }
$i++;

}

if($dif == 0 && $dup == 0)
{
    if($nada == $cantidad)
    {
        echo 4;
    }
    else if($nada == 0 && $dif == 0 && $dup == 0)
    {
        echo 5;
    }
    else
    {
        echo 6;
    }
   
}
else if($dif != 0 && $dup == 0)
{
    echo 1;
}
else if($dif == 0 && $dup != 0)
{
    echo 2;
}
elseif($dif != 0 && $dup != 0)
{
    echo 3;
}

include("QuitDB.php");
 ?>