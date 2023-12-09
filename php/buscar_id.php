<?php
include "connect.php";
 
error_reporting(0);

                $conte= array();
                $busqueda=trim($_REQUEST["q"]);
            
                $result = mysqli_query($enlace, "select codigo,nombre_completo FROM DatosClientes  where codigo LIKE '%".$busqueda."%'");
                $i=0;
                while ($fila = mysqli_fetch_array($result)) {    
                      $str_nombre = mb_convert_encoding($fila['nombre_completo'], 'UTF-8', 'UTF-8'); 
                      
                      
                      if( strlen($str_nombre) > 30 ){
                          $str_nombre = mb_substr($str_nombre,0,30).'..';
                      }
                
                      $conte[$i]["id"]=$fila["codigo"];
                      $conte[$i]["text"]=$fila["codigo"].' - '.$str_nombre; 
                      $i++;
                }
                echo json_encode($conte);
                include 'QuitDB.php';
?>
