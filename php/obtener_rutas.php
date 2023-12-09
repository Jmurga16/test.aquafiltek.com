<?php 
include("connect.php");

$id=$_POST['id'];

$cl = $_POST['cliente'];


$script="SELECT * FROM `operador_x_ruta` as r
left join DatosIngreso as d on r.id=d.id
WHERE `ruta` LIKE '%$cl%'";
$resultado=mysqli_query($enlace,$script);
$conte=array();
$i=0;
while ($fila = mysqli_fetch_array($resultado)) {                        
      $conte[$i]["ruta"]=$fila["ruta"];
      $conte[$i]["name"]=$fila['user']; 
      $conte[$i]["fecha"]=$fila['fecha']; 

      $i++;
}
echo json_encode($conte);



include("QuitDB.php");
 ?>