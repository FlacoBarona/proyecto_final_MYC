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
                        <div class="d-grid">
                            <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" type="submit" onclick="mostrarPaypal(), ocultarTarjeta() ">PayPal</button>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" type="submit" onclick="ocultarPaypal(), mostrarTarjeta()">Tarjeta de credito</button>
                        </div>
                        <div class="d-grid">
                            <a href="index.php" class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" type="submit">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>