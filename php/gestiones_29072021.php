<?php
include "connect.php";
session_start();

$tipo = $_POST['tipo'];
$tipoG = $_POST['gestion'];

function reboot_gest() {
	include "connect.php";
	mysqli_query($enlace, "UPDATE `gestiones_dia` SET `gestiones`=99999 WHERE `id_operador`=" . $_SESSION['ide']);
	mysqli_query($enlace, "UPDATE `gestiones_dia` SET `gestiones`=0 WHERE `id_operador`=" . $_SESSION['ide']);
	mysqli_query($enlace, "DELETE FROM `tipo_gestiones_dia` WHERE `id_operador`=" . $_SESSION['ide']);
	include "QuitDB.php";
}

function verificar_fecha($date) {
	$fecha = explode(" ", $date);
	$fecha = explode("-", $fecha[0]);
	date_default_timezone_set("America/Bogota");
	$fecha_hoy = explode("-", date("Y-m-d"));
	if (intval($fecha[2]) < intval($fecha_hoy[2])) {
		return true;
	} else {
		return false;
	}

}

switch ($tipo) {
case 0:
	$script = "<script>

            // Despliega el conteo de gestiones del dia
					$(\"#mostrar_estadistica\").click(function(event) {
						llenar_modal();
						$(\"#modal-gestiones\").modal();
					});
			</script>";
	$result_gestion = mysqli_query($enlace, "SELECT * FROM `gestiones_dia` WHERE `id_operador`=" . $_SESSION['ide']);
	if (mysqli_num_rows($result_gestion) == 0) {
		mysqli_query($enlace, "INSERT INTO `gestiones_dia`(`id_operador`, `gestiones`) VALUES (" . $_SESSION['ide'] . ",0)");
		echo "<a id=\"mostrar_estadistica\">
                <img src=\"../img/emoticonos/0.png\"> No tienes ninguna gestion el dia de hoy.
            </a>";
	} else {
		$data_gestion = mysqli_fetch_array($result_gestion);
		if (verificar_fecha($data_gestion['fecha_ultima'])) {
			reboot_gest();
			$result_gestion = mysqli_query($enlace, "SELECT * FROM `gestiones_dia` WHERE `id_operador`=" . $_SESSION['ide']);
			$data_gestion = mysqli_fetch_array($result_gestion);
		}
		$image = "0.png";

		if ($data_gestion['gestiones'] >= 10) {
			$image = "10.png";
		} else if ($data_gestion['gestiones'] >= 8) {
			$image = "8.png";
		} else if ($data_gestion['gestiones'] >= 6) {
			$image = "6.png";
		} else if ($data_gestion['gestiones'] >= 4) {
			$image = "4.png";
		} else if ($data_gestion['gestiones'] >= 2) {
			$image = "2.png";
		}
		if ($data_gestion['gestiones'] == 0) {
			echo "<a id=\"mostrar_estadistica\">
                <img src=\"../img/emoticonos/" . $image . "\"> No tienes ninguna gestión el dia de hoy.
            </a>" . $script;
		} else if ($data_gestion['gestiones'] == 1) {
			echo "<a id=\"mostrar_estadistica\">
                <img src=\"../img/emoticonos/" . $image . "\"> Tienes " . $data_gestion['gestiones'] . " gestión el dia de hoy.
            </a>
            " . $script;
		} else {
			echo "<a id=\"mostrar_estadistica\">
                <img src=\"../img/emoticonos/" . $image . "\"> Tienes " . $data_gestion['gestiones'] . " gestiones el dia de hoy.
            </a>
            " . $script;
		}
	}
	break;
case 1:
	$id_cliente = $_POST['cl'];
	$result_gestion = mysqli_query($enlace, "SELECT * FROM `gestiones_dia` WHERE `id_operador`=" . $_SESSION['ide']);
	$data_gestion = mysqli_fetch_array($result_gestion);
	if (verificar_fecha($data_gestion['fecha_ultima'])) {
		reboot_gest();
	} else {
		$gest = intval($data_gestion['gestiones']) + 1;
		echo mysqli_query($enlace, "UPDATE `gestiones_dia` SET `gestiones`=$gest WHERE `id_operador`=" . $_SESSION['ide']);
		echo mysqli_query($enlace, "INSERT INTO `tipo_gestiones_dia`(`id_operador`, `tipo_gestion`,`usuario_gestionado`) VALUES (" . $_SESSION['ide'] . ",'$tipoG','$id_cliente')");
	}
	break;
case 2:
	$t_acepto = 0;
	$t_rechazo = 0;
	$t_volver_llamar = 0;
	$t_no_responde = 0;
	$t_otro = 0;
	$t_equivocado = 0;
	$t_averiado = 0;
	$result_cont = mysqli_query($enlace, "SELECT * FROM `tipo_gestiones_dia` WHERE `id_operador`=" . $_SESSION['ide']);
	$cant_clientes = mysqli_fetch_array(mysqli_query($enlace, "SELECT COUNT(DISTINCT usuario_gestionado) AS total_clientes  FROM `tipo_gestiones_dia` WHERE `id_operador`=" . $_SESSION['ide']));

	while ($data_cont = mysqli_fetch_array($result_cont)) {
		switch ($data_cont['tipo_gestion']) {
		case 'ac':
			$t_acepto++;
			break;
		case 're':
			$t_rechazo++;
			break;
		case 'vl':
			$t_volver_llamar++;
			break;
		case 'nr':
			$t_no_responde++;
			break;
		case 'ot':
			$t_otro++;
			break;
		case 'eq':
			$t_equivocado++;
			break;
		case 'av':
			$t_averiado++;
			break;
		}
	}
	echo '<h5 class="text-dark text-center">Has realizado ' . mysqli_num_rows($result_cont) . ' gestiones, a un total de <span class="text-success">' . $cant_clientes['total_clientes'] . '</span> clientes el dia de hoy.</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>~';
	echo "<table class=\"table table-bordered table-dark\">
                          <thead>
                            <tr>
                              <th scope=\"col\" class=\"text-center\">Tipo gestion</th>
                              <th scope=\"col\" class=\"text-center\"># veces realizada</th>
                             </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope=\"row\" class=\"text-center\">Acepto</th>
                              <td class=\"text-center\">" . $t_acepto . "</td>
                            </tr>

                            <tr>
                              <th scope=\"row\" class=\"text-center\">Volver a llamar</th>
                              <td class=\"text-center\">" . $t_volver_llamar . "</td>
                            </tr>

                            <tr>
                              <th scope=\"row\" class=\"text-center\">Rechazo</th>
                              <td class=\"text-center\">" . $t_rechazo . "</td>
                            </tr>

                            <tr>
                              <th scope=\"row\" class=\"text-center\">No responde</th>
                              <td class=\"text-center\">" . $t_no_responde . "</td>
                            </tr>

                            <tr>
                              <th scope=\"row\" class=\"text-center\">Equivocado</th>
                              <td class=\"text-center\">" . $t_equivocado . "</td>
                            </tr>

                            <tr>
                              <th scope=\"row\" class=\"text-center\">Averiado</th>
                              <td class=\"text-center\">" . $t_averiado . "</td>
                            </tr>

                            <tr>
                              <th scope=\"row\" class=\"text-center\">Otro</th>
                              <td class=\"text-center\">" . $t_otro . "</td>
                            </tr>
                          </tbody>
                    </table>";
	break;
}
include "QuitDB.php";

?>