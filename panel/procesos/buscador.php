<?php
require_once("../../setup/configuracion.php");
require_once("../../setup/funciones.php");

$busqueda = mysqli_real_escape_string($cnx, $_GET['busqueda']);
$busqueda = TRIM($busqueda);

$select_busqueda = "SELECT * 
FROM productos  
WHERE nombre LIKE '%$busqueda%'";
$res_busqueda = mysqli_query($cnx, $select_busqueda);


if ($res_busqueda->num_rows) {
    unset($_SESSION['busqueda']);
    $_SESSION['busqueda']['palabra'] = $_GET['busqueda'];
    while ($prod_bus = mysqli_fetch_assoc($res_busqueda)) {
        $_SESSION['busqueda']['resultados'][] = $prod_bus;
    }

} else {
    $_SESSION['error'] = 'No hay resultados para tu búsqueda';
}

header('Location: ../index.php?seccion=productos');
