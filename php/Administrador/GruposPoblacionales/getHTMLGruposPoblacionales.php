<?php
include("../../connect.php");

$script = "SELECT * FROM DatosIngreso";

$resultado = mysqli_query($enlace, $script);

$tabla = "
<div style='background-color:white; padding:10px; margin-top:20px'>
	<div class='row'>
		<div class='col-md-12' style='margin-top:5px'>
		<h2 class='text-primary'>Grupos poblacionales</h2>
		</div>
	</div>
	<br/>

	<div class='row' style='display: flex; flex-direction:row-reverse'>
		<div class='col-md-3'>
			<input type='button' class='btn btn-success' onclick='n_grupo()' value='Agregar grupo'/>
		</div>
	</div>
	<br/>

	<div class='row'>
		<div class='col-md-12'>
			<table class='table table-bordered'>
				<thead>
					<tr>
						<th>Nombre</th>
						<th>provincia</th>
						<th>Canton</th>
						<th>Parroquia</th>
						<th>Comentario</th>
						<th>Clientes asignados</th>
						<th>Operadores asignados</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody>";

$data = mysqli_query($enlace, "SELECT * FROM grupos");
while ($res = mysqli_fetch_array($data)) {
	$pr = mysqli_query($enlace, "SELECT prov_desc FROM provincias WHERE id_prov = '" . $res['idprov'] . "'");
	$pr1 = mysqli_fetch_array($pr);
	$cn = mysqli_query($enlace, "SELECT canton_desc FROM cantones WHERE id_canton = '" . $res['idcanton'] . "'");
	$cn1 = mysqli_fetch_array($cn);
	$pr2 = mysqli_query($enlace, "SELECT parroquia_desc FROM parroquias WHERE id_parroquia = '" . $res['idparroquia'] . "'");
	$pr3 = mysqli_fetch_array($pr2);


	$tabla .= "<tr>
	<td>" . $res['nombre'] . "</td>
	<td>" . $pr1['prov_desc'] . "</td>
	<td>" . $cn1['canton_desc'] . "</td>
	<td>" . $pr3['parroquia_desc'] . "</td>
	<td>" . $res['comentario'] . "</td>";
	$data_clientes = mysqli_query($enlace, "SELECT * FROM grupo_asignacion WHERE grupo_asignacion.id_grupo ='" . $res['id'] . "' AND grupo_asignacion.tipo = 1");
	$datac_num = mysqli_num_rows($data_clientes);
	$tabla .= "<td align=center>" . $datac_num . "</td>";
	$tabla .= "
	<td>";

	$data_operador = mysqli_query($enlace, "SELECT * FROM grupo_asignacion LEFT JOIN DatosIngreso on grupo_asignacion.id_cliente = DatosIngreso.id WHERE grupo_asignacion.id_grupo ='" . $res['id'] . "' AND grupo_asignacion.tipo = 2");
	while ($res_oper = mysqli_fetch_array($data_operador)) {
		$tabla .= "" . $res_oper['user'] . " <br/>";
	}

	$tabla .= "</td>
	<td><a role='button' class='btn btn-primary' style='text-decoration:none; color:white' href='javascript:goToEditarMiembrosDeGrupo(" . $res['id'] . ")'>Editar miembros</a><br/>
	<input type='button' class='btn btn-danger'  style='margin-top:15px' value='Eliminar grupo' onclick='borrar_grupo(" . $res['id'] . ")'></td>
	</tr>";
}

$tabla .= "
				</tbody>
			</table>
			<br>
			<br>
		</div>
	</div>
</div>
";


echo $tabla;
include("../../QuitDB.php");
?>