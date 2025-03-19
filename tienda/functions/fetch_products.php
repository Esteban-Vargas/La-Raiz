<?php
include_once("acceder_base_datos.php");
$itemsperpage = 24;

$pageNumber = isset($_GET['pageNumber']) ? intval($_GET['pageNumber']) : 1;

// Adjust the query based on your pagination requirements
$offset = ($pageNumber - 1) * $itemsPerPage;
$cquery = "SELECT * FROM productos LIMIT $offset, $itemsPerPage";

// Establish database connection
$pconnector = abrirConexion();
seleccionarBaseDatos($pconnector);

// Fetch products from the database
$lresult = mysqli_query($pconnector, $cquery);
$products = [];

while ($row = mysqli_fetch_assoc($lresult)) {
  $products[] = [
    'nombre' => $row['nombre'],
    'descripcion' => $row['descripcion'],
    'precio' => $row['precio'],
    'cantidad' => $row['cantidad'],
    'imagen' => $row['imagen']
  ];
}

// Close the database connection
cerrarConexion($pconnector);

// Send the products data as JSON
header('Content-Type: application/json');
echo json_encode($products);
?>