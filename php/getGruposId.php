<?php
error_reporting(0);

include "connect.php";



$data = mysqli_query($enlace,"SELECT * FROM grupos");
$ids = '';
$i = 1;
$num = mysqli_num_rows($data);
while ($res = mysqli_fetch_array($data))
{
	if($num == $i)
	{
		$ids .= "".$res['id']."";
	}
	else
	{
		$ids .= "".$res['id'].",";
	}

}

echo $ids;


?>
