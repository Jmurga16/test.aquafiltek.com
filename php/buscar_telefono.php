<?php
include("connect.php");

error_reporting(0);

                $conte= array();
                $busqueda=trim($_REQUEST["q"]);
            
                $result = mysqli_query($enlace, "select DISTINCT codigo,nombre_completo,telefono,telefono_oficina,
                celular1, celular2 FROM DatosClientes  where (telefono LIKE '%".$busqueda."%' OR telefono_oficina
                LIKE '%".$busqueda."%' OR celular1 LIKE '%".$busqueda."%' OR celular2 LIKE '%".$busqueda."%') AND 
                nombre_completo NOT LIKE '%REPETIDO%' order by nombre_completo asc");
                $i=0;
                while ($fila = mysqli_fetch_array($result)) {    
                      $str_nombre = mb_convert_encoding($fila['nombre_completo'], 'UTF-8', 'UTF-8');
                      $telefono = $fila['telefono'];
                      $telefono_oficina = $fila['telefono_oficina'];
                      $celular1 = $fila['celular1'];
                      $celular2 = $fila['celular2'];
                      $str_telefono = '';
                      
                      if( strlen($str_nombre) > 30 ){
                          $str_nombre = mb_substr($str_nombre,0,30).'..';
                      }
                      if(strpos($telefono, $busqueda) !== FALSE){
                          $str_telefono = $telefono;
                      }
                      else if(strpos($telefono_oficina, $busqueda) !== FALSE ){
                          $str_telefono = $telefono_oficina;
                      }
                      else if(strpos($celular1, $busqueda) !== FALSE ){
                          $str_telefono = $celular1;
                      }
                      if(strpos($celular2, $busqueda) !== FALSE ){
                          $str_telefono = $celular2;
                      }
                      $conte[$i]["id"]=$fila["codigo"];
                      $conte[$i]["text"]=$str_nombre.' '.$str_telefono; 
                      $i++;
                }
                echo json_encode($conte,JSON_UNESCAPED_SLASHES);
                include 'QuitDB.php';
?>