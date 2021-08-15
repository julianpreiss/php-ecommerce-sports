<?php
require_once('../setup/configuracion.php');
require_once('../setup/funciones.php');

$errores = [];
if (empty($_POST['nombre'])){
    $errores['nombre'] = 'El nombre no puede estar vacío';
}
elseif (strlen($_POST['nombre']) > 80){
    $errores['nombre'] = 'El nombre puede tener hasta 80 caracteres';
    }

if (empty($_POST['apellido'])){
        $errores['apellido'] = 'El apellido no puede estar vacío';
} elseif (strlen($_POST['apellido']) > 80){
        $errores['apellido'] = 'El apellido puede tener hasta 80 caracteres';
}

if (empty($_POST['user'])){
    $errores['user'] = 'El usuario no puede estar vacío';
} else {
    $user_escape = mysqli_real_escape_string($cnx, $_POST['user']);
    $select_usr = "SELECT usuario FROM usuarios WHERE usuario = '$user_escape'";
    $res_select_usr = mysqli_query($cnx, $select_usr);

    if ($res_select_usr->num_rows){
        $errores['user'] = 'El usuario ya está registrado';
    } elseif (strlen($_POST['user']) > 60)
        $errores['user'] = 'El nombre puede tener hasta 60 caracteres';
}

if (empty($_POST['email'])){
    $errores['email'] = 'El email no puede estar vacío';
} else {
    $email_exist_escape = mysqli_real_escape_string($cnx, $_POST['email']);
    $select_email = "SELECT email FROM usuarios WHERE email = '$email_exist_escape'";
    $res_select_email = mysqli_query($cnx, $select_email);

    if ($res_select_email->num_rows){
        $errores['email'] = 'El email ya está registrado';
    } elseif (strlen($_POST['email']) > 100){
        $errores['email'] = 'El email puede tener hasta 100 caracteres';
    }
}

if (empty($_POST['pass'])){
    $errores['pass'] = 'La contraseña no puede estar vacía';
} elseif (strlen($_POST['pass']) < 4){
    $errores['pass'] = 'La contraseña debe de tener al menos 4 caracteres';
}

$_SESSION['datosform'] = $_POST;

if (count($errores)) {
    $_SESSION['errores'] = $errores;

    header("Location: ../index.php?seccion=registro&status=error");
    exit;
}
$nombre_escape = mysqli_real_escape_string($cnx, $_POST['nombre']);
$nombre = $nombre_escape;

$apellido_escape = mysqli_real_escape_string($cnx, $_POST['apellido']);
$apellido = $apellido_escape;

$usuario_escape = mysqli_real_escape_string($cnx, $_POST['user']);
$usuario = $usuario_escape;

$email_escape = mysqli_real_escape_string($cnx, $_POST['email']);
$email = $email_escape;

$pass_escape = mysqli_real_escape_string($cnx, $_POST['pass']);
$password = password_hash($pass_escape, PASSWORD_DEFAULT);

$insert = "INSERT INTO usuarios (nombre, apellido, email, usuario, password, id_fk_tipo)
VALUES('$nombre', '$apellido', '$email', '$usuario', '$password', 2);";
$res_insert = mysqli_query($cnx, $insert);

if ($res_insert) {
    header('Location: ../index.php?seccion=login&status=ok');
} else {
    header('Location: ../index.php?seccion=registro&status=error');
}
