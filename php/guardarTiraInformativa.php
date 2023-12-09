<?php
session_start();
$arr_respuesta = ['error'=>true,'msj'=>''];

if(!isset($_SESSION['ide']) || $_SESSION['ide'] == NULL){
    $arr_respuesta['msj']='Debe iniciar sesión';
    echo json_encode($arr_respuesta);

    exit();
}
include "connect.php";



$tira_permanente = isset($_POST['tira_permanente'])?(int)$_POST['tira_permanente']:-1;
if($tira_permanente == -1 ){
    $arr_respuesta['msj']='Debe enviar valor de tira_permanente';
    echo json_encode($arr_respuesta);
    exit();
}
$minutos = isset($_POST['minutos'])?$_POST['minutos']:-1;
$mensaje = isset($_POST['mensaje'])?trim($_POST['mensaje']):'';

$guardar = isset($_POST['guardar'])?$_POST['guardar']:0;
if( $guardar == 1 ){
    $sql = "INSERT INTO tira_informativa (permanente,minutos,mensaje) VALUES (".$tira_permanente.",".$minutos.",'".$mensaje."')";  
    
}
else{
    $sql = "UPDATE tira_informativa SET permanente = $tira_permanente ";
    if( $tira_permanente == 0){
        $sql.=" , minutos= ".$minutos;
    }
    $sql.=" , mensaje = '".$mensaje."' WHERE id = 1";
    
}
        
                
                $res = mysqli_query($enlace, $sql);
                if($res){
                    if( $guardar == 0)
                    $arr_respuesta['msj']="Tira informativa actualizada";
                    else
                    $arr_respuesta['msj']="Tira informativa creada";
                    
                     $arr_respuesta['error']=false;
                }
                else{
                
                    $arr_respuesta['msj']=mysqli_error($enlace);
                    $arr_respuesta['q']=$sql;
                    
                }

echo json_encode($arr_respuesta);

?>