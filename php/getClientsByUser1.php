<?php

date_default_timezone_set('Etc/GMT+5');

$hora=date('H');
$minutos=date('i');
$i=$_REQUEST["hora"];
$fila=$_REQUEST["minuto"];


if(date('Y-m-d')==$_REQUEST["fecha"])
    {
        if($i<$hora){
        $estado="false";

        }
        else if($i==$hora && $fila<$minutos){
            $estado="false";

        }
        else{

            $estado="true";
            
        }
    }
    else{
        $estado="true";

    }
    if(date('Y-m-d')>$_REQUEST["fecha"])
{
    $estado="false";
}

echo $estado;
