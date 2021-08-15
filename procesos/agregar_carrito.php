<?php
include( '../setup/configuracion.php' );
include( '../setup/funciones.php' );

$idusuario = $_SESSION['usuario']['id_usuario'];
$errores = [];

if(!isset($_SESSION['usuario'])) {
    $errores['usuario'] = 'No podés entrar en el panel, no tenés permisos de admin';
    $_SESSION['errores'] = $errores;
    header('Location: ../index.php?seccion=home');
    exit;
}

if (empty($_POST['idproducto'])) {
    $errores['producto'] = 'El producto no fue seleccionado';
    $_SESSION['errores'] = $errores;
    header('Location: ../index.php?seccion=galeria');
    exit;
}

$idproducto_escape = mysqli_real_escape_string($cnx, $_POST['idproducto']);
$idproducto = $idproducto_escape; 

$select_productoexistente = "SELECT cantidad FROM carrito WHERE id_fk_producto = '$idproducto' AND id_fk_usuario = $idusuario";
$res_select_productoexistente = mysqli_query($cnx, $select_productoexistente);

    if ($res_select_productoexistente->num_rows) {
    $cantidad = mysqli_fetch_assoc($res_select_productoexistente);
    $cantidadnumero = $cantidad["cantidad"];
    $cantidadnumero += 1;
    $insert = "UPDATE carrito SET
    cantidad='$cantidadnumero' WHERE id_fk_producto = '$idproducto' AND id_fk_usuario = $idusuario";
    $res_insert = mysqli_query($cnx, $insert);
 
    header("Location: ../index.php?seccion=galeria&status=cantidadactualizada");

    } else {

        $select_producto = "SELECT * FROM productos WHERE id_producto = '$idproducto'";
        $res_select_producto = mysqli_query($cnx, $select_producto);

        if (!$res_select_producto->num_rows) {
            $errores['producto'] = 'Producto inexistente.';
            $_SESSION['errores'] = $errores;
            header('Location: ../index.php?seccion=galeria');
            exit;
        } else {
            $cantidad = 1;
            $insert_producto_carrito = "INSERT INTO carrito SET id_fk_usuario = '$idusuario', id_fk_producto = '$idproducto', cantidad = '$cantidad';";
            $res_insert_pas = mysqli_query($cnx, $insert_producto_carrito);
        }

    header("Location: ../index.php?seccion=galeria&status=agregado");
}




