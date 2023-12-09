<?php
                include 'connect.php';
                $conte= array();
                $palabras=explode(" ",$_REQUEST["q"]);
                $sql="";
                foreach ($palabras as $key => $valor) { 
                            if($key>0){
                                $sql.=" and (nombre_completo LIKE '%".$valor."%' or '".$valor."%' or '%".$valor."') ";

                            }else{
                                $sql.=" ( nombre_completo LIKE '%".$valor."%' or '".$valor."%' or '%".$valor."') ";
                            }
                }
                $result = mysqli_query($enlace, "select * FROM DatosClientes  where ".$sql." order by nombre_completo asc");
                $i=0;
                while ($fila = mysqli_fetch_array($result)) {                        
                      $conte[$i]["id"]=$fila["codigo"];
                      $conte[$i]["text"]=$fila['nombre_completo']; 
                      $i++;
                }
                echo json_encode($conte);
                include 'QuitDB.php';
                ?>