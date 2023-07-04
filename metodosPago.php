<?php

require './config/Auth.php';
$errors = [];

if (!empty($_POST)) {
  $correo = trim($_POST['correo']);
  $clave = trim($_POST['clave']);

  $num_tarjeta = trim($_POST['num_tarjeta']);
  $fecha_caducidad = trim($_POST['fecha_cad']);
  $codigo_tarjeta= trim($_POST['cod_tar']);
  $nombre = trim($_POST['nombre']);
  $apellido = trim($_POST['apellido']);
  $localidad = trim($_POST['localidad']);
  $direccion = trim($_POST['direccion']);
  $pais = trim($_POST['pais']);
  $telefono = trim($_POST['telf']);

  if (esNulo([$correo, $clave])) {
    $errors[] = "Debe llenar todos los campos";
  }else{
    if(esNulo([$num_tarjeta, $fecha_caducidad, $codigo_tarjeta, $nombre, $apellido, $localidad, $direccion,
    $pais, $telefono])){
        $errors[] = "Debe llenar todos los campos";
    }
  }

  if (!esEmail($correo)) {
    $errors[] = "Correo electronico no valido";
  }

  if (count($errors) == 0) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      Usuario registrado correctamente
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    
  } else {
    $errors[] = "Error al realizar la compra";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style type="text/css">
        #paypal {
            display: none;
        }

        #tarjeta {
            display: none;
        }

    </style>
    <link rel="stylesheet" href="../Tienda_online/CSS/metodosPago.css">
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
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                    <a href="inicioSesion.php" class="btn btn-success">
                        Log Out
                    </a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="containera">
            <div class="row">
                <div class="col-md-9 col-lg-8 mx-auto">
                <?php mostrarMensajes($errors); ?>
                    <form action="#" class="caja">
                        <h3 class="login-heading mb-4">ELIJA SU METODO DE PAGO</h3>
                        <div class="d-grid">
                            <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" type="submit" onclick="mostrarPaypal(), ocultarTarjeta() ">PayPal</button>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" type="submit" onclick="ocultarPaypal(), mostrarTarjeta()">Tarjeta de credito</button>
                        </div>
                        <div class="d-grid">
                            <a href="index.php" class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" type="submit">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <form id="paypal" class="paypal">
        <div>


            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="correo" name="correo" placeholder="myusername" required>
                <label for="usuario">Ingrese su correo electronico</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="clave" name="clave" placeholder="myusername" required>
                <label for="usuario">Ingrese su contraseña</label>
            </div>


            <div id="paga">
                <a href="compra.php" class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit"> Pagar </a>
            </div>
            <br/>
            <div id="cancelar">
                <a href="checkout.php" class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit"> Cancelar </a>
            </div>
        </div>
    </form>

    <form id="tarjeta" class="tarjeta">
        <h2>Informacion de tarjeta</h2>
        <div class="form-floating mb-3 col-md-2 col-lg-4 ">
            <input type="number" class="form-control" id="num_tarjeta" name="num_tarjeta" placeholder="myusername" required>
            <label for="usuario">Ingrese el numero de tarjeta</label>
        </div>
        <div class="form-floating mb-3 col-md-5 col-lg-4">
            <input type="text" class="form-control" id="fecha_cad" name="fecha_cad" placeholder="myusername" required>
            <label for="usuario">Fecha de caducidad 00/0000</label>
        </div>

        <div class="form-floating mb-3 col-md-5 col-lg-3">
            <input type="number" class="form-control" id="cod_tar" name="cod_tar" placeholder="myusername" required>
            <label for="usuario">Codigo de seguridad</label>
        </div>
        <h2>Informe de facturacion</h2>
        <div class="form-floating mb-3 ">
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="myusername" required>
            <label for="usuario">Ingrese su nombre</label>
        </div>
        <div class="form-floating mb-3 ">
            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="myusername" required>
            <label for="usuario">Ingrese sus apellidos</label>
        </div>
        <div class="form-floating mb-3 ">
            <input type="text" class="form-control" id="localidad" name="localidad" placeholder="myusername" required>
            <label for="usuario">Ingrese la localidad</label>
        </div>
        <div class="form-floating mb-3 ">
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="myusername" required>
            <label for="usuario">Ingrese su direccion</label>
        </div>
        <div class="form-floating mb-3 ">
            <input type="text" class="form-control" id="pais" name="pais" placeholder="myusername" required>
            <label for="usuario">Ingrese su pais</label>
        </div>
        <div class="form-floating mb-3 ">
            <input type="number" class="form-control" id="telf" name="telf" placeholder="myusername" required>
            <label for="usuario">Ingrese su telefono</label>
        </div>
        <form action="compra.php">
        <div id="paga">
                <a href="compra.php" class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit"> Pagar </a>
            </div>
            <br/>
            <div id="cancelar">
                <a href="checkout.php" class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit"> Cancelar </a>
            </div>
        </form>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/funciones.js"></script>
</body>
</html>