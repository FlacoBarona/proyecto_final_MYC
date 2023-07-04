<?php

require 'config/configuracion.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($id == '' || $token == '') {
  echo "Error al ejecutar la peticion";
  exit;
} else {

  $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

  if ($token = $token_tmp) {

    $sql = $con->prepare("SELECT count(id) FROM juegos WHERE id=? AND  activo=1");
    $sql->execute([$id]);
    if ($sql->fetchColumn() > 0) {

      $sql = $con->prepare("SELECT nombre, descripcion, precio, descuento FROM juegos WHERE id=? AND  activo=1 LIMIT 1");
      $sql->execute([$id]);
      $row = $sql->fetch(PDO::FETCH_ASSOC);
      $nombre = $row['nombre'];
      $descripcion = $row['descripcion'];
      $precio = $row['precio'];
      $descuento = $row['descuento'];
      $precio_des = $precio - (($precio * $descuento) / 100);
      $dir_images = 'Tienda_online/images/juegos/' . $id . '/';

      $rutaImgen = $dir_images . 'principal.jepg';

      if (!(file_exists($rutaImgen))) {
        $rutaImgen = 'images/no-photo.jpg';
      }
      $imagenes = array();
      if (file_exists($dir_images)) {
        $dir = dir($dir_images);
        while (($archivo = $dir->read()) != false) {
          if ($archivo != 'principal.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))) {
            $imagenes[] = $dir_images . $archivo;
          }
        }
        $dir->close();
      }
    }
  } else {
    echo "Error";
    exit;
  }
}

?>