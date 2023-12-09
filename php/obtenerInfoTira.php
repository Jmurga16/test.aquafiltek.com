<?php
session_start();
$arr_respuesta = ['error'=>true,'msj'=>''];

if(!isset($_SESSION['ide']) || $_SESSION['ide'] == NULL){
    $arr_respuesta['msj']='Debe iniciar sesión';
    echo json_encode($arr_respuesta);

    exit();
}
include "connect.php";



$sql = "SELECT * from tipos_gestion";
$resultado = mysqli_query($enlace, $sql);
$arr_gestiones = [];
if($resultado){
    while ($fila = mysqli_fetch_array($resultado)) {
        $arr_gestiones[] = ['id'=>$fila['id'], 'gestion'=>$fila['descripcion'],'cantidad'=>0];
    }
}
else{
    $arr_respuesta['q1']=mysqli_error($enlace);
}
//$sql = "SELECT * from clientes_gestionados_otros WHERE id_operador = ".$_SESSION['ide'];
$arr_respuesta['g'] = $arr_gestiones;
$result_cont = mysqli_query($enlace, "SELECT tgd.*,dc.nombre_completo  FROM `tipo_gestiones_dia` AS tgd JOIN 
	 DatosClientes AS dc ON dc.codigo = tgd.usuario_gestionado WHERE tgd.`id_operador`=" . $_SESSION['ide']);
$t_acepto = 0;
	$t_rechazo = 0;
	$t_volver_llamar = 0;
	$t_no_responde = 0;
	$t_otro = 0;
	$t_equivocado = 0;
	$t_averiado = 0;
	$t_inspeccion = 0;
	$t_cobros = 0;
	$t_importante = 0;
	
if($result_cont){
	while ($data_cont = mysqli_fetch_array($result_cont)) {
		switch ($data_cont['tipo_gestion']) {
		case 'ac':
			$t_acepto++;
			break;
		case 're':
			$t_rechazo++;
			break;
		case 'vl':
			$t_volver_llamar++;
			break;
		case 'nr':
			$t_no_responde++;
			break;
		case 'ot':
			$t_otro++;
			break;
		case 'eq':
			$t_equivocado++;
			break;
		case 'av':
			$t_averiado++;
			break;
		case 'in':
		    $t_inspeccion++; 
		    break;
		
		case 'co':
		    $t_cobros++; 
		    break;
		case 'vi':
		    $t_importante++; 
		    break;
		    
		}
	}
	
	$arr_respuesta['gestiones'][]=['gestion'=>'Aceptó','cantidad'=>$t_acepto];
	$arr_respuesta['gestiones'][]=['gestion'=>'Inspección','cantidad'=>$t_inspeccion];
	$arr_respuesta['gestiones'][]=['gestion'=>'Cobros','cantidad'=>$t_cobros];
	$arr_respuesta['gestiones'][]=['gestion'=>'Importante','cantidad'=>$t_importante];
	$arr_respuesta['error'] = false;
	
	
	$date=date('Y-m-d');
    $nueva=date("Y-m-d",strtotime($date."- 30 days")); 
    
    
    $total='';
    $script = "SELECT lp.id_cliente,lp.hora_llamada, STR_TO_DATE(lp.fecha_llamada, '%d/%m/%Y') as fes
    FROM llamadasProgramadas AS lp
    inner join Clientes_gestionados as cg
    inner join DatosClientes as dc
    ON lp.id_cliente=cg.id_cliente
    AND dc.codigo=lp.id_cliente
    AND lp.realizada=0
    AND STR_TO_DATE(lp.fecha_llamada, '%d/%m/%Y') BETWEEN  '$nueva' and '$date'
    AND cg.id_operador=".$_SESSION['ide']." ORDER by fes desc";
    
    
    $resultado = mysqli_query($enlace, $script);
    $t_recordatorios = 0;
    while ($fila = mysqli_fetch_array($resultado)) {
        $t_recordatorios++;
    }
    $arr_respuesta['gestiones'][]=['gestion'=>'Recordatorios vencidos','cantidad'=>$t_recordatorios];
	

/*$arr_respuesta['d']=[]; 

$resultado = mysqli_query($enlace, $sql);
if($resultado){
    while ($fila = mysqli_fetch_array($resultado)) {
      //$arr_respuesta['d'][] = $fila;
      $key = array_search($fila['id_tipo_gestion'], array_column($arr_gestiones, 'id'));
      $arr_gestiones[$key]['cantidad']++;
       
    }
    $arr_respuesta['gestiones']=$arr_gestiones;
    $arr_respuesta['error'] = false;
    
	
}*/
}
else{
    $arr_respuesta['msj'] = 'Error al obtener datos de operador ';
}
echo json_encode($arr_respuesta);

?>