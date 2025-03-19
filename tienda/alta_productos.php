<?php
session_start();
error_reporting(0);
$sesion = $_SESSION['nombre_s'];
include_once("./functions/administrar_productos.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productos Naturales La Ra&iacute;z</title>
  <link rel="icon" type="image/x-icon" href="images/laraiz-logo.png" />
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

  <div class="container-fluid px-1 py-5 mx-auto fondoGaleria">
    <div class="row d-flex justify-content-center ">
      <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center ">
        <h1>Registar Producto</h1>
        <p class="text-light">Complete el formulario<br> para registrar un nuevo producto.</p>
        <div class="card  ">
          <form name="frm_agregar" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <p align="center" class="estado"><?php echo agregarProducto(); ?></p>
            <div class="form-row">
              <div class="col-md-4 mb-3">
                <label for="txt_nombre">Nombre</label>
                <input type="text" class="form-control" name="txt_nombre" id="txt_nombre" size="40" value="<?php echo (isset($_POST["txt_nombre"])) ? $_POST["txt_nombre"] : ""; ?>" placeholder="Nombre del producto" required>
              </div>
              <div class="col-md-4 mb-3">
                <label for="txt_cantidad">Cantidad</label>
                <input type="text" class="form-control" name="txt_cantidad" id="txt_cantidad" size="15" value="<?php echo (isset($_POST["txt_cantidad"])) ? $_POST["txt_cantidad"] : ""; ?>" placeholder="Cantidad en almacén" pattern="[1-9]\d*(\.\d+)?" required>
              </div>
              <div class="col-md-4 mb-3">
                <label for="txt_precio">Precio</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="txt_precio" id="txt_precio" size="15" value="<?php echo (isset($_POST["txt_precio"])) ? $_POST["txt_precio"] : ""; ?>" placeholder="Precio en pesos" pattern="\d+(\.\d+)?" required>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-9 mb-3">
                <label for="txt_descripcion">Descripción</label>
                <input type="text" class="form-control" name="txt_descripcion" id="txt_descripcion" size="40" value="<?php echo (isset($_POST["txt_descripcion"])) ? $_POST["txt_descripcion"] : ""; ?>" placeholder="Descripción del producto" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="fl_imagen">Archivo</label>
                <input type="file" class="form-control" id="fl_imagen" name="fl_imagen" accept=".jpg, .jpeg, .png" placeholder="State" required>
              </div>
            </div>
            <input type="submit" class="btn btn-primary" name="btn_grabar" id="btn_grabar" value="Grabar">
            <input type="reset" class="btn btn-danger" name="btn_limpiar" id="btn_limpiar" value="Limpiar">
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="functions/script.js"></script>
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
  <script src="functions/script.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>