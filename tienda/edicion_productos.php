<?php
error_reporting(0);
ini_set('display_errors', 0);


include_once("config.inc.php"); 
include_once("./functions/acceder_base_datos.php");
include_once("./functions/administrar_productos.php");
include_once("./functions/editar.php");
session_start();

$sesion = $_SESSION['nombre_s'];
include_once("./functions/administrar_productos.php");

// Verifica si el índice "id_producto" está presente en $_GET
$id_producto = isset($_GET["id"]) ? $_GET["id"] : null;
$adatos = recuperarInfoProducto($id_producto);
?>

<!-- COMENTO ESTILOS Y NAV BAR PARA CHECAR ERRORES-->

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
            
          <?php else : ?>
            
          <?php endif; ?>
        </div>
      </div>  
      <div class="ml-2">
        <?php if (isset($_SESSION['rol_usuario'])) : ?>
          <a class="btn btn-dark" role="button" href="./functions/cerrarSesion.php">Cerrar sesión</a>
        <?php else : ?>
          <a href="login.php" class="btn btn-outline-warning" role="button" aria-pressed="true">Login</a>
        <?php endif; ?>
      </div>
    </nav>
  </header>
<h3 >Modificar producto:</h3>
   <form name="frm_editar" method="post" enctype="multipart/form-data" action="functions/editar.php">
   <input hidden name="hdn_idproducto" value="<?php echo $id_producto; ?>">
  <table align="center">
    <tr>
      <td>Nombre del producto:&nbsp;</b></td>
    </tr>    
    <tr>
            <td><input type="text" name="txt_nombre" id="txt_nombre" size="15" value="<?php echo $adatos["nombre"]; ?>"></td>
         </tr>
         <tr>
      <td>Descripci&oacute;n del producto:</td>
    </tr>
        <tr>
            <td><input type="text" name="txt_descripcion" id="txt_descripcion" size="40" value="<?php echo $adatos["descripcion"]; ?>"></td>
         </tr>
         <tr>
            <td>&nbsp;</td>
         </tr>
    <tr>
      <td>Precio:</td>
    </tr>
    <tr>
            <td><input type="text" name="txt_precio" id="txt_precio" size="15" value="<?php echo $adatos["precio"]; ?>"></td>
         </tr>
         <tr>
            <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Cantidad:</td>
    </tr>
    <tr>
            <td><input type="text" name="txt_cantidad" id="txt_cantidad" size="15" value="<?php echo $adatos["cantidad"]; ?>"></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
    </tr>
    <tr>
        <tr>
            <td>Imagen asociada:&nbsp;<b><?php echo $adatos["imagen"]; ?></b></td>
         </tr>
         <tr>
            <td><input type="file" name="fl_imagen" accept="images/*"></td>
         </tr>
         <tr>
            <td>&nbsp;</td>
    </tr>
    <tr>
            <td align="right"><input type="submit" name="btn_grabar" id="btn_grabar" value="Grabar"></td>
    </tr>
  </table>
</form>
<script src="functions/script.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>