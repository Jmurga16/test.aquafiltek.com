<?php
session_start();
include("connect.php");
$hoy = date('Y-m-d');
$hora = date('H:i:s');
$arr_respuesta = ['error'=>true, 'msj'=>'', 'data'=>[]];

if(!isset($_SESSION['ide']) || $_SESSION['ide'] == NULL){
    $arr_respuesta["msj"]="no tiene sesión";
}
else{
    $script="SELECT dc.`codigo`,dc.`coordenadas`, dc.`nombre_completo`,cg.fecha_gestionp
    FROM `DatosClientes` as dc LEFT JOIN Clientes_gestionados AS cg ON dc.codigo = cg.id_cliente 
    WHERE   DATE(fecha_gestionp) = '$hoy' AND dc.actual_gestion=0 AND dc.inactivo = 0 AND cg.id_operador = ".$_SESSION['ide']." GROUP BY dc.codigo,  
            fecha_gestionp ORDER BY fecha_gestionp DESC"; 
    $resultado=mysqli_query($enlace, $script);
    $arr_repetidos = [];
    if( $resultado ){
        $arr_respuesta['error'] = false;
        while ($fila = mysqli_fetch_array($resultado)) {
            
            /*if( trim($fila['codigo']) != "" ){
                    $fecha_hora = $fila['fecha_gestionp'];
                    echo $fila['codigo']."|".$fila['coordenadas']."|".$fila['nombre_completo']."|".$fila['max_fecha_acepto']."|".$fila['hora_acepto']."=";
                
            }*/
            if( !in_array($fila['codigo'],$arr_repetidos) ){
                $arr_respuesta['data'][] = $fila;
                $arr_repetidos[]=$fila['codigo'];
            }
                
        }
        $query = "SELECT ll.id,ll.realizada,ll.hora_llamada,STR_TO_DATE(ll.fecha_llamada,'%d/%m/%Y') AS max_fecha_acepto ,dc.*
			 FROM `llamadasProgramadas` AS ll 
			 JOIN DatosClientes as dc on dc.codigo=ll.id_cliente 
			  where  ll.realizada = 0  
			  AND (dc.estado like '%Importante%' OR dc.estado like '%importante%' ) AND 
			  (DATE(STR_TO_DATE(ll.fecha_llamada,'%d/%m/%Y')) >= '".$hoy."' AND DATE(STR_TO_DATE(ll.fecha_llamada,'%d/%m/%Y')) >= '".$hoy."')";
            
        $resultado2=mysqli_query($enlace, $query);//


    }
    else{
        $arr_respuesta['msj'] = 'Error al obtener clientes gestionados';
        $arr_respuesta['q1'] = $script.'<br>'.mysqli_error($enlace);
    }
}
echo json_encode($arr_respuesta);
include("QuitDB.php");
