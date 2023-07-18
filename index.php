<?php

require 'config/configuracion.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT * FROM juegos WHERE activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
//echo "http://" . $host . $url;

$boton = '';

if (isset($_SESSION['user_name'])) {
  $boton .= '<a href="../Tienda_online/config/logout.php" class="log-out">Cerrar sesion</a>
  ';"<img class='icon' src='https://img1.picmix.com/output/stamp/normal/9/6/5/4/314569_78e0a.gif' alt='Icon'>";
} else {
  $boton .= '<a href="inicioSesion.php" class="btn btn-success">Iniciar Sesion</a>';"<img class='icon' src='https://i.pinimg.com/originals/4f/6a/31/4f6a318bb2bd6ffca64986f59d0112c8.png' alt='Icon'>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>Online Store</title>
  <style>
    .search-container {
      text-align: center;
      margin-top: 20px;
    }

    .search-container input[type=text] {
      padding: 10px;
      width: 300px;
    }
  </style>
</head>

<body>
  <header>
    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a href="#" class="navbar-brand">
          <strong>Games Store</strong>
          <img class='icon-boo' src='https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/bc25ec3f-b1c8-4630-91e9-1e260b289f2d/d91zy67-424b516e-5eee-416e-94a8-cc5cb5eb718a.gif?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcL2JjMjVlYzNmLWIxYzgtNDYzMC05MWU5LTFlMjYwYjI4OWYyZFwvZDkxenk2Ny00MjRiNTE2ZS01ZWVlLTQxNmUtOTRhOC1jYzVjYjVlYjcxOGEuZ2lmIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.Qr0N9B4Rk1sgjiO7aP9b1VB25B2Cl6C9QLYrFMBTl48' alt='Icon'>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarHeader">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">


          </ul>
          <a href="checkout.php" class="shop-car">
            Cart <samp id="num_cart" class="badge bg-secondary"><?php echo $num_cart ?></samp>
            <img class='icon' src='https://media2.giphy.com/media/Ut9IfYd8U1C0CNQi76/200w.gif?cid=790b761157x2ne14nnh4gszmrgij3jieotmmrk5rlf0mornr&ep=v1_gifs_search&rid=200w.gif&ct=g' alt='Icon'>
          </a>
          <?php echo $boton ?>
        </div>

      </div>
    </div>
  </header>

  <main>
    <div class="search-container">
      <input type="text" id="search-input" placeholder="Buscar juegos...">
    </div>
    <br>
    <div class="container" id="game-list">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php foreach ($resultado as $row) { ?>
          <div class="col">
            <div class="card shadow-sm">
              <?php

              $id  = $row['id'];
              $imagen = "Images/juegos/" . $id . "/principal.jpeg";
              if (!file_exists($imagen)) {
                $imagen = "images/no-photo.jpg";
              }
              ?>
              <img src="<?php echo $imagen; ?>">
              <div class="card-body">
                <h5 class="card-title"><?php echo $row['nombre']; ?></h5>
                <div class="d-flex justify-content-between align-items-center">
                  <p class="card-text"><?php echo $row['plataforma']; ?></p>
                  <p class="card-text"><?php echo $row['precio'] . ' $'; ?></p>
                </div>
                <p class="card-text"><?php echo $row['jugabilidad']; ?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="detalles.php?id=<?php echo $row['id']; ?> &token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>" class="btn btn-primary">Detalles</a>
                  </div>
                  <button class="shop-car" type="button" onclick="addProducto(<?php echo $row['id']; ?>, 
                   '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>')">
                    Agregar al carrito
                    <img class='icon-cart' src='https://cdn.pixabay.com/animation/2023/03/22/04/48/04-48-41-618_512.gif' alt='Icon'>
                  </button>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </main>

  <script src="js/script.js"></script>

  <script>
    function addProducto(id, token) {
      obtenerValorPHP()
        .then(function(valor) {
          console.log('Valor desde PHP: ' + valor);

          if (valor == 'true') {
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
          } else {
            window.location.href = "inicioSesion.php";
          }
        })
        .catch(function(error) {
          console.error('Error en la solicitud AJAX:', error);
        });
    }

    function obtenerValorPHP() {
      return new Promise(function(resolve, reject) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'login.php', true);
        xhr.onload = function() {
          if (xhr.status === 200) {
            var valorPHP = xhr.responseText;
            resolve(valorPHP);
          } else {
            reject(xhr.statusText);
          }
        };
        xhr.onerror = function() {
          reject(xhr.statusText);
        };
        xhr.send();
      });
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

</body>

</html>