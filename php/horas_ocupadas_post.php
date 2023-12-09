<?php
                include 'connect.php';
                $conte= array();

                $identificador= $_POST['id'];

                date_default_timezone_set('Etc/GMT+5');


          /*      $query="SELECT * FROM llamadasProgramadas  
                inner join Clientes_gestionados as cg
                where 
                 cg.id_operador=$identificador 
                 AND realizada=0 AND
                 STR_TO_DATE(fecha_llamada, '%d/%m/%Y')='".$_REQUEST["fecha"]."'";
*/

$query = "SELECT lp.id_cliente,lp.fecha_llamada,lp.hora_llamada,dc.coordenadas,dc.nombre_completo, STR_TO_DATE(lp.fecha_llamada, '%d/%m/%Y') as fes
FROM llamadasProgramadas AS lp
inner join Clientes_gestionados as cg
inner join DatosClientes as dc
ON lp.id_cliente=cg.id_cliente
AND dc.codigo=lp.id_cliente
AND lp.realizada=0
AND STR_TO_DATE(lp.fecha_llamada, '%d/%m/%Y')='".$_REQUEST["fecha"]."'
AND cg.id_operador=$identificador";



                $result = mysqli_query($enlace, $query);
                $i=0;
                while ($fila = mysqli_fetch_array($result)) { 
                    
                    
                        $num=str_replace(":","",$fila["hora_llamada"]);
                      $conte[$i]["id"]="hora_".$num;



                      $i++;
                }



                $tabla="";
                $g = 0;
                while ($g < 60){                                 
                    
                    if(strlen($g)==1){
                        $fila="0".$g;
                    }                
                    else{
                        $fila=$g;
                    }                
                
                    
                    $tabla.="<tr>";   

                            $i = 5;
                            while ($i < 18){                                 
                            $i++;     
                            
                            
                                      if(strlen($i)==1){
                                          $colum="0".$i;
                                      }                
                                      else{
                                          $colum=$i;
                                      } 
                                      
                                      $funa="'".$colum.':'.$fila."'";   
                                      $mostrar=$i.":".$fila;
                                      $hora=date('H');
                                      $minutos=date('i');
                                      
                                      if(date('Y-m-d')==$_REQUEST["fecha"])
                                      {
                                        if($i<$hora){
                                          $tabla.='<td style="background-color:#9c9c9c;" title="FUERA DE HORA"  id="hora_'.$colum.$fila.'00">'.$mostrar.'<td>';
  
                                        }
                                        else if($i==$hora && $fila<$minutos){
                                            $tabla.='<td style="background-color:#9c9c9c;" title="FUERA DE HORA" id="hora_'.$colum.$fila.'00">'.$mostrar.'<td>';

                                        }
                                        else{

                                
                                            $tabla.='<td style="cursor:pointer" title="DISPONIBLE" onclick="hora_maracada_post('.$funa.')" id="hora_'.$colum.$fila.'00">'.$mostrar.'<td>';
                                            
                                        }
                                      }
                                      else{
                                        $tabla.='<td style="cursor:pointer" title="DISPONIBLE" onclick="hora_maracada_post('.$funa.')" id="hora_'.$colum.$fila.'00">'.$mostrar.'<td>';

                                      }
                                      
                          
                          }  

              
                          $tabla.="</tr>";   
             $g++;
            }  











           $retorna["dias"]=$conte;
           $retorna["tabla"]=$tabla;


                echo json_encode($retorna);
                include 'QuitDB.php';
                ?>