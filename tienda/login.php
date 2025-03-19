<?php
session_start();
$mensaje = '';
include './config.inc.php';
include './functions/acceder_base_datos.php';

if (!empty($_POST['txt_usuario']) && !empty($_POST['txt_contrasena'])) {

    $conexion =  mysqli_connect("localhost", "root", "", "tienda");

    $correo = $_POST['txt_usuario'];
    $contrasena = $_POST['txt_contrasena'];

    $sql = "SELECT id_usuario,usuario,contrasena,rol FROM usuarios WHERE usuario = '$correo' ";
    $resultado = $conexion->query($sql);
    $numero = $resultado->num_rows;

    if ($numero > 0) {

        //validar contrasenia

        $row = $resultado->fetch_assoc();
        $contra_bd = $row['contrasena'];

        //echo  $contra_bd;

        if ($contra_bd == $contrasena) {

            //iniciando sesion
            $_SESSION['nombre_s'] = $row['usuario'];
            $_SESSION['rol_usuario'] = $row['rol'];

            header("Location: index.php");

            //$mensaje = 'ingresandooo';
        } else {
            $mensaje = '<p class="subtituloLogin">Contraseña invalida</p>';
        }
    } else {
        $mensaje = '<p class="subtituloLogin">Usuario invalido</p>';
    }
}
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
            <div>
                <form class="form-inline">
                    <input class="form-control mr-sm-2" type="search" placeholder="Buscar producto" aria-label="Search">
                    <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
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
    <section class="">
        <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color:#D0D3B1">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h1 class="my-5 display-3 fw-bold ls-tight tituloLogin">
                            LA RAIZ <br />
                        </h1>
                        <h3 class="fw-bold ls-tight subtituloLogin ">
                            <span class="text-se ">¡Bienvenido de nuevo!</span>
                        </h3>
                        <p>
                            En La Raíz, tu conexión con la salud y la naturaleza comienza aquí.
                            Ingresa para explorar un mundo de productos naturales y bienestar.
                        </p>
                    </div>
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card">
                            <div class="card-body py-5 px-md-5" style="background-color: #466362;">


                                <form name="frmAutenticar" action="login.php" method="POST">
                                    <div class="form-outline mb-4">
                                        <input type="text" id="txt_usuario" name="txt_usuario" class="form-control" placeholder="Nombre del usuario" required />
                                        <label class="form-label text-white" for="txt_usuario">Nombre de usuario</label>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="password" id="txt_contrasena" name="txt_contrasena" class="form-control" placeholder="Contraseña" required />
                                        <label class="form-label text-white" for="txt_contrasena">Contraseña</label>
                                    </div>
                                    <?php if (!empty($mensaje)) : ?>
                                        <p> <?= $mensaje ?></p>
                                    <?php endif; ?>
                                    <div class="row mb-4">
                                        <div class="col d-flex justify-content-center">
                                            <input type="submit" class="btn btn btn-warning btn-lg mb-4" name="btnEnviar" id="btnEnviar" value="Enviar">
                                            <input type="reset" class="btn btn btn-danger  btn-lg mb-4 ml-2" name="btnCancelar" id="btnCancelar" value="Cancelar">
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="text-body-secondary py-5 verde">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#header">Regresar arriba</a>
            </p>
            <p class="mb-1">Lee nuestros términos y condiciones para comprender mejor nuestras políticas.</p>
            <p class="mb-0">Conéctate con nosotros en <a href="/">Facebook</a> o en <a href="../getting-started/introduction/" class="link-warning">Instagram</a>.</p>
            <br>
            <br>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>