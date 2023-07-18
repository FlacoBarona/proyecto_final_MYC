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

      $sql = $con->prepare("SELECT * FROM juegos WHERE id=? AND  activo=1 LIMIT 1");
      $sql->execute([$id]);
      $row = $sql->fetch(PDO::FETCH_ASSOC);
      $nombre = $row['nombre'];
      $descripcion = $row['descripcion'];
      $precio = $row['precio'];
      $descuento = $row['descuento'];
      $precio_des = $precio - (($precio * $descuento) / 100);
      $dir_images = 'Tienda_online/images/juegos/' . $id . '/';

      $categoria = $row['id_categoria'];
      $plataforma = $row['plataforma'];
      $requisitos = $row['requisitos'];
      $jugabilidad = $row['jugabilidad'];
      $sqlCat = $con->query("SELECT nombre from categorias where id=$categoria;");
      $cate = $sqlCat->fetch(PDO::FETCH_ASSOC);

      $cat = $cate['nombre'];

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

if (isset($_SESSION['user_name'])) {
  $boton1 .= '<a href="metodosPago.php" class="btn btn-primary">Comprar ahora</a>';"<img class='icon-cart' src='https://media.giphy.com/media/EopV0wKH3USE9F7fhe/giphy.gif' alt='Icon'>";
  $boton2 .= '<button class="shop-car" type="button" onclick="addProducto(' . $id . ', \'' . $token_tmp . '\')">Agregar al carrito</button>';"<img class='icon-cart' src='https://cdn.pixabay.com/animation/2023/03/22/04/48/04-48-41-618_512.gif' alt='Icon'>";
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
          <img class='icon-boo' src='https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/bc25ec3f-b1c8-4630-91e9-1e260b289f2d/d91zy67-424b516e-5eee-416e-94a8-cc5cb5eb718a.gif?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcL2JjMjVlYzNmLWIxYzgtNDYzMC05MWU5LTFlMjYwYjI4OWYyZFwvZDkxenk2Ny00MjRiNTE2ZS01ZWVlLTQxNmUtOTRhOC1jYzVjYjVlYjcxOGEuZ2lmIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.Qr0N9B4Rk1sgjiO7aP9b1VB25B2Cl6C9QLYrFMBTl48' alt='Icon'>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarHeader">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          </ul>
          <a href="checkout.php" class="shop-car">
            Carrito <samp id="num_cart" class="badge bg-secondary"><?php echo $num_cart ?></samp>
            <img class='icon' src='https://media2.giphy.com/media/Ut9IfYd8U1C0CNQi76/200w.gif?cid=790b761157x2ne14nnh4gszmrgij3jieotmmrk5rlf0mornr&ep=v1_gifs_search&rid=200w.gif&ct=g' alt='Icon'>
          </a>
        </div>

      </div>
    </div>
  </header>


  <main>
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-1">
          <div id="carouselImages" class="carousel slide" data-bs-ride="caroules">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselImages" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselImages" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselImages" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="10000">
                <img src="<?php echo $rutaImgen; ?>" class="d-block w-100">
              </div>
              <?php foreach ($imagenes as $img) { ?>
                <div class="carousel-item" data-bs-interval="10000">
                  <img src="<?php echo $img; ?>" class="d-block w-100">
                </div>
              <?php } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>

        </div>
        <div class="col-md-6 order-md-2">
          <h2><?php echo $nombre; ?></h2>
          <?php if ($descuento > 0) { ?>
            <p><del> <?php echo MONEDA . $precio; ?> </del></p>
            <h2>
              <?php echo MONEDA . $precio_des; ?>
              <small class="text-success"> <?php echo $descuento; ?>% descuento</small>
            </h2>
          <?php } else { ?>
            <h2><?php echo MONEDA . $precio; ?></h2>
          <?php } ?>
          <p class="lead">
            <?php echo $descripcion; ?>
          </p>

          <p class="lead">
            <small class="lead"> Categoria: </small>
            <?php echo $cat; ?>
          </p>
          <p class="lead">
            <small class="lead"> Plataforma: </small>
            <?php echo $plataforma; ?>
          </p>
          <p class="lead">
            <small class="lead"> Requisitos del sistema: </small>
            <?php echo $requisitos; ?>
          </p>
          <p class="lead">
            <?php echo $jugabilidad; ?>
          </p>
          <div class="d-grid gap-3 col-10 mx-auto">
            <?php echo $boton1 ?>
            <?php echo $boton2 ?>
            <a href="index.php" class="btn btn-success">Atras</a>
          </div>
        </div>

      </div>
    </div>
  </main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

  <script>
    function addProducto(id, token) {
      let url = 'clases/carrito.php'
      let formData = new FormData()
      formData.append('id', id)
      formData.append('token', token)

      fetch(url, {
          method: 'POST',
          body: formData,
          mode: 'cors'
        }).then(response => response.json())
        .then(data => {
          if (data.ok) {
            let elemento = document.getElementById("num_cart")
            elemento.innerHTML = data.numero
          }
        })
    }
  </script>
  <footer>
    <div class="footer-content">
      <div class="footer-links">
        <a href="index.php"><i class="fas fa-home"></i> Inicio</a>
      </div>
      <div class="footer-info">
        <p><i class="fas fa-envelope"></i> Contacto: jespinoza5229@gmail.com</p>
        <p><i class="fas fa-map-marker-alt"></i> Dirección: Ambato, UTA</p>
        <b></b>
      </div>

      <div class="footer-content">

        <div class="social-icons">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>
    <p class="footer-copyright">© 2023 Grupo 4. Todos los derechos reservados.</p>
  </footer>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>

</html>