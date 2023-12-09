<?php
include("connect.php");
$hoy = date('Y-m-d');
$hora = date('H:i:s');
$hoy_cero = $hoy.' 00:00:00';
$ahora = new DateTime();
$cliente_busqueda = isset($_POST['cliente'])?$_POST['cliente']:'';
$script="SELECT dc.`codigo`,dc.`coordenadas`, dc.`nombre_completo`,MAX(STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y')) AS max_fecha_acepto, ga.hora_acepto
FROM `DatosClientes` as dc LEFT JOIN Gestion_acepto AS ga ON dc.codigo = ga.codigo_cliente 
WHERE  ( STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y') >= '$hoy' AND  dc.actual_gestion=0  ) AND inactivo = 0 OR dc.codigo = '".$cliente_busqueda."' AND inactivo = 0 GROUP BY dc.codigo, 
        STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y') ORDER BY max_fecha_acepto LIMIT 9"; // STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y') >= '$hoy' AND
$resultado=mysqli_query($enlace, $script);//
//echo $script;exit();

//obtener llamadas importantes
 $query = "SELECT ll.id,ll.realizada,ll.hora_llamada,STR_TO_DATE(ll.fecha_llamada,'%d/%m/%Y') AS max_fecha_acepto ,dc.*
			 FROM `llamadasProgramadas` AS ll 
			 JOIN DatosClientes as dc on dc.codigo=ll.id_cliente 
			  where  ll.realizada = 0  
			  AND (dc.estado like '%Importante%' OR dc.estado like '%importante%' ) AND DATE(STR_TO_DATE(ll.fecha_llamada,'%d/%m/%Y')) >= '".$hoy."'";
            
$resultado2=mysqli_query($enlace, $query);//

if( $resultado ){
    $arr_repetidos = [];
    if( $cliente_busqueda != '' ){
        while ($fila = mysqli_fetch_array($resultado)) {
            if( trim($fila['codigo']) != "" ){
                         echo $fila['codigo']."|".$fila['coordenadas']."|".$fila['nombre_completo']."|".$fila['max_fecha_acepto']."|".$fila['hora_acepto']."=";
                    
                        $arr_repetidos[] = $fila['codigo'];
                
            }
                
        }
        //27082021
        while ($fila = mysqli_fetch_array($resultado2)) {
            if( trim($fila['codigo']) != "" && !in_array($fila['codigo'],$arr_repetidos)){
                         echo $fila['codigo']."|".$fila['coordenadas']."|".$fila['nombre_completo']."|".$fila['max_fecha_acepto']."|".$fila['hora_llamada']."=";
                    
                        $arr_repetidos[] = $fila['codigo'];
                
            }
                
        }
    }
    else{
        while ($fila = mysqli_fetch_array($resultado)) {
            if( trim($fila['codigo']) != "" ){
                if( strtotime($fila['hora_acepto']) !== false ){
                    $fecha_hora = $fila['max_fecha_acepto'].' '.$fila['hora_acepto'];
                    $fecha_hora = new DateTime($fecha_hora);
                    if( $fecha_hora >= $ahora && !in_array($fila['codigo'], $arr_repetidos) ){
                        $sql = "SELECT id_cliente FROM Clientes_gestionados WHERE id_cliente = '".$fila['codigo']."' AND 
                        (fecha_gestionp >= '".$hoy_cero."' AND fecha_gestionp <='".$ahora->format("Y-m-d H:i:s")."' ) LIMIT 1"; 
                        $rs = mysqli_query( $enlace, $sql );
                        $num_filas = mysqli_num_rows($rs);
                        //if( $num_filas == 0 )
                        echo $fila['codigo']."|".$fila['coordenadas']."|".$fila['nombre_completo']."|".$fila['max_fecha_acepto']."|".$fila['hora_acepto']."=";
                    
                        $arr_repetidos[] = $fila['codigo'];
                    }
                }
                
            }
                
        }
        //27082021
        while ($fila = mysqli_fetch_array($resultado2)) {
            if( trim($fila['codigo']) != "" ){
                if( strtotime($fila['hora_llamada']) !== false ){
                    $fecha_hora = $fila['max_fecha_acepto'].' '.$fila['hora_llamada'];
                    $fecha_hora = new DateTime($fecha_hora);
                    if( $fecha_hora >= $ahora && !in_array($fila['codigo'], $arr_repetidos) ){
                        $sql = "SELECT id_cliente FROM Clientes_gestionados WHERE id_cliente = '".$fila['codigo']."' AND 
                        (fecha_gestionp >= '".$hoy_cero."' AND fecha_gestionp <='".$ahora->format("Y-m-d H:i:s")."' ) LIMIT 1"; 
                        $rs = mysqli_query( $enlace, $sql );
                        $num_filas = mysqli_num_rows($rs);
                        //if( $num_filas == 0 )
                        echo $fila['codigo']."|".$fila['coordenadas']."|".$fila['nombre_completo']."|".$fila['max_fecha_acepto']."|".$fila['hora_llamada']."=";
                    
                        $arr_repetidos[] = $fila['codigo'];
                    }
                }
                
            }
                
        }
        
    }
}
else{
    echo $script.'<br>'.mysqli_error($enlace);
}

include("QuitDB.php");
