<?php
session_start();
include_once("bd_carrito.php");
function agregarproductoalcarrito($idproducto,$cantidadproducto,$precioproducto,$subproducto,$totalproducto){
    $lafecha=strftime('%Y-%m-%d');
    $idProducto=$idproducto;
    $cantidadProducto=$cantidadproducto;
    $precioProducto=$precioproducto;
    $subproducto=$subproducto;
    $totalProducto=$totalproducto;
    iniciarSesionSiNoEstaIniciada();
    $idSesion = session_id();
    $idCarrito=insertarCarritoVetas($idSesion,$totalproducto,$lafecha);
    for ($i=0; $i < sizeof($idProducto); $i++) {
        $data['productos'] =productoDisponible();
        foreach ($data['productos'] as $produ) {
            $idprodu = $produ['id_producto'];
            if ($produ['id_producto'] == $idProducto[$i]) {
                $menosprodu = $produ['cantidad'] - $cantidadProducto[$i];
                actualizarprodu($idprodu,$menosprodu);
                insertarDetalleCarrito($idCarrito,$idprodu,$precioProducto[$i],$cantidadProducto[$i],$subproducto[$i],$lafecha);
            
            }
        }
    }
    $curl = "Location:".$GLOBALS["raiz_sitio"]."tienda.php";  
    header($curl);
    exit();
}

function insertarCarritoVetas($idSesion,$totalproducto,$lafecha){
    $bd = abrirconexion();
    $operadorSelect = mysqli_query($bd, "INSERT INTO
            carrito_usuarios(
                id_sesion,totalproducto,fecha)
            VALUES ('$idSesion', '$totalproducto', '$lafecha')");
    $resultado=mysqli_insert_id($bd);
    return $resultado;
        
}
function productoDisponible(){
    $bd = abrirConexion();
    $resultado=array();
    $operadorSelect=mysqli_query($bd, "SELECT
            productos.id_producto,
			productos.nombre,
			productos.descripcion,
			productos.precio,
            productos.cantidad,
            productos.imagen
            FROM productos 
            ");
    while($row=mysqli_fetch_array($operadorSelect)){
            $index['id_producto']=$row[0];
            $index['nombre']=$row[1];
            $index['descripcion']=$row[2];
            $index['precio']=$row[3];
            $index['cantidad']=$row[4];
            $index['imagen']=$row[5];
            array_push($resultado,$index);
    }
    return $resultado;
    
}
function insertarDetalleCarrito($idCarrito,$idprodu,$precioProducto,$cantidadProducto,$subproducto,$lafecha){
    $bd = abrirConexion();
    $operadorSelect = mysqli_query($bd, "INSERT INTO
            detallecarritousuario(
                idCarrito_FK,
                idProducto_fk,
                precio,
                cantidad,
                subtotal,
                fecha_registro)
            VALUES ('$idCarrito', '$idprodu', '$precioProducto','$cantidadProducto','$subproducto','$lafecha')");
    
}
function actualizarprodu($idprodu,$menosprodu){
    $bd = abrirConexion();
    $operadorSelect = mysqli_query($bd, "UPDATE productos
            SET cantidad='$menosprodu'
            WHERE productos.id_producto='$idprodu'");
    
    
}
function iniciarSesionSiNoEstaIniciada()
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

$idproducto=$_POST['idproducto'];
$cantidadproducto=$_POST['cantidadproducto'];
$precioproducto=$_POST['precioproducto'];
$subproducto=$_POST['subproducto'];
$totalproducto=$_POST['totalproducto'];
agregarproductoalcarrito($idproducto,$cantidadproducto,$precioproducto,$subproducto,$totalproducto);
?>