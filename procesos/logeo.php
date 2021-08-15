<?php
require_once('../setup/configuracion.php');
require_once('../setup/funciones.php');

$usr_escape = mysqli_real_escape_string($cnx, $_POST['user']);
$select_usr = "SELECT * FROM usuarios WHERE usuario = '$usr_escape'";
$res_usr = mysqli_query($cnx, $select_usr);
$user = mysqli_fetch_assoc($res_usr);

$errores = [];
if(empty($_POST['user'])){
     $errores['user'] = 'El usuario no puede estar vacío';
} elseif(!$res_usr->num_rows) {
    $errores['user'] = 'El usuario incorrecto';
}

if (empty($_POST['pass'])) {
    $errores['pass'] = 'La password no puede estar vacía';
} elseif (!password_verify($_POST['pass'], $user['password'])) {
    $errores['pass'] = 'La password es incorrecta';
}

if (count($errores)) {
    $_SESSION['errores'] = $errores;

    header("Location: ../index.php?seccion=login");
    exit;
}    

unset($user['password']);

$_SESSION['usuario'] = $user;

if (!empty($_POST['recordarme']) && $_POST['recordarme'] == 'true') {
setcookie('usuarioactivo', json_encode($user), strtotime('+30 days'), '/');
}

header("Location: ../index.php?seccion=home");
