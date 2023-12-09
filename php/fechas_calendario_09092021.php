<?php
include "connect.php";


	switch ($_REQUEST["accion"])
	{
	
		case "detalle":
		    $otra_gestion = isset($_POST['otra_gestion'])?$_POST['otra_gestion']:0;
		    	$data=[];
		    if( $otra_gestion == 0 ){
    		    $query = "SELECT dc.codigo,dc.nombre_completo,dc.direccion,dc.Datos_factura,dc.telefono,dc.telefono_oficina,
    			dc.celular1,dc.celular2,di.user, ga.hora_acepto, STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y') AS fecha_acepto_formato, ga.fecha_acepto,ga.primaryk,ga.id_tipo_gestion,tg.descripcion AS gestion 
    			FROM Gestion_acepto AS ga JOIN tipos_gestion AS tg ON ga.id_tipo_gestion = tg.id
    			JOIN DatosClientes as dc on dc.codigo=ga.codigo_cliente 
    			join Clientes_gestionados as cg on cg.id_cliente=ga.codigo_cliente 
    			join DatosIngreso as di on di.id=cg.id_operador where ga.primaryk=".$_REQUEST["id"];
    
    
    			//$data="";
    		
    			$result = mysqli_query($enlace, $query);
    			while ($fila = mysqli_fetch_array($result)) {
                    
    				/*$data="Nombre: ".$fila["nombre_completo"]." (".$fila["codigo"].")<br>";
    				$data.="Direccion: ".$fila["direccion"]."<br>";
    				$data.="Datos Factura: ".$fila["Datos_factura"]."<br>";
    				$data.="Telefono Principal: ".$fila["telefono"]."<br>";
    				$data.="Telefono oficina: ".$fila["telefono_oficina"]."<br>";
    				$data.="Celular 1: ".$fila["celular1"]."<br>";
    				$data.="Celular 2: ".$fila["celular2"]."<br>";
    				$data.="Operador : ".$fila["user"]."<br>";
    				//2901221
    				$data.="<a href='Modulo_Usuario.php?c=".$fila["codigo"]."' target='_blank' class='btn btn-primary'>Ver</a>";
    				$data.="<a data-toggle='modal' data-target='#ModalEditar' href='#Modulo_Usuario.php?c=".$fila["codigo"]."' target='_blank' class='btn btn-primary'>Ver</a>";
    				*/
    				$data["id"]=$fila["primaryk"];
    				$data["fecha_acepto"]=$fila["fecha_acepto_formato"];
    				$data["fecha_anterior"]=$fila["fecha_acepto"];
    				
    				$data["hora_acepto"]=$fila["hora_acepto"];
    				
    				$data["nombre_completo"]=$fila["nombre_completo"];
    				$data["codigo"]=$fila["codigo"];
    				$data["direccion"]=$fila["direccion"];
    				$data["datos_factura"]=$fila["Datos_factura"];
    				$data["telf_principal"]=$fila["telefono"];
    				$data["telf_oficina"]=$fila["telefono_oficina"];
    				$data["celular1"]=$fila["celular1"];
    				$data["celular2"]=$fila["celular2"];
    				$data["operador"]=$fila["user"];
    				$data["user"]=$fila["user"];
    				$data["id_tipo_gestion"]=$fila["id_tipo_gestion"];
    				$data["gestion"]=$fila["gestion"];
    				
    				
    
    			}	
    
    			//comentado 29012021 $data1=str_replace('"',"",$data);
    			//comentado 29012021 echo json_encode($data);
                //echo $data;  
		    }
		    else{
		        $codigo = isset($_POST['codigo'])?$_POST['codigo']:0;
		    
		        //es importante
		      $query = "SELECT ll.id,ll.realizada,ll.hora_llamada,STR_TO_DATE(ll.fecha_llamada,'%d/%m/%Y') AS fecha_llamada ,dc.*
			 FROM `llamadasProgramadas` AS ll 
			 JOIN DatosClientes as dc on dc.codigo=ll.id_cliente 
			  where  ll.realizada = 0  
			  AND (dc.estado like '%Importante%' OR dc.estado like '%importante%' ) AND ll.id_cliente = '".$codigo."'";
            
		      /*$query = "SELECT dc.codigo,dc.nombre_completo,dc.direccion,dc.Datos_factura,dc.telefono,dc.telefono_oficina,
    			dc.celular1,dc.celular2,di.user, ga.hora, ga.fecha,ga.id
    			FROM otras_gestiones AS ga 
    			JOIN DatosClientes as dc on dc.codigo=ga.codigo_cliente 
    			join clientes_gestionados_otros as cg on cg.id_cliente=ga.codigo_cliente 
    			join DatosIngreso as di on di.id=cg.id_operador where ga.id=".$_REQUEST["id"];
                */
    
    			//$data="";
    		
    			$result = mysqli_query($enlace, $query);
    			if( $result ){
    			while ($fila = mysqli_fetch_array($result)) {
                    
    				
    				$data["id"]=$fila["id"];
    				$data["fecha_acepto"]=$fila["fecha_llamada"];
    				$data["hora_acepto"]=$fila["hora_llamada"];
    				
    				$data["nombre_completo"]=$fila["nombre_completo"];
    				$data["codigo"]=$fila["codigo"];
    				$data["direccion"]=$fila["direccion"];
    				$data["datos_factura"]=$fila["Datos_factura"];
    				$data["telf_principal"]=$fila["telefono"];
    				$data["telf_oficina"]=$fila["telefono_oficina"];
    				$data["celular1"]=$fila["celular1"];
    				$data["celular2"]=$fila["celular2"];
    				//$data["user"]=$fila["user"];
    				$data["otra_gestion"]=1;
    				//$data["operador"]=$fila["user"];
    
    			}	
    			}
    			else{
    			    echo $query.'<br>'.mysqli_error($enlace);
    			}
		    }
            echo json_encode($data);
		break;

		
		case "consultar":
	        //29012021 obtener el año más antiguo
	        $primer_anio = date('Y');
	        $arr_ids=[];
	        $query_primer_anio = "SELECT YEAR(STR_TO_DATE(fecha_acepto,'%d/%m/%Y'))  AS primer_anio FROM `Gestion_acepto` ORDER BY primaryk  limit 1";
	        $result_primer_anio = mysqli_query($enlace, $query_primer_anio);
			if($result_primer_anio){
                
                $fila = mysqli_fetch_array($result_primer_anio);
                
                $primer_anio = $fila['primer_anio'];
            }
            $colores = ["1"=>"green","2"=>"blue","3"=>"yellow","4"=>"#60cbd6"];
			
			/*comentado 29012021 $query = "SELECT ga.primaryk as id, dc.nombre_completo, dc.telefono, di.user, STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y') as fecha, ga.hora_acepto
			 FROM `Gestion_acepto` AS ga 
			 JOIN DatosClientes as dc on dc.codigo=ga.codigo_cliente 
			 join Clientes_gestionados as cg on cg.id_cliente=ga.codigo_cliente 
			 join DatosIngreso as di on di.id=cg.id_operador where YEAR(STR_TO_DATE(ga.fecha_acepto, '%d/%m/%Y'))=".date('Y');
            */
            $query = "SELECT ga.primaryk as id, dc.nombre_completo, dc.telefono, di.user, STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y') as fecha, ga.hora_acepto,
            ga.id_tipo_gestion,dc.estado  
			 FROM `Gestion_acepto` AS ga 
			 JOIN DatosClientes as dc on dc.codigo=ga.codigo_cliente 
			 join Clientes_gestionados as cg on cg.id_cliente=ga.codigo_cliente 
			 join DatosIngreso as di on di.id=cg.id_operador where YEAR(STR_TO_DATE(ga.fecha_acepto, '%d/%m/%Y'))>=".$primer_anio;
            
			$result = mysqli_query($enlace, $query);
			while ($fila = mysqli_fetch_array($result)) {

            $arr_ids[]=$fila["id"];
			$porciones = explode(":", trim($fila["hora_acepto"]));
			$fd=str_pad($porciones[0], 2, "0", STR_PAD_LEFT);
			$fd1=str_pad($porciones[1], 2, "0", STR_PAD_LEFT);
			$fd2=str_pad($porciones[2], 2, "0", STR_PAD_LEFT);
                $otra_gestion = 0;
                $color = $colores[1];
                switch($fila["id_tipo_gestion"]){
                    case 1: //aceptó
                    /*$pos = strpos(strtolower($fila['estado']), 'importante');
                    if( $pos !== false )
                    $color = $colores[4];
                    */
                    break;
                    
                    case 2: //Inspección
                        $color = $colores[$fila['id_tipo_gestion']];
                        $otra_gestion = 0;
                    break;
                    case 3: //cobros
                        $color = $colores[$fila['id_tipo_gestion']];
                         $otra_gestion=0;
                        break;
                }
        
				$data[] = array(
					'id'    => $fila["id"],
					'title' => $fila["nombre_completo"]."-".$fila["telefono"]." (".$fila["user"].")",
					'start' => $fila["fecha"]."T".$fd.":".$fd1.":".$fd2,
					'end'   => $fila["fecha"]."T".$fd.":59:".$fd2,
					"backgroundColor" => $color,
					'otra_gestion'   => $otra_gestion,
					'importante'=>0
					);

			}
			
			//Llamadas importantes 16082021
            //16082021 
            $query = "SELECT ll.id,ll.realizada,ll.hora_llamada,STR_TO_DATE(ll.fecha_llamada,'%d/%m/%Y') AS fecha_llamada ,dc.codigo,dc.estado,dc.telefono,dc.nombre_completo
			 FROM `llamadasProgramadas` AS ll 
			 JOIN DatosClientes as dc on dc.codigo=ll.id_cliente 
			  where YEAR(STR_TO_DATE(ll.fecha_llamada,'%d/%m/%Y'))>=".$primer_anio." AND ll.realizada = 0  AND (dc.estado like '%Importante%' OR dc.estado like '%importante%' )";
            //echo $script;exit();
			$result = mysqli_query($enlace, $query);
			if($result){
			while ($fila = mysqli_fetch_array($result)) {


			$porciones = explode(":", trim($fila["hora_llamada"]));
			$fd=str_pad($porciones[0], 2, "0", STR_PAD_LEFT);
			$fd1=str_pad($porciones[1], 2, "0", STR_PAD_LEFT);
			$fd2=str_pad($porciones[2], 2, "0", STR_PAD_LEFT);
            $randomNumber = rand(1,58197);
                if( in_array($fila["id"], $arr_ids )){
                    $fila["id"]+=$randomNumber;
                }
                $arr_ids[]=$fila["id"];
                $fecha_hora = $fila["fecha_llamada"]."T".$fd.":".$fd1.":".$fd2;
                $fecha_hora_start = $fila["fecha_llamada"]."T".$fd.":00:00";
                
				$data[] = array(
					'id'    => $fila["id"],
					'title' => $fila["nombre_completo"]."(".$fecha_hora.")".$fila["telefono"],
					'start' => $fecha_hora_start,
					'end'   => $fila["fecha_llamada"]."T".$fd.":59:".$fd2,
					'otra_gestion'   => 1,
					'codigo' => $fila["codigo"],
					"backgroundColor" => $colores[4],
					'importante'=>1
					);

			}
			}
			else{
			    echo $query;
			    echo mysqli_error($enlace);
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