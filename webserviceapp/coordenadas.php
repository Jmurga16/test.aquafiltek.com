<?php
error_reporting(0);
header('content-type: application/json; charset=utf-8');
//en caso de json en vez de jsonp habría que habilitar CORS:
header("access-control-allow-origin: *");

    include 'connect.php';




	$_POST = json_decode(file_get_contents('php://input'), true);


	

    $coordew=$_POST["latitud"].";".$_POST["longitud"];
		
			$query3 = " INSERT INTO   tbl_historial_posiciones  (coordenadas,fecha_coorde,hora_coorde,id_tecnico)
			VALUES ('".$coordew."','".date('Y-m-d')."','".date('H:i:s')."','".$_POST["id_tecnico"]."')";
	
	
	
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

	
	?>
	