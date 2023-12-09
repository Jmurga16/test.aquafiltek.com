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



    if(isset($_POST['ids']))
    {
        $ids = $_POST['ids'];

        $cant = count($ids);
        
        $i = 1;
        
        $cadena = '';
        foreach($ids AS $val)
        {
            if($i == $cant)
            {
                $cadena .= "'".$val."'";
            }
            else
            {
                $cadena .= "'".$val."',";
            }
            $i++;
        }
    }
    else
    {
        $cadena = '1';
    }




    $script="SELECT dc.`codigo`,dc.`coordenadas`, dc.`nombre_completo`,cg.fecha_gestionp
    FROM `DatosClientes` as dc LEFT JOIN Clientes_gestionados AS cg ON dc.codigo = cg.id_cliente 
    WHERE  dc.`codigo` IN($cadena)"; 


    $resultado=mysqli_query($enlace, $script);
    $arr_repetidos = [];
    if( $resultado ){
        $arr_respuesta['error'] = false;
        while ($fila = mysqli_fetch_array($resultado)) {
            
  
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
