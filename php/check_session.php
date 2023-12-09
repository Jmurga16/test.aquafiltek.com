<?php
session_start();
if(!isset($_SESSION['ide']) || $_SESSION['ide'] == NULL){
    header('Location:../index.html');
   // exit();
}
$id_sesion = $_SESSION['ide'];

