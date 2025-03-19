<?php
include_once("acceder_base_datos.php");

function listarProductos()
{
    $productosArray = []; // Inicializar un array para almacenar los productos

    $pconexion = abrirConexion();
    seleccionarBaseDatos($pconexion);

    $cquery = "SELECT productos.descripcion AS Descripcion, productos.id_producto AS Id, productos.precio AS Precio, productos.cantidad AS Cantidad, productos.nombre AS Nombre, productos.imagen AS Imagen FROM productos";
    $wordSearch = "";
    if (isset($_POST["word_search"]) && $_POST["btn_buscar"] == "Buscar"){
        $wordSearch = $_POST['word_search'];
        $cquery .= " WHERE productos.nombre LIKE '%$wordSearch%'";
    }

    $orderBy = "";
    //echo $_POST['order_by'];
    if (isset($_POST['order_by'])) {
        switch ($_POST['order_by']) {
            case 'nombre_asc':
                $cquery .= " ORDER BY productos.nombre ASC";
                break;
            case 'nombre_desc':
                $cquery .= " ORDER BY productos.nombre DESC";
                break;
            case 'precio_asc':
                $cquery .= " ORDER BY productos.precio ASC";
                break;
            case 'precio_desc':
                $cquery .= " ORDER BY productos.precio DESC";
                break;
        }
    }
    
    $lresult = mysqli_query($pconexion, $cquery);

    if (!$lresult) {
        // Manejo de errores
    } else {
        if (mysqli_num_rows($lresult) > 0) {
            $cellCount = 0;
            while ($adatos = mysqli_fetch_array($lresult, MYSQLI_BOTH)) {
                // Crear un array asociativo para cada producto
                $producto = [
                    "Id" => $adatos["Id"],
                    "Nombre" => $adatos["Nombre"],
                    "Descripcion" => $adatos["Descripcion"],
                    "Cantidad" => $adatos["Cantidad"],
                    "Precio" => $adatos["Precio"],
                    "Imagen" => $adatos["Imagen"]
                ];

                // Agregar el producto al array
                $productosArray[] = $producto;

                $cellCount++;
            }
        }
    }

    mysqli_free_result($lresult);
    cerrarConexion($pconexion);

    // Devolver el array de productos
    return $productosArray;
}


function ventana_emergente($id_producto){

}