<?php
include_once("acceder_base_datos.php");
function listarProductos()
{

  $ccontenido = "";
  //Conexión con el servidor de base de datos
  $pconexion = abrirConexion();
  //Selección de la base de datos
  seleccionarBaseDatos($pconexion);
  //Construcción de la sentencia SQL
  $cquery = "SELECT productos.descripcion AS Descripcion,";
  $cquery .= " productos.precio AS Precio,";
  $cquery .= " productos.cantidad AS Cantidad,";
  $cquery .= " productos.nombre AS Nombre,";
  $cquery .= " productos.imagen AS Imagen";
  $cquery .= " FROM productos";


  //Se ejecuta la sentencia SQL
  $lresult = mysqli_query($pconexion, $cquery);

  if (!$lresult) {
    $cerror = "No fue posible recuperar la informaci&oacute;n de la base de datos.<br>";
    $cerror .= "SQL: $cquery <br>";
    $cerror .= "Descripci&oacute;n: " . mysqli_connect_error($pconexion);
    die($cerror);
  } else {
    //Verifica que la consulta haya devuelto por lo menos un registro
    if (mysqli_num_rows($lresult) > 0) {
      $cellCount = 0;
      //Recorre los registros arrojados por la consulta SQL
      while ($adatos = mysqli_fetch_array($lresult, MYSQLI_BOTH)) {
        $ccontenido .= "<tr>";
        if ($cellCount % 4 === 0 && $cellCount !== 0) {
          $ccontenido .= "</tr><tr>";
        }
        $ccontenido .= "<td align=\"center\">" . $adatos["Nombre"] . "";
        $ccontenido .= "<br>" . $adatos["Descripcion"];
        $ccontenido .= "<br>\$" . $adatos["Precio"];
        $ccontenido .= "<br>" . $adatos["Cantidad"];
        $ccontenido .= "<br><img src=\"" . $adatos["Imagen"] . "\"></td>";
        $ccontenido .= "</tr>";
        $cellCount++;
      }
    }
  }

  mysqli_free_result($lresult);

  if (empty($ccontenido)) {
    $ccontenido .= "<tr>";
    $ccontenido .= "<td colspan=\"11\">No se obtuvieron resultados</td>";
    $ccontenido .= "</tr>";
  }

  cerrarConexion($pconexion);
  return $ccontenido;
}
