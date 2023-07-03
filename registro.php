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
    $cod = registrar([$correo, $usuario, $clave, $claveConfirma], $con);
    if($cod){
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
    
</body>
</html>