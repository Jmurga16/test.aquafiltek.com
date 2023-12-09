<?php
$arr_respuesta = ['error'=>true,'msj'=>''];


$meses = (int)$_POST['meses'];
$arr_respuesta['meses'] = $meses;
$fecha_post_venta = $_POST['fecha_post_venta'];
$arr_fecha = explode("/",$fecha_post_venta);
$new_fecha = $arr_fecha[2]."-".$arr_fecha[1]."-".$arr_fecha[0];
$obj_fecha = new DateTime($new_fecha);
function isWeekend($date) {
       
        return (date('N', strtotime($date)) >= 6);
    }
if($obj_fecha){
    $arr_respuesta['antes'] = $obj_fecha->format('Y-m-d');
    $str = '+'.$meses.' month';
    $obj_fecha->modify($str);
    $arr_respuesta['despues'] = $obj_fecha->format('Y-m-d');
    $arr_respuesta['str'] = $str;
    
    if( isWeekend($obj_fecha->format('Y-m-d')) ){
        $obj_fecha->modify('+1 weekday');
    }
    $arr_respuesta['post'] = $_POST;
    $arr_respuesta['new_fecha'] = $new_fecha;
    $futura = $obj_fecha->format('Y-m-d');
    $arr_respuesta['futura'] = $futura;
    $arr_respuesta['error'] = false;

}
else{
    echo $new_fecha;
}
echo json_encode($arr_respuesta);

?>