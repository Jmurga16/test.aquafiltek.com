 <?php
$servername = "localhost";
$username = "aquafiltek_programmer";
$password = "?W8ndp%sv*@G";
$dbname = "aquafiltek_Operadores";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `hora_ingreso`,`direccion_ip` FROM `HorariosIngreso`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Hora de igreso: " . $row["hora_ingreso"]. " - IP: " . $row["direccion_ip"];
        echo "<br/>";
    }
} else {
    echo "0 results";
}
$conn->close();
?> 