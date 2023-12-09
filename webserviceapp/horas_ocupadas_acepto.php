<?php
                include 'connect.php';

      


                $query = "SELECT ga.primaryk as id, dc.nombre_completo, dc.telefono, di.user, STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y') as fecha, ga.hora_acepto
                FROM `Gestion_acepto` AS ga 
                JOIN DatosClientes as dc on dc.codigo=ga.codigo_cliente 
                join Clientes_gestionados as cg on cg.id_cliente=ga.codigo_cliente 
                join DatosIngreso as di on di.id=cg.id_operador where (STR_TO_DATE(ga.fecha_acepto, '%d/%m/%Y'))='".$_REQUEST["fecha"]."'";
         


         $tabla="<ul>";

               $result = mysqli_query($enlace, $query);
               while ($fila = mysqli_fetch_array($result)) {
         
         
               $porciones = explode(":", trim($fila["hora_acepto"]));
               $fd=str_pad($porciones[0], 2, "0", STR_PAD_LEFT);
               $fd1=str_pad($porciones[1], 2, "0", STR_PAD_LEFT);
               $fd2=str_pad($porciones[2], 2, "0", STR_PAD_LEFT);
         
         
               $tabla.="<li>";

               $iniucio=$fd.":".$fd1.":".$fd2;
               $newDate = strtotime ( '+1 hour' , strtotime ($iniucio) ) ; 
               $NuevaFecha = date ( 'H:i:s' , $newDate); 
               $tabla.=$iniucio." hasta ".$NuevaFecha;                

                   $tabla.="</li>";
               }       

               $tabla.="</ul>";

               $resul["datos"]=$tabla;

                echo json_encode($resul);
                include 'QuitDB.php';
                ?>