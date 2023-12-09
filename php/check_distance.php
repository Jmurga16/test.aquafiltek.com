<?php
include "connect.php";

$coordenadas = $_POST['coordenadas'];
$nc = explode(",",$coordenadas);
$lat = trim($nc[0]);
$long = trim($nc[1]);
function distance($lat1, $lon1, $lat2, $lon2, $unit) {
 
	$theta = $lon1 - $lon2;
	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	$miles = $dist * 60 * 1.1515;
	$unit = strtoupper($unit);
   
	if ($unit == "K") {
	  return ($miles * 1.609344);
	} else if ($unit == "N") {
		return ($miles * 0.8684);
	  } else {
		  return $miles;
		}
  }

$hoy = date('Y-m-d');

$sql = "SELECT primaryk,fecha_acepto, hora_acepto, lat, lng FROM `Gestion_acepto` LEFT JOIN DatosClientes on Gestion_acepto.codigo_cliente = DatosClientes.codigo WHERE id_tipo_gestion != 4 AND STR_TO_DATE(fecha_acepto, '%d/%m/%Y') > '".$hoy."' AND codigo_cliente not like '%NOGESTIONAR%' AND lat is not null  ORDER BY fecha_acepto";
$ejecutar = mysqli_query($enlace,$sql);
$cant = mysqli_num_rows($ejecutar);
$datap = array();
$horap = array();
$posibles = 0;
while($res = mysqli_fetch_array($ejecutar))
{

$punto1 = [$lat,$long];
$punto2 = [$res['lat'],$res['lng']];

//para kilómetros
$dista = distance($punto1[0], $punto1[1], $punto2[0], $punto2[1], "K");

if($dista < 2.1)
{
	$posibles++;
	array_push($datap,$res['fecha_acepto']);
	array_push($horap,$res['hora_acepto']);
}
}

$horas_disp = '';

if($posibles > 0)
{
	$hora = $horap[0];

	$timestamp = strtotime($hora) + 60*60;
	
	$time = date('H:i:s', $timestamp);

	$hora_ref = strtotime("17:00:00");
  	$time_ver = date('H:i:s',$hora_ref);

	$verif = mysqli_query($enlace,"SELECT * FROM Gestion_acepto WHERE fecha_acepto = '".$datap[0]."' AND hora_acepto = '".$time."'");

	
	if(mysqli_num_rows($verif) > 0 || $time > $time_ver)
	{
		$timestamp = strtotime($hora) + 120*60;
	
		$time = date('H:i:s', $timestamp);
		$hora_ref = strtotime("17:00:00");
  	$time_ver = date('H:i:s',$hora_ref);

		$verif = mysqli_query($enlace,"SELECT * FROM Gestion_acepto WHERE fecha_acepto = '".$datap[0]."' AND hora_acepto = '".$time."'");
		if(mysqli_num_rows($verif) > 0 || $time > $time_ver)
		{
			$hora = $horap[1];

			$timestamp = strtotime($hora) + 60*60;
			
			$time = date('H:i:s', $timestamp);

			$hora_ref = strtotime("17:00:00");
  			$time_ver = date('H:i:s',$hora_ref);
		
			$verif = mysqli_query($enlace,"SELECT * FROM Gestion_acepto WHERE fecha_acepto = '".$datap[1]."' AND hora_acepto = '".$time."'");
			if(mysqli_num_rows($verif) > 0 || $time > $time_ver)
			{
				$horas_disp = "ninguno";
			}
			else
			{
				$horas_disp .= "".$datap[1]." - ".$time." <br>";
			}

			
		}
		else
		{
			$horas_disp .= "".$datap[0]." - ".$time." <br>";
		}







		
	}
	else
	{
		$horas_disp .= "".$datap[0]." - ".$time." <br>";
	}
	
}
else
{
	$horas_disp .= "Ningun cliente cercano encontrado<br>";
}

//buscar libres pronto
$hoya = strtotime($hoy);
$hora1 = date('H:i:s',strtotime('+9 hour', $hoya));
$next_day = date('Y-m-d', strtotime('+1 day', $hoya));

$horas_disp .= '<br><strong><small>Horarios próximos disponibles:</small></strong>';

$nuevos = mysqli_query($enlace,"SELECT * FROM Gestion_acepto WHERE fecha_acepto = '".$next_day."' AND hora_acepto = '".$hora1."'");
if(mysqli_num_rows($nuevos) == 0)
{
	$horas_disp .= "<br> $next_day $hora1";
}

	$hora1 = strtotime($hora1);
	$hora1 = date('H:i:s',strtotime('+1 hour', $hora1));
	$nuevos = mysqli_query($enlace,"SELECT * FROM Gestion_acepto WHERE fecha_acepto = '".$next_day."' AND hora_acepto = '".$hora1."'");
	if(mysqli_num_rows($nuevos) == 0)
	{
	$horas_disp .= "<br> $next_day $hora1";
	}
	
	
		$hora1 = strtotime($hora1);
		$hora1 = date('H:i:s',strtotime('+1 hour', $hora1));
	$nuevos = mysqli_query($enlace,"SELECT * FROM Gestion_acepto WHERE fecha_acepto = '".$next_day."' AND hora_acepto = '".$hora1."'");
	if(mysqli_num_rows($nuevos) == 0)
	{
	$horas_disp .= "<br> $next_day $hora1";
	}
	else
	{
		$hora1 = strtotime($hora1);
		$hora1 = date('H:i:s',strtotime('+1 hour', $hora1));
	$nuevos = mysqli_query($enlace,"SELECT * FROM Gestion_acepto WHERE fecha_acepto = '".$next_day."' AND hora_acepto = '".$hora1."'");
	if(mysqli_num_rows($nuevos) == 0)
	{
	$horas_disp .= "<br> $next_day $hora1";
	}
	}
	


//$horas_disp .= "<br> $next_day + $hora1";







echo $horas_disp;


include "QuitDB.php";
?>