<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'tienda_online';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die('Error de conexión: ' . $conn->connect_error);
}

$searchTerm = $_GET['search'];

$sql = "SELECT * FROM juegos WHERE nombre LIKE '%$searchTerm%'";
$result = $conn->query($sql);

$games = array();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $games[] = $row;
  }
}

$conn->close();

echo json_encode($games);
?>