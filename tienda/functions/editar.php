<?php
include_once('../config.inc.php');
include_once("acceder_base_datos.php");


 if ( isset($_POST["btn_grabar"]) && $_POST["btn_grabar"] == "Grabar"){
 
   $pconexion = abrirConexion();
   seleccionarBaseDatos($pconexion);
   
   $cid_producto = $_POST["hdn_idproducto"];
   $cnombre = $_POST["txt_nombre"];
   $cdescripcion = $_POST["txt_descripcion"];
   $cprecio = $_POST["txt_precio"];
   $ccantidad = $_POST["txt_cantidad"];
   echo $cid_producto;
   echo $cnombre;
   echo $cdescripcion;
   echo $cprecio;
   echo $ccantidad;
   if (is_uploaded_file($_FILES["fl_imagen"]["tmp_name"])) {
    $cnombre_imagen = $_FILES["fl_imagen"]["name"];

    $cquery = "UPDATE productos";
    $cquery .= "SET nombre = '$cnombre',";
    $cquery .= "descripcion = '$cdescripcion',";
    $cquery .= "precio = $cprecio,";
    $cquery .= "cantidad = $ccantidad";
    $cquery .= "imagen = '$cnombre_imagen',";
    $cquery .= "WHERE id_producto = $cid_producto";
    echo $cnombre_imagen;
   }
   else{
      $cnombre_imagen = $_FILES["fl_imagen"]["tmp_name"];
      $cquery = "UPDATE productos";
      $cquery .= " SET nombre = '$cnombre',";
      $cquery .= " descripcion = '$cdescripcion',";
      $cquery .= " precio = $cprecio,";
      $cquery .= " cantidad = $ccantidad";
      $cquery .= " WHERE id_producto = $cid_producto";
      echo $cnombre_imagen;
   }   
   
   if (editarDatos($pconexion, $cquery) ){
     $curl = "Location:".$GLOBALS["raiz_sitio"]."tienda.php";  
   }  
   else{
     $curl = "Location:".$GLOBALS["raiz_sitio"]."edicion_productos.php?cid_producto=$cid_producto";	 
   }
    
   cerrarConexion($pconexion);
   header($curl);
   exit();
 }
?>