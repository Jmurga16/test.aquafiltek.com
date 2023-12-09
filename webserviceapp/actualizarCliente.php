<?php 
include("connect.php");


// id: idC, cor: corC, nom: nomC, dat: datC, dir: dirC, tel: telC, telo: teloC, 
// cel1: cel1C, cel2: cel2C, mail: mailC, com: comC, ope

$id=$_POST['id'];
$coorde=$_POST['cor'];
$nomb=$_POST['nom'];
$factura=$_POST['dat'];
$direcc=$_POST['dir'];
$telP=$_POST['tel'];
$telO=$_POST['telo'];
$cel1=$_POST['cel1'];
$cel2=$_POST['cel2'];
$corr=$_POST['mail'];
$comen=$_POST['com'];
$opera=$_POST['ope'];
$infoC=$_POST['ic'];

$obser1 = $_POST['obser1'];
$obser2 = $_POST['obser2'];
$obser3 = $_POST['obser3'];
$obser4 = $_POST['obser4'];
$persona1 = $_POST['persona1'];
$persona2 = $_POST['persona2'];
$persona3 = $_POST['persona3'];
$persona4 = $_POST['persona4'];


$script="UPDATE `DatosClientes` SET `coordenadas`='$coorde',`nombre_completo`='$nomb',`Datos_factura`='$factura',`direccion`='$direcc',`telefono`='$telP',`telefono_oficina`='$telO',`celular1`='$cel1',`celular2`='$cel2',`correo`='$corr',`comentarios`='$comen' ,`info_cisterna`='$infoC'
,`tipo_persona_tel_cliente`='$persona1'
,`obser_tel_cliente`='$obser1'
,`tipo_persona_tel_of`='$persona2'
,`obser_tel_of`='$obser2'
,`tipo_persona_cel1`='$persona3'
,`obser_cel1`='$obser3'
,`tipo_persona_cel2`='$persona4'
,`obser_cel2`='$obser4'
 WHERE codigo='$id'";
	echo mysqli_query($enlace,$script);
 ?>