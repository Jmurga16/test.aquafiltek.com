<?php
                include 'connect.php';

      


                $query = "SELECT ot.id, dc.nombre_completo, dc.telefono, di.user, ot.fecha, ot.hora
                FROM `ostras_gestiones` AS ot 
                JOIN DatosClientes as dc on dc.codigo=ot.codigo_cliente 
                join clientes_gestionados_otros as cg on cg.id_cliente=ot.codigo_cliente 
                ot.fecha ='".$_REQUEST["fecha"]."'";
         
         /*       join DatosIngreso as di on di.id=cg.id_operador where (STR_TO_DATE(ga.fecha_acepto, '%d/%m/%Y'))='".$_REQUEST["fecha"]."'";
         */


         $tabla="<ul>";

               $result = mysqli_query($enlace, $query);
               while ($fila = mysqli_fetch_array($result)) {
         
         
              /* $porciones = explode(":", trim($fila["hora"]));
               $fd=str_pad($porciones[0], 2, "0", STR_PAD_LEFT);
               $fd1=str_pad($porciones[1], 2, "0", STR_PAD_LEFT);
               $fd2=str_pad($porciones[2], 2, "0", STR_PAD_LEFT);
            */   
         
               $tabla.="<li>";

               $iniucio=$fila['hora'];//$fd.":".$fd1.":".$fd2;
               $newDate = strtotime ( '+15 minutes' , strtotime ($iniucio) ) ; 
               $NuevaFecha = date ( 'H:i:s' , $newDate); 
               $tabla.=$iniucio." hasta ".$NuevaFecha;                

                   $tabla.="</li>";
               }       

               $tabla.="</ul>";

               $resul["datos"]=$tabla;

                echo json_encode($resul);
                include 'QuitDB.php';
                ?>