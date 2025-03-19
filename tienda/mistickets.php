<?php
include_once("functions/bd_carrito.php");
session_start();
error_reporting(0);
$sesion = $_SESSION['nombre_s'];


iniciarSesionSiNoEstaIniciada();

function iniciarSesionSiNoEstaIniciada()
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}
$idSesion = session_id();

$adatos = recuperarInfoTickets($idSesion);

function recuperarInfoTickets($idSesion){
    $resultado = array();
    $bd = abrirConexion();
    $operadorSelect=mysqli_query($bd, "SELECT
            carrito_usuarios.id,
			carrito_usuarios.id_sesion,
			carrito_usuarios.totalproducto,
			carrito_usuarios.fecha
            FROM carrito_usuarios 
            WHERE carrito_usuarios.id_sesion='$idSesion'
            ");
    while($row=mysqli_fetch_array($operadorSelect)){
            $index['id']=$row[0];
            $index['id_sesion']=$row[1];
            $index['totalproducto']=$row[2];
            $index['fecha']=$row[3];
            array_push($resultado,$index);
    }
    return $resultado;
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
                    <?php if ($_SESSION['rol_usuario'] == 'AD') : ?>
                        <a class="nav-item nav-link" href="productos.html">Productos naturales</a>
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
    
    <div class="album py-5 bg-body-tertiary fondoGaleria ">  
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Fecha compra</th>
                <th scope="col">Total</th>
                <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($adatos as $datos) { ?>
                    <tr>
                    <th scope="row"><?php echo $datos["id"]; ?></th>
                    <td><?php echo $datos["fecha"]; ?></td>
                    <td>$<?php echo $datos["totalproducto"]; ?></td>
                    <td><a href="showticket.php?id=<?php echo $datos["id"]; ?>">Ver detalles</a></td>
                    </tr>
                    <tr>
                <?php } ?>
            </tbody>
        </table>    
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