<?php
                include 'connect.php';

      


                $query = "SELECT ga.primaryk as id, dc.nombre_completo, dc.telefono, di.user, STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y') as fecha, ga.hora_acepto,
                ga.id_tipo_gestion 
                FROM `Gestion_acepto` AS ga 
                JOIN DatosClientes as dc on dc.codigo=ga.codigo_cliente 
                join Clientes_gestionados as cg on cg.id_cliente=ga.codigo_cliente 
                join DatosIngreso as di on di.id=cg.id_operador where (STR_TO_DATE(ga.fecha_acepto, '%d/%m/%Y'))='".$_REQUEST["fecha"]."' ORDER BY STR_TO_DATE(ga.hora_acepto, '%H:%i:%s')";
        //14082021
        $id_tipo_gestion = isset($_POST['tipo_gestion'])?(int)$_POST['tipo_gestion']:1;
         


         $tabla="<ul>";

               $result = mysqli_query($enlace, $query);
                while ($fila = mysqli_fetch_array($result)) {
         
             
                   $porciones = explode(":", trim($fila["hora_acepto"]));
                   $fd=str_pad($porciones[0], 2, "0", STR_PAD_LEFT);
                   $fd1=str_pad($porciones[1], 2, "0", STR_PAD_LEFT);
                   $fd2=str_pad($porciones[2], 2, "0", STR_PAD_LEFT);
             
                    //$newDate = strtotime ( '+15 minutes' , strtotime ($iniucio) ) ; 
                           
                   $tabla.="<li>";
    
                   $iniucio=$fd.":".$fd1.":".$fd2;
                   $str_diff='1 hour';
                   if( $fila["id_tipo_gestion"] != 1 ){
                        $str_diff='15 minutes';
                   }
                   $newDate = strtotime ( '+'.$str_diff , strtotime ($iniucio) ) ; 
                   $NuevaFecha = date ( 'H:i:s' , $newDate); 
                   $tabla.=$iniucio." hasta ".$NuevaFecha;                
    
                       $tabla.="</li>";
               }       
                  
               $tabla.="</ul>";

               $resul["datos"]=$tabla;

                echo json_encode($resul);
                include 'QuitDB.php';
                ?>