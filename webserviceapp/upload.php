<?php

//error_reporting(0);
header('content-type: application/json; charset=utf-8');
//en caso de json en vez de jsonp habría que habilitar CORS:
header("access-control-allow-origin: *");


function miniatura($archivo, $local, $ancho, $alto){    
    $arrNombre = explode(".", $local);
    $nombre = $arrNombre[0];
    $extension = $arrNombre[1];
    
    if($extension=="jpg" || $extension=="jpeg") $nuevo = imagecreatefromjpeg($archivo);
    if($extension=="png") $nuevo = imagecreatefrompng($archivo);
    if($extension=="gif") $nuevo = imagecreatefromgif($archivo);
    $thumb = imagecreatetruecolor($ancho, $alto); // Lo haremos de un tamaño 100x100
    $ancho_original = imagesx($nuevo);
    $alto_original = imagesy($nuevo);
    imagecopyresampled($thumb,$nuevo,0,0,0,0,$ancho,$alto,$ancho_original,$alto_original);
    $thumb_name = "protegidos/thumb_$nombre.$extension";
    if($extension=="jpg" || $extension=="jpeg") imagejpeg($thumb, $thumb_name,90); // 90 es la calidad de compresión
    if($extension=="png") imagepng($thumb, $thumb_name);
    if($extension=="gif") imagegif($thumb, $thumb_name);
}

$target_dir = "protegidos/";
$target_file = $target_dir . basename($_FILES["imagen"]["name"]);
move_uploaded_file($_FILES["imagen"]["tmp_name"], "./protegidos/" . $_FILES["imagen"]["name"]);


miniatura("protegidos/" . $_FILES["imagen"]["name"], $_FILES["imagen"]["name"], 80, 80);



echo "/" . $target_file;

?>