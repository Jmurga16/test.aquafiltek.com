
<?php
 
 include 'connect.php';


 ob_start();




 $queryf = "SELECT *
 FROM  tbl_reportes_clientes join DatosClientes using (codigo) where id_orden_tecnico=".$_REQUEST["id_orden_tecnico"];
 $result2f = mysqli_query($enlace, $queryf);
 $fila4 = mysqli_fetch_array($result2f);



 $tareas.='<tr>
 <td  style="width:700px; color:#000000; font-size: 15px;   line-height:3; border: 1px solid #dddddd;border-top: 1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd;" >
 <b>Nombre del cliene: </b>'.$fila4["nombre_completo"].'
 </td></tr>';

 $tareas.='<tr>
 <td  style="width:700px; color:#000000; font-size: 15px;  line-height:3; border: 1px solid #dddddd;border-top: 1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd;" >
 <b>Datos de Factura: </b>'.$fila4["Datos_factura"].'
 </td></tr>';

 $tareas.='<tr>
 <td  style="width:700px; color:#000000; font-size: 15px;  line-height:3; border: 1px solid #dddddd;border-top: 1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd;" >
 <b>Reporte generado: </b>'.$fila4["fecha_reporte"].' '.$fila4["hora_reporte"].'
 </td></tr>';


 $tareas.='<tr>
 <td  style="width:700px; color:#000000; font-size: 15px;  line-height:3; border: 1px solid #dddddd;border-top: 1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd;" >
 <b>Tipo de recubrimiento: </b>'.$fila4["tipo_recubrimiento"].'
 </td></tr>';

 $tareas.='<tr>
 <td  style="width:700px; color:#000000; font-size: 15px; line-height:3;  border: 1px solid #dddddd;border-top: 1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd;" >
 <b>Estado de Cisterna: </b>'.$fila4["estado_sisterna"].'
 </td></tr>';


 $tareas.='<tr>
 <td  style="width:700px; color:#000000; font-size: 15px;  line-height:3; border: 1px solid #dddddd;border-top: 1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd;" >
 <b>Dimensiones Cisterna  Largo: </b>'.$fila4["largo_sisterna"].'cm * <b>Ancho: </b>'.$fila4["ancho_sisterna"].'cm  * <b> Alto: </b>'.$fila4["alto_tapa"].'cm 
 </td></tr>';


 $tareas.='<tr>
 <td  style="width:700px; color:#000000; font-size: 15px;  line-height:3; border: 1px solid #dddddd;border-top: 1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd;" >
 <b>Capacidad Cisterna : </b>'.$fila4["capacidad_cisterna"].' 
 </td></tr>';

 $tareas.='<tr>
 <td  style="width:700px; color:#000000; font-size: 15px;  line-height:3; border: 1px solid #dddddd;border-top: 1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd;" >
 <b>Dimensiones Tapa  <b>Largo: </b>'.$fila4["largo_tapa"].'cm * Ancho: </b>'.$fila4["ancho_tapa"].'cm
 </td></tr>';





