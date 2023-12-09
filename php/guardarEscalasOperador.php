<?php
session_start();
$arr_respuesta = ['error'=>true,'msj'=>''];

if(!isset($_SESSION['ide']) || $_SESSION['ide'] == NULL){
    $arr_respuesta['msj']='Debe iniciar sesión';
    echo json_encode($arr_respuesta);

    exit();
}
include "connect.php";


$idoperador = isset($_POST['idoperador'])?(int)$_POST['idoperador']:-1;
if($idoperador == -1 ){
    $arr_respuesta['msj']='Debe enviar id de operador';
    echo json_encode($arr_respuesta);

    exit();
}
$ids = isset($_POST['ids'])?$_POST['ids']:[];
$valores = isset($_POST['valores'])?$_POST['valores']:[];

/*var_dump($ids);
var_dump($valores);
exit();*/

if(count($ids) == 0 ){
    $arr_respuesta['msj']='Debe enviar id de escalas';
    echo json_encode($arr_respuesta);

    exit();

}
$filas_actualizadas = 0;
$filas_insertadas = 0;
$str='';
foreach($ids as $idx => $id_escala){
    $str.='esc:'.$id_escala.'->';
    if(isset($valores[$idx])){
        $str.='v:'.$valores[$idx].'----';
        $sql = "SELECT id from usuario_escala WHERE usuario_id = '$idoperador' AND escala_id=".$id_escala;
        $str.='sql:'.$sql.PHP_EOL;
        $resultado = mysqli_query($enlace, $sql);
        if($resultado){
            $fila = mysqli_fetch_array($resultado);
            $str.='fil:'.json_encode($fila).'---*';
            if( isset($fila['id']) ){
                //actualizar
                $sql = "UPDATE usuario_escala SET numero = '$valores[$idx]' WHERE usuario_id = '$idoperador' AND escala_id=".$id_escala;
        
                $res = mysqli_query($enlace, $sql);
                if($res){
                    $filas_actualizadas++;
                }
                
        
            }
            else{
                //insert
                $fecha = date("Y-m-d H:i:s");
                $sql = "INSERT INTO usuario_escala (usuario_id,escala_id,numero,fecha) VALUES (".$idoperador.",".$id_escala.",'".$valores[$idx]."','".$fecha."')";  
                $str.='i:'.$sql.PHP_EOL;
                $res = mysqli_query($enlace, $sql);
                if($res){
                    $filas_insertadas++;
                }
                else{
                    $str.='-ei:'.mysqli_error($enlace).'--';
                }
                
            }
    
        }
        else{
            $str.='-e:'.mysqli_error($enlace).'--';
        }
    }
}
$arr_respuesta['filas_actualizadas'] = $filas_actualizadas;
$arr_respuesta['filas_insertadas'] = $filas_insertadas;
$arr_respuesta['str'] = $str;


if( $filas_actualizadas > 0 || $filas_insertadas > 0 ){
    $arr_respuesta['error'] = false;
    $arr_respuesta['msj'] = ($filas_insertadas > $filas_actualizadas )?'Se registraron:'.$filas_insertadas.' escalas':'Se actualizaron:'.$filas_actualizadas.' escalas';
}
echo json_encode($arr_respuesta);

?>