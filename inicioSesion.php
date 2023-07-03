<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../Tienda_online/CSS/estyls.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
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
</body>
</html>