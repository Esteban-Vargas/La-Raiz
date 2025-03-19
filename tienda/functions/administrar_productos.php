<?php 
include_once("acceder_base_datos.php");
//--------------------------------------
function agregarProducto(){
    $cmensaje = "";

    if (isset($_POST["btn_grabar"]) && $_POST["btn_grabar"] == "Grabar") {

        $cnombre = $_POST["txt_nombre"];  // Cambié de txt_descripcion a txt_nombre para reflejar la columna 'nombre' en tu base de datos
        $cdescripcion = $_POST["txt_descripcion"];
        $iprecio = $_POST["txt_precio"];
        $icantidad = $_POST["txt_cantidad"];

        $cnombre_imagen = "sin imagen asociada";
        if (is_uploaded_file($_FILES["fl_imagen"]["tmp_name"])) {
            $cnombre_imagen = $_FILES["fl_imagen"]["name"];
        }

        $pconexion = abrirConexion();
        seleccionarBaseDatos($pconexion);

        $cquery = "SELECT nombre FROM productos";  // Cambié de descripcion a nombre para reflejar la columna 'nombre' en tu base de datos
        $cquery .= " WHERE nombre = '$cnombre'";

        if (!existeRegistro($pconexion, $cquery)) {
            $cquery = "INSERT INTO productos";
            $cquery .= " (nombre, descripcion, precio, cantidad, imagen)";  // Ajusté los nombres de las columnas
            $cquery .= " VALUES ('$cnombre', '$cdescripcion', $iprecio, $icantidad, '$cnombre_imagen')";

            if (insertarDatos($pconexion, $cquery)) {
                $cmensaje = "Producto registrado";
            } else {
                $cmensaje = "No fue posible registrar el producto en el cat&aacute;logo";
            }
        } else {
            $cmensaje = "Ya existe un producto con el nombre: $cnombre";
        }

        cerrarConexion($pconexion);
    }

    return $cmensaje;
}

//--------------------------------------
function recuperarInfoProducto($cid_producto){
 
 $adatos = array();
 
 $pconexion = abrirConexion();
 seleccionarBaseDatos($pconexion);
 
 $cquery = "SELECT nombre, descripcion, precio, cantidad, imagen FROM productos"; 
 $cquery .= " WHERE id_producto = $cid_producto";

 $adatos = extraerRegistro($pconexion, $cquery);
 cerrarConexion($pconexion);
  
 return $adatos;
}
?>