<?php
session_start();
error_reporting(0);
$sesion = $_SESSION['nombre_s'];
include_once("./functions/listarBonito.php");
$datos = listarProductos();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
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

            <?php if (isset($_SESSION['rol_usuario'])) : ?>
                <!-- Si hay una sesión iniciada, muestra el rol del usuario -->
                <p class="subtituloLogin">Bienvenido, esta iniciado como: <?php echo $_SESSION['rol_usuario']; ?> </p>
            <?php else : ?>
                <!-- Si no hay una sesión iniciada, muestra el botón de inicio de sesión -->
            <?php endif; ?>
            </div>
            <div>
                <form class="form-inline" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <input class="form-control mr-sm-2" type="search" placeholder="Buscar producto" aria-label="Search" name="word_search" value="<?php echo isset($_POST['word_search']) ? htmlspecialchars($_POST['word_search']) : ''; ?>">
                    <button class="btn btn-success my-2 my-sm-0" type="submit" value="Buscar" name="btn_buscar">Buscar</button>
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
    <section class="py-5">


        <div class="container px-4 px-lg-5 mt-5">
            <button type="button" class="btn btn-info mb-1" data-toggle="modal" data-target="#modalcarrito">Ver carrito</button>
            <?php if (!empty($_SESSION['message'])) : ?>
                <p> <?= $_SESSION['message'] ?></p>
            <?php endif; ?>
            <form class="form-inline" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <select class="form-control" name="order_by" onchange="this.form.submit()">
                    <option value="">Filtrar producto por:</option>
                    <optgroup label="Nombre">
                        <option value="nombre_asc">Ascendente</option>
                        <option value="nombre_desc">Descendente</option>
                    </optgroup>
                    <optgroup label="Precio">
                        <option value="precio_asc">Menor precio</option>
                        <option value="precio_desc">Mayor precio</option>
                    </optgroup>
                </select>
            </form>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php foreach ($datos as $adatos) { ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <img class="card-img-top imagenTienda" src="<?php echo $adatos["Imagen"]; ?>" alt="..." />
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder"><?php echo $adatos["Nombre"]; ?></h5>
                                    <p>Disponibles: <?php echo $adatos["Cantidad"]; ?></p>
                                    <?php echo $adatos["Descripcion"] . ' el id del producto es ' . $adatos["Id"]; ?><br>
                                    <b class="imagenTienda">$<?php echo $adatos["Precio"]; ?></b>
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <button type="button" class="btn btn-warning mt-auto mb-1 mr-1  ml-4" value="Agregar al carrito" onclick="myFunction<?php echo $adatos['Id']; ?>();var e=this;setTimeout(function(){e.disabled=true;},0);return true;">Agregar al carrito</button>
                                <div id="addcart<?php echo $adatos['Id']; ?>" style="display:none;">
                                    <input type="hidden" value="<?php echo $adatos["Id"]; ?>" id="id<?php echo $adatos['Id']; ?>" name="id<?php echo $adatos['Id']; ?>">
                                    <input type="hidden" value="<?php echo $adatos["Nombre"]; ?>" id="name<?php echo $adatos['Id']; ?>" name="name<?php echo $adatos['Id']; ?>">
                                    <input type="hidden" value="<?php echo $adatos["Precio"]; ?>" id="price<?php echo $adatos['Id']; ?>" name="price<?php echo $adatos['Id']; ?>">
                                    <label>Ingrese la cantidad:</label>
                                    <input type="number" value="0" id="quantity<?php echo $adatos['Id']; ?>" name="quantity<?php echo $adatos['Id']; ?>" min="0" max="<?php echo $adatos["Cantidad"]; ?>">
                                    <button onclick="addcarrito<?php echo $adatos['Id']; ?>()" class="btn btn-secondary btn-sm" class="tooltip-test" title="add to cart"><i class="fa fa-shopping-cart"></i> agregar al carrito
                                    </button>
                                </div>
                                <div class="container ml-4">
                                    <button type="button" class="btn btn-success mb-1 " data-toggle="modal" data-target="#modalProducto" data-product-id="<?php echo $adatos["Id"]; ?>">Ver producto</button>
                                    <br>
                                    <?php if ($_SESSION['rol_usuario'] == 'AD') : ?>
                                        <a href="edicion_productos.php?id=<?php echo $adatos["Id"]; ?>">Editar</a>
                                        <a href="functions/borrar.php?id=<?php echo $adatos["Id"]; ?>">Eliminar</a>
                                    <?php else : ?>
                                        <!-- Muestra contenido específico para otros roles -->
                                        <!-- ... (código para otros roles) ... -->
                                    <?php endif; ?>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="modalcarrito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tus productos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="functions/guardarcarrito.php" method="POST">
                        <table class="table" id="MyCart">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#Fol</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Cantidad</th>
                                    <th hidden scope="col">PrecioU</th>
                                    <th scope="col">PrecioT</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="descripcionproductos">

                            </tbody>
                        </table>
                </div>
                <div class="modal-footer">
                    <h5 class="modal-title" id="Total proce">Total:</h5>
                    <h5 class="modal-title" id="totalprice">$0</h5>
                    <input hidden name='totalproducto' id='totalproducto' type='text'>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar </button>
                    <input type="submit" class="btn btn btn-warning btn-lg mb-4" name="btnEnviar" id="btnEnviar" value="Checkout">
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="Informacion Porducto" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header verde">
                    <h1 class="modal-title" id="exampleModalLongTitle">Información de producto</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="detalleProducto">
                    <p>El id del producto que desar ver es <?php echo $adatos['Id']; ?></p>
                    <p>El prico del producto<?php echo $adatos["Precio"]; ?></p>
                    <?php if (isset($_SESSION['rol_usuario'])) : ?>
                        <!-- Si hay una sesión iniciada -->
                        <p class="subtituloLogin">!!!Pocas unidades, obtner la tuya antes de que se acaben¡¡¡</p>

                    <?php else : ?>
                        <!-- Si no hay una sesión iniciada -->
                        <button type="button" class="btn btn-lg btn-danger" data-toggle="popover" title="¿Cómo puedo agregar este producto a mi carrito de compra?" data-content="Para agregar productos a tu carrito de compras es necesario registrarse o iniciar sesión.">Comprar producto</button>
                    <?php endif; ?>
                </div>
                <div class="modal-footer footerModel">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
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
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="popover"]').popover();

        });
        var Total = 0;
        <?php foreach ($datos as $adatos) { ?>

            function myFunction<?php echo $adatos['Id']; ?>() {
                var x = document.getElementById("addcart<?php echo $adatos['Id']; ?>");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }

            function addcarrito<?php echo $adatos['Id']; ?>() {
                var idpro = document.getElementById("id<?php echo $adatos['Id']; ?>");
                var namepro = document.getElementById("name<?php echo $adatos['Id']; ?>").value;
                var pricepro = document.getElementById("price<?php echo $adatos['Id']; ?>");

                var n1 = Number(document.getElementById("price<?php echo $adatos['Id']; ?>").value);
                var n2 = Number(document.getElementById("quantity<?php echo $adatos['Id']; ?>").value);
                var res = n1 * n2;
                Total = Total + res;
                console.log(Total);
                document.getElementById("totalprice").innerHTML = "$" + Total.toFixed(2);
                document.getElementById("totalproducto").value = Total.toFixed(2);
                var mytable = document.getElementById("descripcionproductos");
                var tr = document.createElement("tr")
                tr.setAttribute('id', "lista<?php echo $adatos['Id']; ?>");
                rows = "<th scope='row'><?php echo $adatos['Id']; ?><input hidden name='idproducto[]' id='idproducto' type='text' value='<?php echo $adatos['Id']; ?>'></th><td>" + namepro + "</td><td>" + n2 + "<input hidden name='cantidadproducto[]' id='cantidadproducto' type='text' value=" + n2 + "></td><td hidden>" + n1 + "<input name='precioproducto[]' id='precioproducto' type='text' value=" + n1 + "></td><td>$" + res + '<input hidden name="subproducto[]" id="subprodcuto" type="text" value=' + res + '></td><td id="delete<?php echo $adatos['Id']; ?>"><button type ="button"onclick="delcarrito<?php echo $adatos['Id']; ?>()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"> <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/></svg></button></td>'
                tr.innerHTML = rows;
                mytable.appendChild(tr);
                var x = document.getElementById("addcart<?php echo $adatos['Id']; ?>");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
                x.disabled = true;
            }

            function delcarrito<?php echo $adatos['Id']; ?>() {
                var idpro = document.getElementById("id<?php echo $adatos['Id']; ?>");
                var namepro = document.getElementById("name<?php echo $adatos['Id']; ?>").value;
                var pricepro = document.getElementById("price<?php echo $adatos['Id']; ?>");
                var n1 = Number(document.getElementById("price<?php echo $adatos['Id']; ?>").value);
                var n2 = Number(document.getElementById("quantity<?php echo $adatos['Id']; ?>").value);
                var res = n1 * n2;
                var mytable = document.getElementById("lista<?php echo $adatos['Id']; ?>");
                Total = Total - res;
                document.getElementById("totalprice").innerHTML = "$" + Total.toFixed(2);
                document.getElementById("totalproducto").value = Total.toFixed(2);
                console.log(Total);
                mytable.remove();
            }

        <?php } ?>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>