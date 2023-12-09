<?php 
include("connect.php");
session_start();


// id: idC, cor: corC, nom: nomC, dat: datC, dir: dirC, tel: telC, telo: teloC, 
// cel1: cel1C, cel2: cel2C, mail: mailC, com: comC, ope

$id=$_POST['id'];
$idpre =$_POST['idpre'];
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

$provin = $_POST['provin'];
$canto = $_POST['canto'];
$parroq = $_POST['parroq'];



//formatear coordenada de google maps

$encontrar   = 'https://maps.google.com/?q=';
$pos = strpos($coorde, $encontrar);
if ($pos === false) {
    
} else {
    $coorde = substr($coorde, 27);
}





//27072021
$numerolibre = $_POST['numerolibre'];
$arr_coordenadas = explode(",",$coorde);
$lat = trim($arr_coordenadas[0]);
$lng = trim($arr_coordenadas[1]);


if($provin == '' && $canto == '' && $parroq == '')
{
    if($id == $idpre)
    {
        $script="UPDATE `DatosClientes` SET `coordenadas`='$coorde',`nombre_completo`='$nomb',`Datos_factura`='$factura',`direccion`='$direcc',`telefono`='$telP',`telefono_oficina`='$telO',`celular1`='$cel1',`celular2`='$cel2',`correo`='$corr',`comentarios`='$comen' ,`info_cisterna`='$infoC'
        ,`tipo_persona_tel_cliente`='$persona1'
        ,`obser_tel_cliente`='$obser1'
        ,`tipo_persona_tel_of`='$persona2'
        ,`obser_tel_of`='$obser2'
        ,`tipo_persona_cel1`='$persona3'
        ,`obser_cel1`='$obser3'
        ,`tipo_persona_cel2`='$persona4'
        ,`obser_cel2`='$obser4'
        ,`numero_libre`='$numerolibre'
        ,`lat`='$lat'
        ,`lng`='$lng'
        
         WHERE codigo='$id'";
    }
    else
    {
    
        $buscar = "SELECT * FROM `DatosClientes` WHERE codigo = '$id'";
        $ejecutar = mysqli_query($enlace,$buscar);
        $cant = mysqli_num_rows($ejecutar);
    
        if($cant == 0)
        {
            $script="UPDATE `DatosClientes` SET `coordenadas`='$coorde', `codigo`='$id',`nombre_completo`='$nomb',`Datos_factura`='$factura',`direccion`='$direcc',`telefono`='$telP',`telefono_oficina`='$telO',`celular1`='$cel1',`celular2`='$cel2',`correo`='$corr',`comentarios`='$comen' ,`info_cisterna`='$infoC'
            ,`tipo_persona_tel_cliente`='$persona1'
            ,`obser_tel_cliente`='$obser1'
            ,`tipo_persona_tel_of`='$persona2'
            ,`obser_tel_of`='$obser2'
            ,`tipo_persona_cel1`='$persona3'
            ,`obser_cel1`='$obser3'
            ,`tipo_persona_cel2`='$persona4'
            ,`obser_cel2`='$obser4'
            ,`numero_libre`='$numerolibre'
            ,`lat`='$lat'
            ,`lng`='$lng'
            
             WHERE codigo='$idpre'";
    
            $id_operador = $_SESSION['ide'];
            $actualizar = "UPDATE sol_edicion_id SET `status` = 2 WHERE id_cliente = '$idpre' AND id_operador = '$id_operador'";
            $actualizar_status = mysqli_query($enlace,$actualizar);
    
    
        }
        else
        {
            $script="UPDATE `DatosClientes` SET `coordenadas`='$coorde',`nombre_completo`='$nomb',`Datos_factura`='$factura',`direccion`='$direcc',`telefono`='$telP',`telefono_oficina`='$telO',`celular1`='$cel1',`celular2`='$cel2',`correo`='$corr',`comentarios`='$comen' ,`info_cisterna`='$infoC'
            ,`tipo_persona_tel_cliente`='$persona1'
            ,`obser_tel_cliente`='$obser1'
            ,`tipo_persona_tel_of`='$persona2'
            ,`obser_tel_of`='$obser2'
            ,`tipo_persona_cel1`='$persona3'
            ,`obser_cel1`='$obser3'
            ,`tipo_persona_cel2`='$persona4'
            ,`obser_cel2`='$obser4'
            ,`numero_libre`='$numerolibre'
            ,`lat`='$lat'
            ,`lng`='$lng'
            
             WHERE codigo='$id'";
        }
    }
    
}
else
{
    if($id == $idpre)
    {
        $script="UPDATE `DatosClientes` SET `coordenadas`='$coorde',`nombre_completo`='$nomb',`Datos_factura`='$factura',`direccion`='$direcc',`telefono`='$telP',`telefono_oficina`='$telO',`celular1`='$cel1',`celular2`='$cel2',`correo`='$corr',`comentarios`='$comen' ,`info_cisterna`='$infoC'
        ,`tipo_persona_tel_cliente`='$persona1'
        ,`obser_tel_cliente`='$obser1'
        ,`tipo_persona_tel_of`='$persona2'
        ,`obser_tel_of`='$obser2'
        ,`tipo_persona_cel1`='$persona3'
        ,`obser_cel1`='$obser3'
        ,`tipo_persona_cel2`='$persona4'
        ,`obser_cel2`='$obser4'
        ,`numero_libre`='$numerolibre'
        ,`lat`='$lat'
        ,`lng`='$lng'
        ,`provincia`='$provin'
        ,`canton`='$canto'
        ,`parroquia`='$parroq'
        
         WHERE codigo='$id'";
    }
    else
    {
    
        $buscar = "SELECT * FROM `DatosClientes` WHERE codigo = '$id'";
        $ejecutar = mysqli_query($enlace,$buscar);
        $cant = mysqli_num_rows($ejecutar);
    
        if($cant == 0)
        {
            $script="UPDATE `DatosClientes` SET `coordenadas`='$coorde', `codigo`='$id',`nombre_completo`='$nomb',`Datos_factura`='$factura',`direccion`='$direcc',`telefono`='$telP',`telefono_oficina`='$telO',`celular1`='$cel1',`celular2`='$cel2',`correo`='$corr',`comentarios`='$comen' ,`info_cisterna`='$infoC'
            ,`tipo_persona_tel_cliente`='$persona1'
            ,`obser_tel_cliente`='$obser1'
            ,`tipo_persona_tel_of`='$persona2'
            ,`obser_tel_of`='$obser2'
            ,`tipo_persona_cel1`='$persona3'
            ,`obser_cel1`='$obser3'
            ,`tipo_persona_cel2`='$persona4'
            ,`obser_cel2`='$obser4'
            ,`numero_libre`='$numerolibre'
            ,`lat`='$lat'
            ,`lng`='$lng'
            ,`provincia`='$provin'
            ,`canton`='$canto'
            ,`parroquia`='$parroq'
            
             WHERE codigo='$idpre'";
    
            $id_operador = $_SESSION['ide'];
            $actualizar = "UPDATE sol_edicion_id SET `status` = 2 WHERE id_cliente = '$idpre' AND id_operador = '$id_operador'";
            $actualizar_status = mysqli_query($enlace,$actualizar);
    
    
        }
        else
        {
            $script="UPDATE `DatosClientes` SET `coordenadas`='$coorde',`nombre_completo`='$nomb',`Datos_factura`='$factura',`direccion`='$direcc',`telefono`='$telP',`telefono_oficina`='$telO',`celular1`='$cel1',`celular2`='$cel2',`correo`='$corr',`comentarios`='$comen' ,`info_cisterna`='$infoC'
            ,`tipo_persona_tel_cliente`='$persona1'
            ,`obser_tel_cliente`='$obser1'
            ,`tipo_persona_tel_of`='$persona2'
            ,`obser_tel_of`='$obser2'
            ,`tipo_persona_cel1`='$persona3'
            ,`obser_cel1`='$obser3'
            ,`tipo_persona_cel2`='$persona4'
            ,`obser_cel2`='$obser4'
            ,`numero_libre`='$numerolibre'
            ,`lat`='$lat'
            ,`lng`='$lng'
            ,`provincia`='$provin'
            ,`canton`='$canto'
            ,`parroquia`='$parroq'
            
             WHERE codigo='$id'";
        }
    }
    
}







 $res = mysqli_query($enlace,$script);
 if($res)	echo $res;
 else
 echo mysqli_error($enlace);
 ?>