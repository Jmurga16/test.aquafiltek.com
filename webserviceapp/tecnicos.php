<?php

error_reporting(0);
header('content-type: application/json; charset=utf-8');
//en caso de json en vez de jsonp habría que habilitar CORS:
header("access-control-allow-origin: *");



    include 'connect.php';




    switch ($_REQUEST["accion"])
	{


		
		
		
		case "mostrar_check_tarea_ob":


			$query1 = "SELECT  * FROM tbl_tareas_detalles WHERE  id_tarea=".$_REQUEST["id_tarea"];




		$datos="";
			$result = mysqli_query($enlace, $query1);
            $i=0;
            
			while ($fila = mysqli_fetch_array($result)) {

				
			
                $datos.=' <div>		  
				  <div> <input type="checkbox" name="detalles[]" style="width:30%" value="'.$fila["id_tarea_detalle"].'" /> '.$fila["detalle_tarea"].'</div>				
			  </div><br>';

				$i++;
			}	


            $retorna["estado"]="true";
			$retorna["datos"]=$datos;
			


			echo json_encode($retorna);

		break;



		
		case "mostrar_check_tarea":
			$query1 = "SELECT  *	FROM tbl_ordenes_tareas
			join tbl_tareas_detalles using(id_tarea_detalle) 
			join tbl_tareas using(id_tarea) WHERE id_orden_tecnico=".$_REQUEST["id_orden_tecnico"]." and id_tarea=".$_REQUEST["id_tarea"];




			$query2 = "SELECT  *	FROM tbl_tareas_imagenes  WHERE id_orden_tecnico=".$_REQUEST["id_orden_tecnico"]." and id_tarea=".$_REQUEST["id_tarea"];
			$result2 = mysqli_query($enlace, $query2);
			$fila2 = mysqli_fetch_array($result2);

			$data="";
			$result = mysqli_query($enlace, $query1);
            $i=0;
            
			while ($fila = mysqli_fetch_array($result)) {

				$che="";
				if($fila["check_marcado"]==1){
					$che="checked";
				}
			
                $datos.=' <li>
				<label class="item-checkbox item-content">
				  <input type="checkbox" name="demo-checkbox" value="'.$fila["id_tarea_detalle"].'" '.$che.'/>
				  <i class="icon icon-checkbox"></i>
				  <div class="item-inner">
					<div class="item-title">'.$fila["detalle_tarea"].'</div>
				  </div>
				</label>
			  </li>';

				$i++;
			}	


            $retorna["estado"]="true";
			$retorna["datos"]=$datos;
			

			if($fila2[0]!=""){
			$retorna["antes"]="https://laredworkstation.com/ordenes/aqua/thumb_".$fila2[2];
			$retorna["durante"]="https://laredworkstation.com/ordenes/aqua/thumb_".$fila2[3];
			$retorna["despues"]="https://laredworkstation.com/ordenes/aqua/thumb_".$fila2[4];
			$retorna["observacion"]=$fila2[5];
			$retorna["imagenes"]="si";

			}else{
				$retorna["imagenes"]="no";

			}

			echo json_encode($retorna);

		break;



		case "mostrar_tareas_tecnicos":


			$query1 = "SELECT  DISTINCT(id_tarea), tarea	FROM tbl_tareas";
			$datos="";
			$result = mysqli_query($enlace, $query1);
            $i=0;            
			while ($fila = mysqli_fetch_array($result)) {			
                $datos.='<option  value="'.$fila[0].'">'.$fila[1].'</option>';
				$i++;
			}	




			$query2 = "SELECT id,name,tipo	FROM DatosIngreso where tipo=1";
			$datos1="";
			$result2 = mysqli_query($enlace, $query2);
            $i=0;            
			while ($fila2 = mysqli_fetch_array($result2)) {			
                $datos1.='<option  value="'.$fila2[0].'">'.$fila2[1].'</option>';
				$i++;
			}	





            $retorna["estado"]="true";
			$retorna["tareas"]=$datos;
			$retorna["tecnicos"]=$datos1;
			echo json_encode($retorna);

		break;




		
        case "mostrar_tareas":
			$query1 = "SELECT  DISTINCT(id_tarea), tarea	FROM tbl_ordenes_tareas
			join tbl_tareas_detalles using(id_tarea_detalle) 
			join tbl_tareas using(id_tarea) WHERE id_orden_tecnico=".$_REQUEST["id_orden_tecnico"];





			$data="";
			$result = mysqli_query($enlace, $query1);
            $i=0;
            
			while ($fila = mysqli_fetch_array($result)) {

			
                $datos.='<li><a href="#" id="tare_text_'.$fila[0].'" onclick="vernotra_info('.$fila[0].')">'.$fila[1].'</a></li>';

				$i++;
			}	


            $retorna["estado"]="true";
            $retorna["datos"]=$datos;
			echo json_encode($retorna);

		break;





        case "mostrar_ordenes":
			/**$query1 = "SELECT *
			FROM Gestion_acepto AS ga 
			JOIN DatosClientes as dc on dc.codigo=ga.codigo_cliente 
			join Clientes_gestionados as cg on cg.id_cliente=ga.codigo_cliente 
			join DatosIngreso as di on di.id=cg.id_operador limit 1";


//$fecha=date('Y-m-d');
$fecha='2020-01-08';


*/
//$_REQUEST["id_tecnico"]=11;

$query33=" SELECT * FROM tbl_ordenes_tecnicos 
WHERE id_tecnico=".$_REQUEST["id_tecnico"]." and fecha_programada='".date('Y-m-d')."' and id_estatu_orden=1 ORDER BY hora_programada asc ";

			$data="";
			$result = mysqli_query($enlace, $query33);
            $i=0;
			
			
			while ($fila = mysqli_fetch_array($result)) {


				$tarea_r="";
				$query331=" SELECT * FROM tbl_ordenes_tareas  join tbl_tareas_detalles using(id_tarea_detalle) join tbl_tareas using(id_tarea)
				WHERE id_orden_tecnico=".$fila["id_orden_tecnico"];
				$result_traeas = mysqli_query($enlace, $query331);

				$k=0;
				while ($tareas = mysqli_fetch_array($result_traeas)) {
					$k++;
					$tarea_r=$tarea_r."<b>".$k."-</b> ".$tareas["tarea"]." (".$tareas["detalle_tarea"].")<br>";

				}
				//STR_TO_DATE(ga.fecha_acepto, '%d/%m/%Y')='".$fecha."' and
$queryf = "SELECT ga.primaryk as id, dc.nombre_completo, dc.telefono,
dc.coordenadas,
dc.codigo,
dc.direccion,
dc.Datos_factura,
di.user, STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y') as fecha, ga.hora_acepto
FROM `Gestion_acepto` AS ga 
JOIN DatosClientes as dc on dc.codigo=ga.codigo_cliente 
left join Clientes_gestionados as cg on cg.id_cliente=ga.codigo_cliente 
left join DatosIngreso as di on di.id=cg.id_operador where   ga.primaryk=".$fila["id_referencia"]." order by hora_acepto asc limit 1";
$result1 = mysqli_query($enlace, $queryf);
$tareas_det = mysqli_fetch_array($result1);


				/*$data="Nombre: ".$fila["nombre_completo"]." (".$fila["codigo"].")<br>";
				$data.="Direccion: ".$fila["direccion"]."<br>";
				$data.="Datos Factura: ".$fila["Datos_factura"]."<br>";
				$data.="Telefono Principal: ".$fila["telefono"]."<br>";
				$data.="Telefono oficina: ".$fila["telefono_oficina"]."<br>";
				$data.="Celular 1: ".$fila["celular1"]."<br>";
				$data.="Celular 2: ".$fila["celular2"]."<br>";
				$data.="Operador : ".$fila["user"];
*/
				if($i==0){
				$filass='onclick="detalle_roiden('.$fila["id_orden_tecnico"].')"';
				}else{
					$filass='';
				}

				$datos.='<li '.$filass.'>
<label class="item-radio item-content">
  <input type="radio" name="checsolicitudes" value="'.$i.'"  />
  <i class="icon icon-radio"></i>                
  <div class="item-inner">
	<div class="item-title-row">
	<input type="hidden"  id="coordenadas_sitio_'.$fila["id_orden_tecnico"].'" name="coordenadas_sitio_'.$fila["id_orden_tecnico"].'" value="'.$tareas_det["coordenadas"].'">
	<input type="hidden"  id="codigo_select_'.$fila["id_orden_tecnico"].'" name="codigo_select_'.$fila["id_orden_tecnico"].'" value="'.$tareas_det["codigo"].'">

	  <div class="item-title" id="nombre_solicitud_'.$fila["id_orden_tecnico"].'">'.$tareas_det["nombre_completo"].' ('.$tareas_det["codigo"].')</div>
	</div>
	<div class="item-subtitle" id="fecha_'.$fila["id_orden_tecnico"].'"><b>Fecha: '.$fila["fecha_programada"].'</b></div>
	<div class="item-subtitle" id="hora_'.$fila["id_orden_tecnico"].'"><b>Hora de Visita: '.$fila["hora_programada"].'</b></div>
	<div class="item-subtitle" id="direccio_'.$fila["id_orden_tecnico"].'">Dirección:'.$tareas_det["direccion"].'</div>
    <div class="item-text" id="datos_fac'.$fila["id_orden_tecnico"].'">Datos Factura: '.$tareas_det["Datos_factura"].'</div>
	<div class="item-text" id="obser_c'.$fila["id_orden_tecnico"].'">Observacion: '.$tareas_det["observacion_solicitud"].'</div>
	<div class="item-item-title-row" id="tareas_c'.$fila["id_orden_tecnico"].'"><b>TAREAS:</b><br>'.$tarea_r.'</div>
  </div>
</label>
</li>';

$i++;
			}	


            $retorna["estado"]="true";
            $retorna["datos"]=$datos;

			echo json_encode($retorna);

		break;





		
        case "consultar_cliente":
			$query = "SELECT *
			FROM  DatosClientes where codigo='".$_REQUEST["cliente_sec"]."'";


			$data="";
			$result = mysqli_query($enlace, $query);
            $i=0;
            
			$fila = mysqli_fetch_array($result);

			


            $retorna["estado"]="true";
            $retorna["nombre"]=$fila["nombre_completo"];
			$retorna["direccion"]=$fila["direccion"];
			if($fila["fotoper"]==""){
				$retorna["foto"]="https://aquafiltek.com/webserviceapp/protegidos/user.png";

			}else{
				$retorna["foto"]="https://aquafiltek.com/webserviceapp/protegidos/".$fila["fotoper"];

			}

			echo json_encode($retorna);

		break;


		case "insertar_coorder":

			echo "si";
			$coordew=$_REQUEST["latitud"].";".$_REQUEST["longitud"];
		
			$query3 = " INSERT INTO   tbl_historial_posiciones  (coordenadas,fecha_coorde,hora_coorde,id_tecnico)
			VALUES ('".$coordew."','".date('Y-m-d')."','".date('H:i:s')."','".$_REQUEST["id_tecnico"]."')";
	
		
	echo $query3;
	exit();
	
				if(mysqli_query($enlace, $query3)){
					
					$retorna["estado"]="true";
					$retorna["id"]=mysqli_insert_id($enlace);
					$retorna["mensaje"]="Fue registrado con exito!";
				}
				else{
		
					$retorna["estado"]="false";
					$retorna["mensaje"]="A ocurrido un problema 109!";
		
				}    
				echo json_encode($retorna);
		
			break;

			




		case "guardar_tarea_general":

		
		$query3 = " INSERT INTO   tbl_reportes_clientes  (fecha_reporte,hora_reporte,coordenas_reporte,codigo,comentario_tecnico,tipo_recubrimiento,estado_sisterna,usuario,largo_sisterna,ancho_sisterna,ancho_tapa,alto_tapa,largo_tapa,id_orden_tecnico,capacidad_cisterna)
		VALUES ('".date('Y-m-d')."', '".date('H:i:s')."', '".$_REQUEST["coode"]."', '".$_REQUEST["codigo"]."','".$_REQUEST["comentario_tecnico"]."','".$_REQUEST["tipo_recubrimiento"]."','".$_REQUEST["estado_sisterna"]."','".$_REQUEST["usuario"]."','".$_REQUEST["largo_cisterna"]."','".$_REQUEST["ancho_cisterna"]."','".$_REQUEST["ancho_tapa"]."','".$_REQUEST["alto_tapa"]."','".$_REQUEST["tapa_largo"]."','".$_REQUEST["id_orden_tecnico"]."','".$_REQUEST["capacidad_cisterna"]."' );";

	

			if(mysqli_query($enlace, $query3)){
				
				$retorna["estado"]="true";
				$retorna["id"]=mysqli_insert_id($enlace);
				$retorna["mensaje"]="Fue registrado con exito!";
			}
			else{
	
				$retorna["estado"]="false";
				$retorna["mensaje"]="A ocurrido un problema 109!";
	
			}    
			echo json_encode($retorna);
	
		break;

		case "guardar_tarea":


			$detalles = json_decode($_REQUEST["formulario"], true);
			$query3 = " INSERT INTO   tbl_tareas_imagenes  (id_tarea,img_antes,img_durante,img_despues,observaciones,id_orden_tecnico)
			VALUES ('".$_REQUEST["id_tarea"]."', '".$_REQUEST["img_antes"]."','".$_REQUEST["img_durante"]."','".$_REQUEST["img_despues"]."','".$detalles['observsacion_nota']."','".$_REQUEST["id_orden_tecnico"]."')";
		
			if(mysqli_query($enlace, $query3)){
				foreach($detalles["demo-checkbox"] as $index => $resultado){
				
							$query = " UPDATE  tbl_ordenes_tareas  SET  check_marcado='1'  where id_orden_tarea=".$resultado;
							mysqli_query($enlace, $query);
				}
				$retorna["estado"]="true";
				$retorna["mensaje"]="Fue registrado con exito!";
			}
			else{
	
				$retorna["estado"]="false";
				$retorna["mensaje"]="A ocurrido un problema 109!";
	
			}    
			echo json_encode($retorna);
	
		break;
	

		case "registrar_informe":
		$query3 = " INSERT INTO   tbl_reportes_clientes  (fecha_reporte,hora_reporte,coordenas_reporte,codigo,foto_1,foto_2,foto_3,foto_4,foto_5,foto_6,comentario_tecnico,medidor_cot,medidor_tapa,tipo_recubrimiento,estado_sisterna,usuario,observsacion_nota_1,observsacion_nota_2,observsacion_nota_3,observsacion_nota_4,observsacion_nota_5,observsacion_nota_6,firma_reporte)
		VALUES ('".date('Y-m-d')."', '".date('H:i:s')."', '".$_REQUEST["coode"]."', '".$_REQUEST["codigo"]."','".$_REQUEST["foto_1"]."','".$_REQUEST["foto_2"]."','".$_REQUEST["foto_3"]."','".$_REQUEST["foto_4"]."','".$_REQUEST["foto_5"]."','".$_REQUEST["foto_6"]."','".$_REQUEST["comentario_tecnico"]."','".$_REQUEST["medidor_cot"]."','".$_REQUEST["medidor_tapa"]."','".$_REQUEST["tipo_recubrimiento"]."','".$_REQUEST["estado_sisterna"]."','".$_REQUEST["usuario"]."','".$_REQUEST["observsacion_nota_1"]."','".$_REQUEST["observsacion_nota_2"]."','".$_REQUEST["observsacion_nota_3"]."','".$_REQUEST["observsacion_nota_4"]."','".$_REQUEST["observsacion_nota_5"]."','".$_REQUEST["observsacion_nota_6"]."','".$_REQUEST["firma"]."');";

		if(mysqli_query($enlace, $query3)){


			$retorna["estado"]="true";
			$retorna["mensaje"]="Fue registrado con exito!";
		}
		else{

			$retorna["estado"]="false";
			$retorna["mensaje"]="A ocurrido un problema 109!";

		}    

		echo json_encode($retorna);

		break;



		

		case	"registrar_firma":


		
			$query3 = " UPDATE  tbl_reportes_clientes SET firma_reporte='".$_REQUEST["firma"]."'  WHERE  id_orden_tecnico='".$_REQUEST["id_orden_tecnico"]."'";
			$result3 = mysqli_query($enlace, $query3);
			$conte3=mysqli_fetch_array($result3);



			$query31 = " UPDATE  tbl_ordenes_tecnicos SET id_estatu_orden=2  WHERE  id_orden_tecnico='".$_REQUEST["id_orden_tecnico"]."'";
			$result31 = mysqli_query($enlace, $query31);
			$conte31=mysqli_fetch_array($result31);


		  
			include 'reporte_correo.php';
	



			$retorna["estado"]="true";
			$retorna["mensaje"]="El registro fue realizado de manera exitosa.";  

			echo json_encode($retorna);

		break;


		case	"actualizar_coorde":


			$query3 = " UPDATE  DatosClientes SET coordenadas='".$_REQUEST["coode"]."'  WHERE  codigo='".$_REQUEST["cliente_sec"]."'";
			$result3 = mysqli_query($enlace, $query3);

			$conte3=mysqli_fetch_array($result3);

		  

			

			$retorna["estado"]="true";
			$retorna["mensaje"]="Las coordenadas fueron actualizadas.";  

			echo json_encode($retorna);

		break;


		


		case	"actualizar_cliente":


			$query3 = " UPDATE  DatosClientes SET nombre_completo='".$_REQUEST["nombre_cliente"]."', direccion='".$_REQUEST["direccion_clie"]."'  WHERE  codigo='".$_REQUEST["cliente_sec"]."'";
			$result3 = mysqli_query($enlace, $query3);

	

		  
            
			if(!$result3){
				$retorna["estado"]="false";
				$retorna["mensaje"]="No se puede registrar (101).";
			}
			else{

			$retorna["estado"]="true";
			$retorna["mensaje"]="Los datos fueron actualizados.";  

			}

			echo json_encode($retorna);

		break;

            
    }      
    




 
    include 'QuitDB.php';
    ?>