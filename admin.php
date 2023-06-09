<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
    <title>Admin</title>
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
        <div class="container ">
            <br/>
            <br/>
            <h3 class="text-center">ADMINISTRACION DE LA TIENDA</h3>
            <br/>
            <br/>
            <br/>
            <div class="row">
                <div class="col-md-9 col-lg-8 mx-auto">
                    <form class="box">
                        <div class="d-grid mb-2" action="insertarJuego.php">
                            <a href="insertarJuego.php" class="btn btn-success"> Insertar juego</a>
                        </div>
                        <br/>
                        <div class="d-grid mb-2" action="modificarJuego.php">
                            <a href="modificarJuego.php" class="btn btn-primary">Administrar Juegos</a>
                        </div>
                        <br/>
                        <div class="d-grid mb-2" action="eliminarJuego.php">
                            <a href="administrarUsuarios.php" class="btn btn-success">Administrar Usuarios</a>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    
</body>
</html>
