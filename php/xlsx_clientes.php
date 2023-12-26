<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method"); //
header("Access-Control-Allow-Methods: GET, POST"); // Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE
header("Allow: GET, POST"); // Allow: GET, POST, OPTIONS, PUT, DELETE

include 'SimpleXLSX.php';
include 'connect.php';


if ($xlsx = SimpleXLSX::parse($_FILES['lista']['tmp_name'])) {

    header('Content-Type: application/json');

    $Json = [];
    $x = 0;

    foreach ($xlsx->rows() as $datos) {

        if ($x == 0) {
        } else {
            $nombre = trim($datos[0]);
            $coordenadas = trim($datos[1]);
            $factura = trim($datos[2]);
            $direccion = trim($datos[3]);
            $tel_principal = trim($datos[4]);
            $tel_principal_trato = trim($datos[5]);
            $tel_principal_observacion = trim($datos[6]);
            $tel_oficina = trim($datos[7]);
            $tel_oficina_trato = trim($datos[8]);
            $tel_oficina_observacion = trim($datos[9]);
            $cel_principal = trim($datos[10]);
            $cel_principal_trato = trim($datos[11]);
            $cel_principal_observacion = trim($datos[12]);
            $cel_segundo = trim($datos[13]);
            $cel_segundo_trato = trim($datos[14]);
            $cel_segundo_observacion = trim($datos[15]);
            $email = trim($datos[16]);
            $comentario = trim($datos[17]);
            $info_cisterna = trim($datos[18]);
            $campo_libre = trim($datos[19]);

            $hoy = date('d-m-Y');

            $codigo = time();

            $fecha_subida = date('Y-m-d H:i:s');


            $routeFile = "../clintes.xlsx";

            $sql_query =
                "INSERT INTO Archivos_SubirClientes 
                    (IdUsuario,  NombreArchivo, RutaArchivo , FechaSubida    , Activo) 
            VALUES  (1        , '$codigo'     , '$routeFile', '$fecha_subida', 1)";

            if (mysqli_multi_query($enlace, $sql_query)) {
                $last_id = mysqli_insert_id($enlace);
   
                mysqli_multi_query($enlace, 
                "INSERT INTO DatosClientes (codigo,      coordenadas,    nombre_completo, Datos_factura, direccion,    telefono,         telefono_oficina, celular1,         celular2,       correo,   info_cisterna,    comentarios,   estado,          tipo_persona_tel_cliente, obser_tel_cliente,            tipo_persona_tel_of,  obser_tel_of,               tipo_persona_cel1,      obser_cel1,                   numero_libre,   actualizar_pendiente, fecha_subida, tipo_persona_cel2,    obser_cel2   ,IdArchivo                 ) 
                    VALUES   ('$codigo$x', '$coordenadas', '$nombre',       '$factura',    '$direccion', '$tel_principal', '$tel_oficina',   '$cel_principal', '$cel_segundo', '$email', '$info_cisterna', '$comentario', 'Por gestionar', '$tel_principal_trato',   '$tel_principal_observacion', '$tel_oficina_trato', '$tel_oficina_observacion', '$cel_principal_trato', '$cel_principal_observacion', '$campo_libre', 1,                    '$hoy',       '$cel_segundo_trato', '$cel_segundo_observacion' , $last_id)");
            }
        }

        $x++;
    }

    echo '<script type="text/javascript">alert("Archivo de clientes subido correctamente");</script>';
} else {
    header('Content-Type: application/json');
    echo '[{"tipo":"error":"' . SimpleXLSX::parseError() . '"}]';
}
