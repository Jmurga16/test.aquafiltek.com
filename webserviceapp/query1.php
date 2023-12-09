<?php
  include 'connect.php';
  $total="";
  if (isset($_POST['query'])) {
    $search_query = $_POST['query'];
    
//   to limit the result in number use LIMIT 6 at the end of query before duble cot

    $query = "SELECT * FROM DatosClientes WHERE nombre_completo LIKE '%$search_query%' ";
    $result = mysqli_query($enlace, $query);
  if (mysqli_num_rows($result) > 0) {
   while ($country_row = mysqli_fetch_array($result)) {
    $total.=$country_row['nombre_completo']."<br/>";
  }
} else {
    
  //echo "<p style='color:red'>Not found</p>";
}
}



echo json_encode($total);

?>