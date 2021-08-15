<?php
require_once("../../setup/configuracion.php");
require_once("../../setup/funciones.php");

if (empty($_POST['id'])) {
    header("Location: ../index.php?seccion=usuarios&status=errorenproceso");
    exit;
}
$id_user_escape = intval($_POST['id']);
$id_usuario_delete = $id_user_escape;
$select_usu = "SELECT id_usuario FROM usuarios WHERE id_usuario=$id_usuario_delete";
$res_selec = mysqli_query($cnx, $select_usu);

if (!$res_selec->num_rows) {
    header("Location: ../index.php?seccion=usuarios&status=errorenproceso");
    exit;
}

$delete = "DELETE FROM usuarios WHERE id_usuario=$id_usuario_delete";
$res_delete = mysqli_query($cnx, $delete);

if ($res_delete) {
    header("Location: ../index.php?seccion=usuarios&status=ok&accion=eliminado");
} else {
    header("Location: ../index.php?seccion=usuarios&status=errorenproceso");
}