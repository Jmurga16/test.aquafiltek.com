<?php
//$id= $_POST['id'];
include 'connect.php';
//mysqli_query($enlace,"UPDATE `DatosClientes` SET `actual_gestion`=1 WHERE codigo='$id'");
$clientes = $_POST['clientes'];
$arr_respuesta=['error'=>true, 'msj'=>''];
if( $clientes != '' ){
    $arr_cli = explode(",",$clientes);
    $arr_q=[];
    $arr_respuesta['error']=false;
    
    foreach($arr_cli as $id){
        $sql="UPDATE `DatosClientes` SET `actual_gestion`=0 WHERE codigo='$id'";
            mysqli_query($enlace,$sql);
        $arr_respuesta['q'][] = $sql;
    }

}
echo json_encode($arr_respuesta);
include 'QuitDB.php';
 ?>
