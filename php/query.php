<?php
  include 'connect.php';
  // mysql_set_charset('utf8',$enlace);
  if (isset($_POST['query'])) {
    $search_query = $_POST['query'];
    
//   to limit the result in number use LIMIT 6 at the end of query before duble cot

    $query = "SELECT * FROM DatosClientes WHERE direccion LIKE '%$search_query%' ";
    $result = mysqli_query($enlace, $query);

  

  if (mysqli_num_rows($result) > 0) {
   while ($country_row = mysqli_fetch_array($result)) {

    echo '<b>'.$country_row['nombre_completo']."</b><br/>";
    echo $country_row['direccion']."<br/>";

  }
} else {
 // echo "<p style='color:red'>Not found</p>";
}
}
?>