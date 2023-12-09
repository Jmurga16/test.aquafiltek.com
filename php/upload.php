<?php
include 'connect.php';
mysqli_set_charset($enlace,'utf8');


$tipo = $_FILES['lista'];
$tipo1 = $tipo['type']; 

if ($_FILES['lista']["error"] > 0)

  {

  echo "Error: " . $_FILES['lista']['error'] . "<br>";

  }

  elseif($tipo1 != "text/csv")
  {
	
	echo "<script>alert('El archivo enviado no corresponde al formato esperado, favor de corregir');</script>";
	echo "<script>window.location.replace('Modulo_Administrador.php');</script>";
	  
	 
  }
  
  else {
//obtenemos el archivo .csv
$tipo = $_FILES['lista']['type'];
$tamanio = $_FILES['lista']['size'];
$archivotmp = $_FILES['lista']['tmp_name'];

$nombre_arc = 'archivo_aleatorio';


//guardamos una ruta
$archivo = "listas/$nombre_arc.csv";
/*movemos nuestro archivo alojado en la carpeta temporal a la carpeta que queramos, en este caso se guardará la ruta y el nombre del archivo que deseemos ponerle */
move_uploaded_file($archivotmp, $archivo) ;
//cargamos el archivo
$lineas = file("listas/$nombre_arc.csv");
//inicializamos variable a 0, esto nos ayudará a indicarle que no lea la primera línea
$i = 0;
//Recorremos un bucle para leer línea por línea

foreach ($lineas as $linea_num => $linea)
//abrimos bucle
{
/*si es diferente a 0 significa que no se encuentra en la primera línea (con los títulos de las columnas) y por lo tanto puede leerla*/
if($i == 0)
{

}
else
{
  $datos = explode(";",$linea);
//Almacenamos los datos que vamos leyendo en una variable
$nombre = trim(utf8_encode($datos[0]));
$coordenadas = trim(utf8_encode($datos[1]));
$factura = trim(utf8_encode($datos[2]));
$direccion = trim(utf8_encode($datos[3]));
$tel_principal = trim(utf8_encode($datos[4]));
$tel_principal_trato = trim(utf8_encode($datos[5]));
$tel_principal_observacion = trim(utf8_encode($datos[6]));
$tel_oficina = trim(utf8_encode($datos[7]));
$tel_oficina_trato = trim(utf8_encode($datos[8]));
$tel_oficina_observacion = trim(utf8_encode($datos[9]));
$cel_principal = trim(utf8_encode($datos[10]));
$cel_principal_trato = trim(utf8_encode($datos[11]));
$cel_principal_observacion = trim(utf8_encode($datos[12]));
$email = trim(utf8_encode($datos[7]));
$comentario = trim(utf8_encode($datos[7]));
$info_cisterna = trim(utf8_encode($datos[7]));
$campo_libre = trim(utf8_encode($datos[7]));

$codigo = time();

mysqli_query($enlace,"INSERT INTO DatosClientes (codigo,coordenadas,nombre_completo,Datos_factura,direccion,telefono,telefono_oficina,celular1,celular2,correo,info_cisterna,comentarios,estado,tipo_persona_tel_cliente,obser_tel_cliente,tipo_persona_tel_of,obser_tel_of,tipo_persona_cel1,obser_cel1,numero_libre,actualizar_pendiente) VALUES ('$codigo','$coordenadas','$nombre','$factura','$direccion','$tel_principal','$tel_oficina','$cel_principal','','$email','$info_cisterna','','Por gestionar','$tel_principal_trato','$tel_principal_observacion','$tel_oficina_trato','$tel_oficina_observacion','$cel_principal_trato','$cel_principal_observacion','$comentario',1)");
	

}

//cerramos bucle
	
$i++;
}



header("Location: https://test.aquafiltek.com/php/Modulo_Administrador.php");
die();

  }
?>