$query1 = "SELECT  DISTINCT(id_tarea), tarea	FROM tbl_ordenes_tareas
join tbl_tareas_detalles using(id_tarea_detalle) 
join tbl_tareas using(id_tarea) WHERE id_orden_tecnico=".$_REQUEST["id_orden_tecnico"];


 $result2 = mysqli_query($enlace, $query1);

			$data="";
            $i=0;
            
			while ($fila = mysqli_fetch_array($result2)) {


                

               

                            $tareas.='<tr>
                            <td  style="width:700px; background-color:#0e6736; color:#ffffff; font-size: 25px; border: 1px solid #dddddd;border-top: 1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd;" >
                            '.$fila["tarea"].'
                            </td></tr>';


                            $query11 = "SELECT  *	FROM tbl_ordenes_tareas
                            join tbl_tareas_detalles using(id_tarea_detalle) 
                            join tbl_tareas using(id_tarea) WHERE id_orden_tecnico=".$_REQUEST["id_orden_tecnico"]." and id_tarea=".$fila["id_tarea"]." and check_marcado=1";
                            $result212 = mysqli_query($enlace, $query11);
            
                            while ($fila3 = mysqli_fetch_array($result212)) {



                            $tareas.='<tr>
                            <td  style="width:700px; color:#000000; font-size: 15px; border: 1px solid #dddddd;border-top: 1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd;" >
                            '.$fila3["detalle_tarea"].'
                            </td></tr>';

                            }

                            
                            $query2 = "SELECT  *	FROM tbl_tareas_imagenes  WHERE  id_tarea=".$fila["id_tarea"];
                            $result21 = mysqli_query($enlace, $query2);
                            $fila2 = mysqli_fetch_array($result21);


                       if($fila2[2]!=""){
                            $ruta1='https://laredworkstation.com/ordenes/aqua/'.$fila2[2];
                            $ruta2='https://laredworkstation.com/ordenes/aqua/'.$fila2[3];
                            $ruta3='https://laredworkstation.com/ordenes/aqua/'.$fila2[4];

                        

                            $tareas.='<tr>
                            <td  style="width:700px; color:#000000; font-size: 15px; border: 1px solid #dddddd;border-top: 1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd;" >
                                <table style="width:700px;"><tr>
                                <td style="width:230px;">Imagen Antes<br>
                                <img src="'.$ruta1.'" width="200" height="200">
                                </td>
                                <td style="width:230px;">Imagen Durante <br>
                                <img src="'.$ruta2.'" width="200" height="200">
                                </td>
                                <td style="width:230px;">Imagen Despues<br>
                                <img src="'.$ruta3.'" width="200" height="200">
                                </td>
                                </tr></table>                            
                            </td></tr>';


                            $tareas.='<tr>
                            <td  style="width:700px; color:#000000; font-size: 15px; border: 1px solid #dddddd;border-top: 1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd;" >
                            <b>Observaciones: </b>'.$fila2["observaciones"].'
                            </td></tr>';
                       }



            }

    
    $content.= ' <page  backtop="4mm" backbottom="4mm" backleft="5mm" backright="5mm">     
    
    <style>
    table{
        table-layout: fixed;
        width: 700px;
        line-height:30px;
    }
        
    </style>
    <table border="0" align="center" >
     
    <tr   align="center" >
    <td  style="width:700px; background-color:#0e6736; color:#ffffff; font-size: 30px; border: 1px solid #dddddd;border-top: 1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd;" >
    Informe 
    </td>
</tr>
'.$tareas.'

</table>   
</page>';


    
   
    
   

require_once('html2pdf_v4.03/html2pdf.class.php');
    
try
{
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        ob_clean(); 
        $html2pdf->Output('reporte.pdf', 'F');

}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}


$host= "mail.aquafiltek.com"; 
$correo  = "info@aquafiltek.com";
$password   = "hzG?tpc1XN{2";
$puerto=26;
$seguridad='';



require_once('PHPMailer_v5.1/class.phpmailer.php');
////Crear una instancia de PHPMailer
//
$mail = new PHPMailer();
$remitente=$correo;
$alias="Aquafiltek";
$name_archivo='reporte.pdf';
$asunto = "Reporte Aquafiltek"; // También puede ser $_GET
$mensaje='Buenas,<br>
Le adjuntamos su reporte.<br><br>
Saludos Cordiales.'; 


$correo_destino='guzbenyramirez@gmail.com';   

 
//        
//        
 try {
//Definir que vamos a usar SMTP
$mail->IsSMTP();
$mail->SMTPDebug  = 1;
$mail->Host       = $host;
$mail->Port       = $puerto;
    if($seguridad!=""){
    $mail->SMTPSecure = $seguridad;
    }
$mail->SMTPAuth   = true;
$mail->Username   = $correo;
$mail->Password   = $password;
$mail->SetFrom($remitente, $alias);
$mail->AddAddress($correo_destino, $alias_destino);
//

$mail->Subject = $asunto;
$mail->MsgHTML($mensaje);
$mail->AddAttachment($name_archivo);
$mail->AltBody = 'El correo no se puede visualizar en este explorador';
$mail->Timeout=30;
$mail->CharSet = 'UTF-8';
       

            if($mail->Send()) // Envía el correo.
            {
//           
                       $result["estado"]="correo_enviado";
//                    }
            }
            else{
                        $result["mensaje"]="No se notifico por Correo";
            }
//
} 
catch (phpmailerException $e) {
	$result["estado"]="error_correo";
	$result["mensaje"]="No se notifico por Correo";
} 
catch (Exception $e) {
	$result["estado"]="error_correo";
	$result["mensaje"]="No se notifico por Correo";
	
}


//echo $result["estado"];
        












