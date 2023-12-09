<?php
include "connect.php";
 
error_reporting(E_ALL);

                $conte= array();
                $busqueda=trim($_REQUEST["q"]);
            
                $result = mysqli_query($enlace, "select DISTINCT  codigo,nombre_completo,direccion FROM DatosClientes  where direccion LIKE '%".$busqueda."%' 
                AND nombre_completo NOT LIKE '%REPETIDO%' order by nombre_completo asc");
                $i=0;
                if($result){
                
                    while ($fila = mysqli_fetch_array($result)) {  
                        
                        //$str_nombre = mb_convert_encoding($fila['nombre_completo'], 'UTF-8', 'UTF-8');
                        //$str_direccion = mb_convert_encoding($fila['direccion'], 'UTF-8', 'UTF-8');
                        //$str_nombre = mb_convert_encoding($fila['nombre_completo'], 'UTF-8', 'latin-1');
                        //$str_direccion = mb_convert_encoding($fila['direccion'], 'UTF-8', 'latin-1');
                        //$ss=mb_detect_encoding($fila['nombre_completo']);
                        //$str_nombre = utf8_encode($fila['nombre_completo']);
                        //$str_direccion = utf8_encode($fila['direccion']);
                        $str_nombre = ($fila['nombre_completo']);
                        $str_direccion = ($fila['direccion']);
                            
                            if( strlen($str_nombre) > 30 ){
                              $str_nombre = mb_substr($str_nombre,0,30).'..';
                          }
                          if( strlen($str_direccion) > 30 ){
                              $str_direccion = mb_substr($str_direccion,0,30).'..';
                          }
                          //var_dump($str_nombre);var_dump($str_direccion);break;  
                          
                          $conte[$i]["id"]=$fila["codigo"];
                          $conte[$i]["text"]=$str_nombre.' '.$str_direccion; 
                          //var_dump($conte[$i]);break;
                          $i++;
                    }
                }
                else{
                    $conte[0]=mysqli_error($enlace);
                }
                //var_dump($conte);exit;
                echo json_encode($conte,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);// JSON_PRETTY_PRINT JSON_UNESCAPED_SLASHES
                include 'QuitDB.php';
?>