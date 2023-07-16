<?php
require 'config/database.php';
require 'config/Auth.php';
$db = new Database();
$con = $db->conectar();

$errors = [];

if (!empty($_POST)) {
  $usuario = trim($_POST['usuario']);
  $clave = trim($_POST['password']);


  if (count($errors) == 0) {
    if(strcmp($usuario, 'Admin')==0 && $clave=='admin'){
      $errors[] = inicioSesionAdmin($usuario,$clave,$con);
    }else{
      $errors[] = inicioSesion($usuario, $clave, $con);
    }
    
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../Tienda_online/CSS/estyls.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="CSS/styles.css">
    <title>SIGN IN</title>
</head>
<body>
<div class="container">

<div class="row">
  <div class="col-md-9 col-lg-8 mx-auto">

    <form action="#" method="post" class="caja">
      <h3 class="login-heading mb-4">Login de usuario</h3>
      <?php mostrarMensajes($errors); ?>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" required>
        <label for="usuario">Usuario</label>
      </div>
      <div class="form-floating mb-3">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        <label for="password">Password</label>
      </div>
      <div class="d-grid">
        <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" type="submit">Entrar</button>
        <div class="text-center">
          <a class="small" href="registro.php">Registrate aqui!</a>
        </div>
      </div>
    </form>
  </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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