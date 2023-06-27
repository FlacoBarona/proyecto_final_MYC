<?php
require 'config/configuracion.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT * FROM usuarios");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <style type="text/css">
        #form {
            display: none;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
    <title>Administrar Usuarios</title>
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
            <h2 class="text-center">ADMINISTRACION DE USUARIOS</h2>
            <br/>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Clave</th>
                            <th>Correo</th>
                            <th>Opciones</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($resultado as $row) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['usuario']; ?></td>
                                <td><?php echo $row['clave']; ?></td>
                                <td><?php echo $row['correo']; ?></td>
                                <td><a href="modificarUsuario.php?id=<?php echo $row['id']?>" class="btn btn-primary">Editar</a>  
                                <a href="eliminarUsuario.php?id=<?php echo $row['id']?>" onclick="return confirmarDeleteUsuario()" class="btn btn-success">Borrar</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>

            </div>
            <div class="form-floating mb-3 " >
            <a href="Admin.php" class="btn btn-primary">Atras</a>
            </div>



        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> 
    <script type="text/javascript" src="js/funciones.js"></script>   
</body>
</html>