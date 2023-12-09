<?php
include "connect.php";

// id: idC, cor: corC, nom: nomC, dat: datC, dir: dirC, tel: telC, telo: teloC,
// cel1: cel1C, cel2: cel2C, mail: mailC, com: comC, ope

$id = $_POST['id'];
$coorde = $_POST['cor'];
$nomb = $_POST['nom'];
$factura = $_POST['dat'];
$direcc = $_POST['dir'];
$telP = $_POST['tel'];
$telO = $_POST['telo'];
$cel1 = $_POST['cel1'];
$cel2 = $_POST['cel2'];
$corr = $_POST['mail'];
$comen = $_POST['com'];
$opera = $_POST['ope'];
$estacis = $_POST['isis'];

$obser1 = $_POST['obser1'];
$obser2 = $_POST['obser2'];
$obser3 = $_POST['obser3'];
$obser4 = $_POST['obser4'];
$persona1 = $_POST['persona1'];
$persona2 = $_POST['persona2'];
$persona3 = $_POST['persona3'];
$persona4 = $_POST['persona4'];
//27072021
$numerolibre = $_POST['numerolibre'];
$arr_coordenadas = explode(",",$coorde);
$lat = trim($arr_coordenadas[0]);
$lng = trim($arr_coordenadas[1]);


$script = "INSERT INTO `DatosClientes`(`codigo`, `coordenadas`, `nombre_completo`, `Datos_factura`, `direccion`, `telefono`, `telefono_oficina`,
`celular1`, `celular2`, `correo`, `comentarios`,`info_cisterna`,`tipo_persona_tel_cliente`,`obser_tel_cliente`,`tipo_persona_tel_of`,`obser_tel_of`,`tipo_persona_cel1`,
`obser_cel1`,`tipo_persona_cel2`,`obser_cel2`,`numero_libre`,`lat`,`lng`) VALUES ('$id','$coorde','$nomb','$factura','$direcc','$telP','$telO','$cel1','$cel2','$corr','$comen','$estacis','$persona1',
'$obser1','$persona2','$obser2','$persona3','$obser3','$persona4','$obser4', '$numerolibre','$lat','$lng')";
if (mysqli_query($enlace, $script)) {
    echo 1;
} else {
    echo -1;
    echo " " . $enlace->error;
}
