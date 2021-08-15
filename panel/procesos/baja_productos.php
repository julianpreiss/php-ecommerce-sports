<?php
require_once("../../setup/configuracion.php");
require_once("../../setup/funciones.php");

if (empty($_POST['id'])) {
    header("Location: ../index.php?seccion=productos&status=errorenproceso");
    exit;
}
$id_prod_escape = intval($_POST['id']);
$id_producto_delete = $id_prod_escape;
$select_prod = "SELECT id_producto FROM productos WHERE id_producto=$id_producto_delete";
$res_selec = mysqli_query($cnx, $select_prod);

if (!$res_selec->num_rows) {
    header("Location: ../index.php?seccion=productos&status=errorenproceso");
    exit;
}

$delete = "DELETE FROM productos WHERE id_producto=$id_producto_delete";
$res_delete = mysqli_query($cnx, $delete);

if ($res_delete) {
    header("Location: ../index.php?seccion=productos&status=ok&accion=eliminado");
} else {
    header("Location: ../index.php?seccion=productos&status=errorenproceso");
}