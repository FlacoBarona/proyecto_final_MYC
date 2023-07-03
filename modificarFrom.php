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
          <a href="inicioSesion.php" class="btn btn-success">
            Cerrar sesion
          </a>
        </div>

      </div>
    </div>
  </header>

  <main>
    <div class="container">
      <div class="text-center">
        <h2>Modificar Juego</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <div class="row">
            <input type="hidden" name="id" value="<?php echo $resultado['id']; ?>">
            <input type="text" name="nombre" class="form-control" value="<?php echo $resultado['nombre']; ?>" placeholder="Nombre" required>
          </div>
          <div class="row">
            <input type="text" name="precio" class="form-control" value="<?php echo $resultado['precio']; ?>" placeholder="Precio" required>
          </div>
          <div class="row">
            <input type="text" name="descuento" class="form-control" value="<?php echo $resultado['descuento']; ?>" placeholder="Descuento" required>
          </div>
          <div class="row">
            <input type="text" name="activo" class="form-control" value="<?php echo $resultado['activo']; ?>" placeholder="Activo" required>
          </div>
          <div class="row">
            <input type="text" name="categoria" class="form-control" value="<?php echo $resultado['id_categoria']; ?>" placeholder="Categoria" required>
          </div>
          <div class="row">
            <input type="text" name="Descripcion" class="form-control" value="<?php echo $resultado['descripcion']; ?>" placeholder="Descripcion" required>
          </div>
          <br/>
          <div class="row col-2 col-4">
            <input type="submit" name="modificar" class="btn btn-success btn-sm btn-block" value="Modificar">
          </div>
          <br/>
          <div class="row col-2 col-4">
            <a href="modificarJuego.php" class="btn btn-primary">Atras</a>
          </div>
          <br/>
        </form>
      </div>
    </div>
  </main>
</body>
</html>