<?php
session_start();
error_reporting(0);
$sesion = $_SESSION['nombre_s'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="icon" type="image/x-icon" href="images/laraiz-logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="styles/style1.css" rel="stylesheet">
</head>

<body>
    <header id="header">
        <nav class="navbar navbar-expand-lg navbar-dark verde">
            <a class="navbar-brand" href="#" id=cabezera>
                <img src="images/laraiz-logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                LA RAIZ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="index.php">Inicio <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="tienda.php">Tienda en línea</a>
                    <?php if ($_SESSION['rol_usuario'] == 'AD') : ?>
                        <a class="nav-item nav-link" href="tienda.php">Productos naturales</a>
                        <a class="nav-item nav-link" href="alta_productos.php">Agregar Productos</a>
                        <a class="nav-item nav-link" href="mistickets.php">Mis compras</a>
                        <!-- Muestra contenido específico para el rol de administrador -->
                        <!-- ... (código para el rol de administrador) ... -->
                    <?php else : ?>
                        <!-- Muestra contenido específico para otros roles -->
                        <!-- ... (código para otros roles) ... -->
                    <?php endif; ?>
                </div>
            </div>
            <div class="mt-2 mr-5">
                <?php if (isset($_SESSION['rol_usuario'])) : ?>
                    <!-- Si hay una sesión iniciada, muestra el rol del usuario -->
                    <p class="subtituloLogin">Bienvenido, esta iniciado como: <?php echo $_SESSION['rol_usuario']; ?> </p>
                <?php else : ?>
                    <!-- Si no hay una sesión iniciada, muestra el botón de inicio de sesión -->
                <?php endif; ?>
            </div>
            <div class="ml-2">
                <?php if (isset($_SESSION['rol_usuario'])) : ?>
                    <!-- Si hay una sesión iniciada, muestra el rol del usuario -->
                    <a class="btn btn-dark" role="button" href="./functions/cerrarSesion.php">Cerrar sesión</a>
                <?php else : ?>
                    <!-- Si no hay una sesión iniciada, muestra el botón de inicio de sesión -->
                    <a href="login.php" class="btn btn-outline-warning" role="button" aria-pressed="true">Login</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="images/carrusel21.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/carrusel31.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/carrusel11.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="album py-5 bg-body-tertiary fondoGaleria ">
        <div class="container ">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                <div class="col ">
                    <div class="card shadow-sm fondoGaleriaCuadricula">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Nombre de imagen</title>
                            <rect width="100%" height="100%" fill="#D0D3B1" />
                            <text x="50%" y="50%" fill="#000" dy=".3em">textp</text>
                            <image href="images/articulo1.jpg" width="100%" height="100%" />
                        </svg>

                        <div class="card-body">
                            <p class="card-text"> Explora la riqueza de la naturaleza mexicana a través de nuestra
                                selección de productos auténticos. Desde superalimentos hasta hierbas tradicionales, te
                                invitamos a descubrir el poder de la naturaleza para mejorar tu bienestar. Sumérgete en
                                la esencia de México y encuentra tu camino verde.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Leer más</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm fondoGaleriaCuadricula">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Nombre de imagen</title>
                            <rect width="100%" height="100%" fill="#D0D3B1" />
                            <text x="50%" y="50%" fill="#000" dy=".3em">textp</text>
                            <image href="images/articulo2.jpg" width="100%" height="100%" />
                        </svg>
                        <div class="card-body">
                            <p class="card-text">En La Raíz, creemos en el bienestar integral. Descubre artículos que
                                abarcan desde recetas saludables hasta consejos de bienestar mental. Nuestro compromiso
                                es brindarte recursos que nutran todos los aspectos de tu vida. Explora nuestro
                                contenido para inspirarte a vivir de manera equilibrada y consciente.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Leer más</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm fondoGaleriaCuadricula">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Nombre de imagen</title>
                            <rect width="100%" height="100%" fill="#D0D3B1" />
                            <text x="50%" y="50%" fill="#000" dy=".3em">textp</text>
                            <image href="images/articulo3.jpg" width="100%" height="100%" />
                        </svg>
                        <div class="card-body">
                            <p class="card-text">Únete a nosotros en nuestro compromiso con la sostenibilidad. Descubre
                                cómo seleccionamos y producimos nuestros productos de manera ética y sostenible. Desde
                                la elección de ingredientes hasta nuestros empaques, estamos enfocados en reducir
                                nuestro impacto ambiental para así lograr un mejor futuro.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Leer más</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="misionVision">
        <div class="container text-center">
            <h1 id="tituloInterno">
                Visión
            </h1>
            <blockquote class="blockquote text-center">
                <p class="mb-0">En La Raíz, aspiramos a ser la primera elección para aquellos que buscan un estilo de
                    vida
                    saludable y armonioso a través de productos naturales de la más alta calidad. Nos visualizamos como
                    una
                    fuerza impulsora en la promoción de la salud y el bienestar, conectando a las personas con la
                    riqueza de
                    la naturaleza mexicana y sirviendo como catalizadores para un cambio positivo en la forma en que
                    vivimos
                    y nos cuidamos.</p>
            </blockquote>
        </div>
        <div class="container text-center">
            <h1>
                Misión
            </h1>
            <blockquote class="blockquote text-center mb-0">
                <p class="mb-0">Nuestra misión en La Raíz es proporcionar productos naturales auténticos y sostenibles,
                    arraigados en la rica biodiversidad de México. Nos comprometemos a seleccionar con cuidado cada
                    ingrediente, ofreciendo a nuestros clientes soluciones confiables para mejorar su calidad de vida.
                    Buscamos no solo ser proveedores de productos, sino también ser defensores de la salud y la
                    sostenibilidad, guiando a las personas hacia un camino más consciente y equilibrado.</p>
                <br>
            </blockquote>
        </div>
    </div>



    <footer class="text-body-secondary py-5 verde">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#header">Regresar arriba</a>
            </p>
            <p class="mb-1">Lee nuestros términos y condiciones para comprender mejor nuestras políticas.</p>
            <p class="mb-0">Conéctate con nosotros en <a href="/">Facebook</a> o en <a href="../getting-started/introduction/" class="link-warning">Instagram</a>.</p>
        </div>
    </footer>
    <script>
        function cerrarSesion() {
            // Agrega lógica para cerrar la sesión aquí
            // Puedes usar session_destroy() u otras funciones de cierre de sesión
            // Redirecciona a la página de inicio de sesión después de cerrar sesión
            window.location.href = 'login.php';
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>