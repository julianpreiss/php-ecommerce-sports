<?php
	require_once('../setup/configuracion.php');
	require_once('../setup/funciones.php');

    if (empty($_POST['idproducto']) || empty($_POST['idusuario'])) {
        header("Location: ../index.php?seccion=carrito&status=errorenproceso");
        exit;
    }
    $id_prod_escape = intval($_POST['idproducto']);
    $id_producto = $id_prod_escape;

    $id_usu_escape = intval($_POST['idusuario']);
    $id_usuario = $id_usu_escape;

    $select_prod = "SELECT * FROM carrito WHERE id_fk_producto = $id_producto AND id_fk_usuario = $id_usuario";
    $res_selec = mysqli_query($cnx, $select_prod);
    
    if (!$res_selec->num_rows) {
        header("Location: ../index.php?seccion=carrito&status=errorenprocesox");
        exit;
    }
    
    $delete = "DELETE FROM carrito WHERE id_fk_producto = $id_producto AND id_fk_usuario = $id_usuario";
    $res_delete = mysqli_query($cnx, $delete);
    
    if ($res_delete) {
        header("Location: ../index.php?seccion=carrito&status=ok&accion=eliminado");
    } else {
        header("Location: ../index.php?seccion=carrito&status=errorenproceso");
    }