<?php
	require_once('../setup/configuracion.php');
	require_once('../setup/funciones.php');

$errores = [];

if (empty($_POST['id'])) {
	$errores['id'] = 'El id no puede estar vacío';	
} 
$id_prod_exist_escape = intval($_POST['id']);
$select_prod = "SELECT nombre FROM productos WHERE id_producto = '$id_prod_exist_escape'";
$res_select_prod = mysqli_query($cnx, $select_prod);

if (!$res_select_prod->num_rows){
    $errores['id'] = 'El producto no existe';
}

if(empty($_POST['comentario'])){
	$errores['comentario'] = 'El comentario no puede estar vacío';	
} elseif (strlen($_POST['comentario']) > 250){
        $errores['apellido'] = 'El comentario puede tener hasta 250 caracteres';
}

if (count($errores)) {

    $_SESSION['errores'] = $errores;

    header("Location: ../index.php?seccion=galeria");
    exit;
}
$id_prod_escape = intval($_POST['id']);
$prod = $id_prod_escape;

$usu = $_SESSION['usuario']['id_usuario'];

$comen_escape = mysqli_real_escape_string($cnx, $_POST['comentario']);
$comen = $comen_escape;

$fecha = date("Y-m-d");

$add_comen ="INSERT INTO comentarios (fecha_alta, comentario, id_fk_usuario, id_fk_producto)
VALUES ('$fecha', '$comen', '$usu', '$prod');";
$insert_comen = mysqli_query($cnx, $add_comen);

header("Location: ../index.php?seccion=galeria&status=ok&accion=agregado");