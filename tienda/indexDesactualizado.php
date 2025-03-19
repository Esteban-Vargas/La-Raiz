<?php
include_once("./functions/listar.php")
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Naturales La Ra&iacute;z</title>
    <link href="styles/style.css" rel="stylesheet"  type="text/css">
  </head>

  <body>
    
    <header class="top-nav-bar">
      <div class="top-nav-bar">

        <!-- Company Logo -->
        
        <img id="company-logo" src="images/laraiz-logo.png" alt="LaRaiz Logo">

        <!-- Navigation Links -->
        <div id="menu">
          <ul class="opciones">
            <li><a href="#" id="news-link">Inicio</a></li>
            <li><a href="#" id="contact-link">Contacto</a></li>
            <li><a href="#" id="store-link">Tienda</a></li>
            <li><a href="#" id="login-link">Cuenta</a></li>
          </ul>
          </div>

        <!-- Menu Logo -->
        <div onclick="toggleSidebar()"><img id="menu-logo" src="images/menu-logo.png"></div>

      </div>
    </header>
    
    <section id="news-section" class="content-section">
      <div id="carousel-container-wrapper">
          <div id="carousel-container" class="carousel" data-carousel>
            <button class="carousel-button prev" data-carousel-button="prev">&#8656;</button>
            <button class="carousel-button next" data-carousel-button="next">&#8658;</button>
            <ul data-slides>
              <li class="slide" data-active>
                <img src="images/laraiz-banner.jpg" alt="Slide 1">
              </li>
              <li class="slide">
                <img src="images/productos-banner.jpg" alt="Slide 2">
              </li>
              <li class="slide">
                <img src="images/progreso-banner.jpg" alt="Slide 3">
              </li>
            </ul>
          </div>
    </section>

    <section id="contact-section" class="content-section">
      <!-- Store content goes here -->
    </section>

    <section id="store-section" class="content-section">
      
      <img id="store-banner" src="images/tienda-banner.jpg">
      <div id="search-field">
        <label for="search-word">Buscar:&nbsp;</label>
        <input id="search-word" type="text" placeholder="Nombre del producto">
      </div>

      <div id="store-container">
        <div id="filter-column">
          <label for="category">Ordenar por:</label>
          <select id="category">

            <optgroup label="Precio:">
              <option value="category1">&nbsp;Mayor a menor</option>
              <option value="category2">&nbsp;Menor a mayor</option>
            </optgroup>
            <optgroup label="Nombre:">
              <option value="category3">&nbsp;A - Z</option>
              <option value="category4">&nbsp;Z - A</option>
            </optgroup>
          </select>    
          <button id="apply-filter">Ordenar</button>
        </div>

        <div id="products-container">
          <div id="products-area"></div>
          <table id="products-table">
            <?php
            echo listarProductos();
            ?>
          </table>
          <img>
          <div id="pagination-container"></div>
        </div>
    
        </div>
      </div>
    </section>

    <section id="login-section" class="content-section">
      <table id="login-table">
        <tr>
          <td>
            <form action="" method="post" name="frm_login">
              <p>Ingrese a su cuenta</p><br>
              <p>Usuario</p>
              <input type="text" name="username"/><br>
              <p>Contraseña</p>
              <input type="password" name="password"/><br>
              <input type="reset" name="btn_limpiar" value="Limpiar">
              <input type="submit" name="btn_ingresar" value="Ingresar">
            </form>
          </td>
        </tr>
      </table>
    </section>
    <script src="functions/script.js"></script>
  </body>
</html>
