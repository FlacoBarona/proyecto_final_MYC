<?php
session_start();
require 'config/database.php';

$db = new Database();
$con = $db->conectar();

$id = $_GET['id'];
$sql = $con->prepare("SELECT * FROM usuarios WHERE  id='$id'");
$sql->execute();

$resultado = $sql->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['modificar'])) {
    $id = $_POST['id'];
    $usuario = trim($_POST['usuario']);
    $clave = trim($_POST['clave']);
    $pass = encrypt($clave, $key);
    $correo = trim($_POST['correo']);

    $actualiza = $con->prepare("UPDATE usuarios SET usuario='$usuario', clave='$pass', correo='$correo' WHERE id='$id'");
    $actualiza->execute();
    header("location:administrarUsuarios.php");
}


?>
<!DOCTYPE html>
<html lang="es">

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
        <div class="container">
            <div class="text-center">
                <h2>Modificar Usuarios</h2>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="row">
                        <input type="hidden" name="id" value="<?php echo $resultado['id']; ?>">
                        <input type="text" name="usuario" class="form-control" value="<?php echo $resultado['usuario']; ?>" placeholder="Usuario" required>
                    </div>
                    <div class="row">
                        <input type="text" name="clave" class="form-control" value="<?php echo "".unencrypt($resultado['clave'], $key).""; ?>" placeholder="Clave" required>
                    </div>
                    <div class="row">
                        <input type="text" name="correo" class="form-control" value="<?php echo $resultado['correo']; ?>" placeholder="Correo" required>
                    </div>
                    <br/>
                    <div class="row col-2 col-4">
                        <input type="submit" name="modificar" class="btn btn-success btn-sm btn-block" value="Modificar">
                    </div>
                    <br/>
                    <div class="row col-2 col-4">
                        <a href="administrarUsuarios.php" class="btn btn-primary">Atras</a>
                    </div>
                </form>
            </div>


        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>