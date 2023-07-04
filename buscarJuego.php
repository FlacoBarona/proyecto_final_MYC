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
    <form action="" method="post">
        <h2>Buscar juego</h2>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="campo" name="campo" placeholder="Ingrese el juego" required>
            <label for="campo">Ingrese el nombre del juego</label>
        </div>
    </form>

    <div class="table-responsive">


        <table class="table">
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Descripcion</td>
                    <td>Precio</td>
                    <td>Descuento</td>
                    <td>Categoria</td>
                    <td>Opcion</td>
                </tr>
            </thead>
            <tbody id="content">

            </tbody>
        </table>

        <div class="row col-2 col-4">
            <a href="index.php" class="btn btn-primary">Atras</a>
        </div>

    </div>

</body>
</html>