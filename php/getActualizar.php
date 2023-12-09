<?php 
include("connect.php");
session_start();
$grupo = "SELECT DISTINCT id_grupo FROM grupo_asignacion WHERE id_cliente = '".$_SESSION['ide']."' AND tipo = 2";
$get_grupo = mysqli_query($enlace,$grupo);
$res = mysqli_fetch_array($get_grupo);
$data = "SELECT * FROM grupo_asignacion LEFT JOIN DatosClientes on grupo_asignacion.id_cliente = DatosClientes.codigo WHERE id_grupo = '".$res['id_grupo']."' AND DatosClientes.actualizar_pendiente = 1";





$data1 = mysqli_query($enlace,$data);
$num = mysqli_num_rows($data1);
if($num == 0)
{
    echo "0~";
}
else
{
echo "$num~";
}


while($new = mysqli_fetch_array($data1))
{
echo "<tr>
<td>".$new['nombre_completo']."</td>
<td>".$new['direccion']."</td>
<td>".$new['codigo']."<input type='hidden' name='ocodigo' value='".$new['codigo']."'></td>
<td align=center><input type='text' name='ncodigo' class='form-control'></td>
</tr>";
}




?>