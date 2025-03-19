<?php
include_once("../config.inc.php");
include_once("acceder_base_datos.php");

$curl = "Location:" . $GLOBALS["raiz_sitio"] . "tienda.php";
if (isset($_GET["id"])) {

  $pconexion = abrirConexion();
  seleccionarBaseDatos($pconexion);
  $cid_producto = $_GET["id"];
  $cquery = "DELETE FROM productos";
  $cquery .= " WHERE id_producto = $cid_producto";
  borrarDatos($pconexion, $cquery);
  cerrarConexion($pconexion);
}
header($curl);
exit();
