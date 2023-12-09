<?php
session_start();
$arr_respuesta = ['error'=>true,'msj'=>''];

if(!isset($_SESSION['ide']) || $_SESSION['ide'] == NULL){
    $arr_respuesta['msj']='Debe iniciar sesión';
    echo json_encode($arr_respuesta);

    exit();
}
include "connect.php";
$filtros = isset($_POST['filtros'])?$_POST['filtros']:[];
$fecha_inicio = isset($_POST['fecha_inicio'])?$_POST['fecha_inicio']:'';
$fecha_fin = isset($_POST['fecha_fin'])?$_POST['fecha_fin']:'';

$sql = "SELECT codigo, estado,nombre_completo, direccion, fecha_gestion from DatosClientes  WHERE 1 ";
if($fecha_inicio != '')
$sql .= " AND fecha_gestion >= '".$fecha_inicio."'";
if($fecha_fin != '')
$sql .= " AND fecha_gestion <= '".$fecha_fin."'";
$arr_condiciones = [];
if( count($filtros) > 0){
    $sql .= " AND ( ";
    foreach($filtros as $filtro){
        $arr_condiciones[]= " estado LIKE '%".$filtro."%' ";
    }
    $str_condiciones = implode(' OR ',$arr_condiciones); 
    $sql .= $str_condiciones. " ) ";
    
}
$sql.=" ORDER BY fecha_gestion DESC, nombre_completo ASC LIMIT 50 ";
$arr_respuesta['sql']=$sql;
$resultado = mysqli_query($enlace, $sql);
if($resultado){
    $num_filas=0;
    while ($fila = mysqli_fetch_array($resultado)) {
        $tipo_gestion = '';
        $pos = strpos($fila['estado'], 'Acepto');
        $pos2 = strpos($fila['estado'], 'Cobros');
        $pos3 = strpos($fila['estado'], 'Inspección');
        $pos4 = strpos($fila['estado'], 'Importante');
        
        if( $pos !== false ){
            $tipo_gestion = 'Aceptó';
        }
        else if( $pos2 !== false ){
            $tipo_gestion = 'Cobros';
        }
        else if( $pos3 !== false ){
            $tipo_gestion = 'Inspección';
        }
        else if( $pos4 !== false ){
            $tipo_gestion = 'Importante';
        }
        else{
            $tipo_gestion = $fila['estado'];
        }
       $cliente["codigo"] = $fila["codigo"];
       $cliente["nombre_completo"] = $fila["nombre_completo"];
       $cliente["tipo_gestion"] = $tipo_gestion;
       $cliente["direccion"] = $fila["direccion"];
       $cliente["fecha_gestion"] = $fila["fecha_gestion"];
       $arr_respuesta['filas'][] = $cliente;
       
    }
    $arr_respuesta['error'] = false;
    $arr_respuesta['numero_filas'] = $num_filas;
    
	
}
else{
    $arr_respuesta['msj'] = 'Error al obtener datos de filtros ';
}
echo json_encode($arr_respuesta);

?>