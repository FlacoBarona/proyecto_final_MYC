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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tienda Online</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="css/styles.css" rel="stylesheet">
</head>
<body>

<header>
    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a href="#" class="navbar-brand">
          <strong>Tienda de videojuegos</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarHeader">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          </ul>
          <a href="checkout.php" class="btn btn-primary">
            Carrito <samp id="num_cart" class="badge bg-secondary"><?php echo $num_cart?></samp>
          </a>
        </div>

      </div>
    </div>
  </header>
    
</body>
</html>