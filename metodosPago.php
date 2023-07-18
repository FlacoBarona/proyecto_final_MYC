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
    <script src="https://www.paypal.com/sdk/js?client-id=AXzUM68xEg8QLiMCUSh7AMDMe0C4gUyVOmuAsMm8Eo_OxN9t59WFvFxSDh0bX2yyvBzOh0FHTQWewi-N"></script>
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
                        <div id="paypal-button-container"></div>
    <script>paypal.Buttons({
        style:{
            color:'blue',
            shape: 'pill',
            label: 'pay'
        },
        createOrder: function(data,actions){
            return actions.order.create({
                purchase_units:[{
                    amount: {
                        value:45
                    }
                }]
            });
        },
        onCancel: function(data){
            alert("Pago Cancelado");
            
        }
    }).render('#paypal-button-container')</script>
                        <div class="d-grid">
                            <a href="index.php" class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" type="submit">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/funciones.js"></script>
</body>
</html>