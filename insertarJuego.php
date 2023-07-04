<?php

require 'config/configuracion.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT id, nombre, precio FROM juegos WHERE activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['agregar'])) {
    $nombre = trim($_POST['nombreJuego']);
    $precio = trim($_POST['precio']);
    $descuento = trim($_POST['descuento']);
    $activo = trim($_POST['activo']);
    $categoria = trim($_POST['categoria']);
    $descripcion = trim($_POST['descripcion']);
    $insertar = $con->prepare("INSERT INTO juegos (nombre, descripcion, precio, descuento, id_categoria, activo) 
  VALUES ( '$nombre', '$descripcion', '$precio', '$descuento', '$categoria', '$activo');");
  $insertar->execute();
}

?>