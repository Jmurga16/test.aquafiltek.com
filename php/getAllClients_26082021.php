<?php
include("connect.php");
$hoy = date('Y-m-d');
$hora = date('H:i:s');
$ahora = new DateTime();
$script="SELECT dc.`codigo`,dc.`coordenadas`, dc.`nombre_completo`,MAX(STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y')) AS max_fecha_acepto, ga.hora_acepto
FROM `DatosClientes` as dc LEFT JOIN Gestion_acepto AS ga ON dc.codigo = ga.codigo_cliente 
WHERE  STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y') >= '$hoy' AND  dc.actual_gestion=0   GROUP BY dc.codigo, 
        STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y') ORDER BY max_fecha_acepto LIMIT 9"; // STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y') >= '$hoy' AND
$resultado=mysqli_query($enlace, $script);//
if( $resultado ){
    $arr_repetidos = [];
    while ($fila = mysqli_fetch_array($resultado)) {
        if( trim($fila['codigo']) != "" ){
            if( strtotime($fila['hora_acepto']) !== false ){
                $fecha_hora = $fila['max_fecha_acepto'].' '.$fila['hora_acepto'];
                $fecha_hora = new DateTime($fecha_hora);
                if( $fecha_hora >= $ahora && !in_array($fila['codigo'], $arr_repetidos) ){
                    $sql = "SELECT id_cliente FROM Clientes_gestionados WHERE id_cliente = '".$fila['codigo']."' AND DATE(fecha_gestionp) = '".$hoy."' LIMIT 1"; 
                    $rs = mysqli_query( $enlace, $sql );
                    $num_filas = mysqli_num_rows($rs);
                    //if( $num_filas == 0 )
                    echo $fila['codigo']."|".$fila['coordenadas']."|".$fila['nombre_completo']."|".$fila['max_fecha_acepto']."|".$fila['hora_acepto']."=";
                
                    $arr_repetidos[] = $fila['codigo'];
                }
            }
            
        }
            
    }
}
else{
    echo $script.'<br>'.mysqli_error($enlace);
}

include("QuitDB.php");
