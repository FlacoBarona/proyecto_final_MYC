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
