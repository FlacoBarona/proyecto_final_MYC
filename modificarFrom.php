<?php
session_start();
require 'config/database.php';

$db = new Database();
$con = $db->conectar();

$id = $_GET['id'];
$sql = $con->prepare("SELECT * FROM juegos WHERE  id='$id'");
$sql->execute();

$resultado = $sql->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['modificar'])) {
  $id = $_POST['id'];
  $nombre = trim($_POST['nombre']);
  $precio = trim($_POST['precio']);
  $descuento = trim($_POST['descuento']);
  $activo = trim($_POST['activo']);
  $categoria = trim($_POST['categoria']);
  $descripcion = trim($_POST['Descripcion']);

  $actualiza =$con->prepare( "UPDATE juegos SET nombre='$nombre', descripcion='$descripcion', precio=$precio, descuento=$descuento,
  id_categoria=$categoria, activo=$activo WHERE id='$id'");
  $actualiza->execute();
  header("location:modificarJuego.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Games</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
    
</body>
</html>