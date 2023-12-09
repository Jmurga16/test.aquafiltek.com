<?php
include "connect.php";
 
error_reporting(0);

                $conte= array();
                $busqueda=trim($_REQUEST["q"]);
            
                $result = mysqli_query($enlace, "select DISTINCT codigo,nombre_completo,Datos_factura FROM DatosClientes  where Datos_factura LIKE '%".$busqueda."%' 
                AND nombre_completo NOT LIKE '%REPETIDO%' order by Datos_factura asc");
                $i=0;
                while ($fila = mysqli_fetch_array($result)) {    
                      $str_nombre = mb_convert_encoding($fila['nombre_completo'], 'UTF-8', 'UTF-8'); 
                      $str_datos_factura = mb_convert_encoding($fila['Datos_factura'], 'UTF-8', 'UTF-8'); 
                      
                      if( strlen($str_nombre) > 30 ){
                          $str_nombre = mb_substr($str_nombre,0,30).'..';
                      }
                      if( strlen($str_datos_factura) > 30 ){
                          $str_datos_factura = mb_substr($str_datos_factura,0,30).'..';
                      }
                      $conte[$i]["id"]=$fila["codigo"];
                      $conte[$i]["text"]=$str_nombre.' '.$str_datos_factura; 
                      $i++;
                }
                echo json_encode($conte);
                include 'QuitDB.php';
?>
