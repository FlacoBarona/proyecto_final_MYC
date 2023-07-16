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
                    <a href="inicioSesion.php" class="btn btn-success">
                        Cerrar sesion
                    </a>
                </div>

            </div>
        </div>
    </header>

    <main>
        <div class="container text-center">
            <h2>Agregar videojuego</h2>
            <br/>
            <center>
                <form  method="post" autocomplete="off">
                    <div class="col-md-6">
                        <label for="nombreJuego"><span class="text-danger">*</span>Nombre del videojuego</label>
                        <input type="text" name="nombreJuego" id="nombreJuego" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="precio"><span class="text-danger">*</span>Precio</label>
                        <input type="number" name="precio" id="precio" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="descuento"><span class="text-danger">*</span>Descuento</label>
                        <input type="number" name="descuento" id="descuento" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="activo"><span class="text-danger">*</span>Activo</label>
                        <input type="number" name="activo" id="activo" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="categoria"><span class="text-danger">*</span>Categoria</label>
                        <input type="number" name="categoria" id="categoria" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="descripcion"><span class="text-danger">*</span>Descripcion</label>
                        <input type="text" style="HEIGHT: 98px;" name="descripcion" id="descripcion" class="form-control" required>
                    </div>
                    <br/>
                    <div class="col-12">
                        <a href="admin.php" class="btn btn-success">Atras</a>
                        <input type="submit" name="agregar" class="btn btn-primary btn-sm btn-block" onclick="insertarJuego()" value="Agregar">
                    </div>

                </form>
            </center>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/funciones.js"></script>
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