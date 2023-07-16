<?php

require 'config/database.php';
require './config/Auth.php';
$db = new Database();
$con = $db->conectar();


$errors = [];

if (!empty($_POST)) {
    $correo = trim($_POST['correo']);
    $usuario = trim($_POST['usuario']);
    $clave = trim($_POST['password']);
    $claveConfirma = trim($_POST['passwordConfirmacion']);

    if (esNulo([$correo, $usuario, $clave, $claveConfirma])) {
        $errors[] = "Debe llenar todos los campos";
    }

    if (!esEmail($correo)) {
        $errors[] = "Correo electronico no valido";
    }

    if (!validaClave($clave, $claveConfirma)) {
        $errors[] = "Las claves no coinsiden";
    }

    if (usuarioExiste($usuario, $con)) {
        $errors[] = "El nombre de usuario $usuario ya existe";
    }

    if (count($errors) == 0) {
        $pass = encrypt($clave, $key);
        $cod = registrar([$correo, $usuario, $pass, $pass], $con);
        if ($cod) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      Usuario registrado correctamente
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        }
    } else {
        $errors[] = "Error al registrar el cliente";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/registro.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>SIGN UP</title>
</head>

<body>
    <main>
        <div class="container">
            <?php mostrarMensajes($errors); ?>
            <div class="row">
                <div class="col-lg-10 col-xl-9 mx-auto">
                    <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                        <div class="card-img-left d-none d-md-flex">
                        </div>
                        <div class="card-body p-4 p-sm-5">
                            <h5 class="card-title text-center mb-5 fw-light fs-5">Registrarse</h5>
                            <form action="../Tienda_online/registro.php" method="post">

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="usuario" name="correo" placeholder="myusername" required>
                                    <label for="usuario">Correo electronico</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="myusername" required>
                                    <label for="usuario">Usuario</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    <label for="password">Password</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password" name="passwordConfirmacion" placeholder="Password" required>
                                    <label for="password">Confirme el password</label>
                                </div>

                                <div class="d-grid mb-2">
                                    <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">Registrar</button>
                                </div>

                                <a class="d-block text-center mt-2 small" href="inicioSesion.php">Si tienes una cuenta, entra!</a>

                                <hr class="my-4">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>