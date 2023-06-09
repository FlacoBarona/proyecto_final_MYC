<?php

require 'config/configuracion.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT id, nombre, precio FROM juegos WHERE activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
echo "http://" . $host . $url;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <title>Online Store</title>
</head>

<body>
  <header>
    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a href="#" class="navbar-brand">
          <strong>Games Store</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarHeader">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">


          </ul>
          <a href="buscarJuego.php" class="btn btn-primary">
            Find game
          </a>
          <a href="checkout.php" class="btn btn-primary">
            Car <samp id="num_cart" class="badge bg-secondary"><?php echo $num_cart ?></samp>
          </a>
          <a href="inicioSesion.php" class="btn btn-success">
            Log out
          </a>
        </div>

      </div>
    </div>
  </header>

  <main>
    <div class="container">
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
                <p class="card-text"><?php echo $row['precio'] . ' $'; ?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="detalles.php?id=<?php echo $row['id']; ?> &token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>" class="btn btn-primary">Detalles</a>
                  </div>
                  <button class="btn btn-outline-success" type="button" onclick="addProducto(<?php echo $row['id']; ?>, 
                   '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>')">
                    Agregar al carrito
                  </button>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </main>

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
</body>

</html>