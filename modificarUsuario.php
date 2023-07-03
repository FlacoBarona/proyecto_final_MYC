<?php
session_start();
require 'config/database.php';

$db = new Database();
$con = $db->conectar();

$id = $_GET['id'];
$sql = $con->prepare("SELECT * FROM usuarios WHERE  id='$id'");
$sql->execute();

$resultado = $sql->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['modificar'])) {
    $id = $_POST['id'];
    $usuario = trim($_POST['usuario']);
    $clave = trim($_POST['clave']);
    $correo = trim($_POST['correo']);

    $actualiza = $con->prepare("UPDATE usuarios SET usuario='$usuario', clave='$clave', correo='$correo' WHERE id='$id'");
    $actualiza->execute();
    header("location:administrarUsuarios.php");
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>
</body>
</html>