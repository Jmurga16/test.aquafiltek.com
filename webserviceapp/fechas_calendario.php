<?php
include "connect.php";


	switch ($_REQUEST["accion"])
	{
		
		case "detalle":
			$query = "SELECT *
			FROM Gestion_acepto AS ga 
			JOIN DatosClientes as dc on dc.codigo=ga.codigo_cliente 
			join Clientes_gestionados as cg on cg.id_cliente=ga.codigo_cliente 
			join DatosIngreso as di on di.id=cg.id_operador where ga.primaryk=".$_REQUEST["id"];


			$data="";
			$result = mysqli_query($enlace, $query);
			
			while ($fila = mysqli_fetch_array($result)) {

				$data="Nombre: ".$fila["nombre_completo"]." (".$fila["codigo"].")<br>";
				$data.="Direccion: ".$fila["direccion"]."<br>";
				$data.="Datos Factura: ".$fila["Datos_factura"]."<br>";
				$data.="Telefono Principal: ".$fila["telefono"]."<br>";
				$data.="Telefono oficina: ".$fila["telefono_oficina"]."<br>";
				$data.="Celular 1: ".$fila["celular1"]."<br>";
				$data.="Celular 2: ".$fila["celular2"]."<br>";
				$data.="Operador : ".$fila["user"];

			}	

			$data1=str_replace('"',"",$data);
			echo json_encode($data1);

		break;

		
		case "consultar":
	
			$query = "SELECT ga.primaryk as id, dc.nombre_completo, dc.telefono, di.user, STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y') as fecha, ga.hora_acepto
			 FROM `Gestion_acepto` AS ga 
			 JOIN DatosClientes as dc on dc.codigo=ga.codigo_cliente 
			 join Clientes_gestionados as cg on cg.id_cliente=ga.codigo_cliente 
			 join DatosIngreso as di on di.id=cg.id_operador where YEAR(STR_TO_DATE(ga.fecha_acepto, '%d/%m/%Y'))=".date('Y');

			$result = mysqli_query($enlace, $query);
			while ($fila = mysqli_fetch_array($result)) {


			$porciones = explode(":", trim($fila["hora_acepto"]));
			$fd=str_pad($porciones[0], 2, "0", STR_PAD_LEFT);
			$fd1=str_pad($porciones[1], 2, "0", STR_PAD_LEFT);
			$fd2=str_pad($porciones[2], 2, "0", STR_PAD_LEFT);


				$data[] = array(
					'id'    => $fila["id"],
					'title' => $fila["nombre_completo"]."-".$fila["telefono"]." (".$fila["user"].")",
					'start' => $fila["fecha"]."T".$fd.":".$fd1.":".$fd2,
					'end'   => $fila["fecha"]."T".$fd.":59:".$fd2,
					"backgroundColor" => 'green'
					);

			}

				/*		$data[0]["title"]='All Day Event';
						$data[0]["start"]='2019-11-20';

						$data[1]["title"]='Long Event';
						$data[1]["start"]='2019-11-16';
						$data[1]["end"]='2019-11-19';

						$data[2]["id"]=999;
						$data[2]["title"]='Repeating Event';
						$data[2]["start"]='2019-11-23T16:00:00';
						$data[2]["end"]='2019-11-23T16:59:00';


						$data[3]["title"]='All Day Event';
						$data[3]["start"]='2019-11-04T10:30:00';
						$data[3]["end"]= '2019-11-04T12:30:00';

						$data[4]["title"]='All Day Event';
						$data[4]["start"]='2019-12-01';
						
						*/

						
			echo json_encode($data);

		break;
		
		
		
	
	}	

	
	include "QuitDB.php";


	?>
	