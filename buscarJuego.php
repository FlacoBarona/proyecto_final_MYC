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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        getData()

        document.getElementById("campo").addEventListener("keyup", getData)

        function getData() {
            let input = document.getElementById("campo").value
            let content = document.getElementById("content")
            let url = "clases/buscar.php"
            let formaData = new FormData()
            formaData.append('campo', input)

            fetch(url, {
                    method: "POST",
                    body: formaData
                }).then(response => response.json())
                .then(data => {
                    content.innerHTML = data
                }).catch(err => console.log(err))
        }
    </script>
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