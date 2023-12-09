<?php
include("connect.php");
$idcb=str_replace(' ', '', $_POST['if']);
$total="";

$script="SELECT * FROM `DatosClientes` WHERE codigo='$idcb'";
//echo "'$idcb'";


$resultado=mysqli_query($enlace, $script);
$fila = mysqli_fetch_array($resultado);


//agregar fechas de ventas anteriores para la tabla modal en recordatorios MG
$sql_fechas = "SELECT fecha_acepto, id_tipo_gestion from Gestion_acepto where codigo_cliente = '$idcb' ORDER BY  STR_TO_DATE(fecha_acepto, '%d/%m/%Y') DESC limit 5 ";
    $resultado_fechas = mysqli_query($enlace, $sql_fechas);
    $arr_fechas = '';
    if($resultado_fechas){
        $i = 1;
        while($fila_fecha = mysqli_fetch_array($resultado_fechas)){
            if($i == 1)
            {
                $arr_fechas .= $fila_fecha['fecha_acepto'].'-'.$fila_fecha['id_tipo_gestion'];
            }
            else
            {
                $arr_fechas .= ','.$fila_fecha['fecha_acepto'].'-'.$fila_fecha['id_tipo_gestion'];
            }
            $i++;
        }
    }

//buscar comentarios nuevos

$n_coment = "SELECT * FROM `comentarios` WHERE id_cliente = '$idcb' ORDER BY id DESC";

$ejecutar = mysqli_query($enlace, $n_coment);
$data_com = '';

while($n = mysqli_fetch_array($ejecutar))
{
    $buscar = mysqli_query($enlace, "SELECT user FROM DatosIngreso WHERE id = '$n[id_operador]'");
    $b1 = mysqli_fetch_array($buscar);
  $data_com .= "$n[fecha] - $n[hora] - $n[estado] $n[comentario] - $n[fecha_gestion] $n[hora_gestion] - $b1[user]";
  $data_com .= "\n";

}


$full_coment = $data_com;

$full_coment .= $fila[11];

$nuevos_coment = "SELECT * FROM comentarios WHERE comentarios.id_cliente = '".$fila['codigo']."' ORDER BY id DESC";
	$necs = [];
	$resultnc = mysqli_query($enlace,$nuevos_coment);
	if($resultnc)
	{
		while($filacoment = mysqli_fetch_array($resultnc))
		{
			if($filacoment['id_operador'] != '')
			{
				$opid = $filacoment['id_operador'];
				$nombre_operador = mysqli_query($enlace,"SELECT * FROM DatosIngreso WHERE id = '$opid'");
				$nop = mysqli_fetch_array($nombre_operador);
				$necs[]=$filacoment['comentario'].'*'.$filacoment['fecha'].'*'.$filacoment['hora'].'*'.$filacoment['estado'].'*'.$filacoment['fecha_gestion'].'*'.$filacoment['hora_gestion'].'*'.$nop['user'];
			}
			else
			{
				$necs[]=$filacoment['comentario'].'*'.$filacoment['fecha'].'*'.$filacoment['hora'].'*'.$filacoment['estado'].'*'.$filacoment['fecha_gestion'].'*'.$filacoment['hora_gestion'].'*'.$filacoment['id_operador'];
			}
			
		}

		
	}
	else
	{
		
	}

	$newc = implode('~',$necs);


	$remover = array("-", " ", "/");

	$nf5 = str_replace($remover, "",$fila[5]);
	$nf6 = str_replace($remover, "",$fila[6]);
	$nf7 = str_replace($remover, "",$fila[7]);
	$nf8 = str_replace($remover, "",$fila[8]);
   
$total=$fila[1]."|".$fila[2]."|".$fila[3]."|".$fila[4]."|".$nf5."|".$nf6."|".$nf7."|".$nf8."|".$fila[9]."|".$newc."|".$fila[12]."|".$fila[10]."|".$fila['info_cisterna']."|".$fila[17]."|".$fila[18]."|".$fila[19]."|".$fila[20]."|".$fila[21]."|".$fila[22]."|".$fila[23]."|".$fila[24]."|".$fila['numero_libre']."|".$arr_fechas."|".$fila['comentarios'];

echo $total;
?>
