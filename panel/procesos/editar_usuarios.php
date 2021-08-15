<?php
require_once("../../setup/configuracion.php");
require_once("../../setup/funciones.php");
$id = intval($_POST['id']);
$select_prod = "SELECT * 
    FROM usuarios
    WHERE id_usuario=$id";
$res_select_prod = mysqli_query($cnx, $select_prod);
if (!$res_select_prod->num_rows) {
    header('Location: ../index.php?secciones=alta_usuario&status=errorenproceso&accion=editado');
    exit;
}

$errores = [];
if (empty($_POST['nombre'])){
    $errores['nombre'] = 'El nombre no puede estar vacío';
    
}elseif (strlen($_POST['nombre']) > 80){
    $errores['nombre'] = 'El nombre puede tener hasta 80 caracteres';
}

if (empty($_POST['apellido'])){
        $errores['apellido'] = 'El apellido no puede estar vacío';
} elseif (strlen($_POST['apellido']) > 80){
        $errores['apellido'] = 'El apellido puede tener hasta 80 caracteres';
}

if (!empty($id)) {
    $user_escapado = mysqli_real_escape_string($cnx, $_POST['usuario']);
    $select_user = "SELECT usuario FROM usuarios WHERE usuario = '$user_escapado'";
    $res_select_user = mysqli_query($cnx, $select_user);

    if (strlen($_POST['usuario']) > 60){
        $errores['usuario'] = 'El nombre puede tener hasta 60 caracteres';
    }

}elseif (empty($_POST['usuario'])){
    $errores['usuario'] = 'El usuario no puede estar vacío';

}else{
    $user_escapado = mysqli_real_escape_string($cnx, $_POST['usuario']);
    $select_user = "SELECT usuario FROM usuarios WHERE usuario = '$user_escapado'";
    $res_select_user = mysqli_query($cnx, $select_user); 

    if ($res_select_user->num_rows){
    $errores['usuario'] = 'El usuario ya está registrado';
    } elseif (strlen($_POST['usuario']) > 60){
        $errores['usuario'] = 'El nombre puede tener hasta 60 caracteres';
    }   
}

if (!empty($id)) {
    $email_escapado = mysqli_real_escape_string($cnx, $_POST['email']);
    $select_email = "SELECT email FROM usuarios WHERE email = '$email_escapado'";
    $res_select_email = mysqli_query($cnx, $select_email);

    if (strlen($_POST['email']) > 100){
        $errores['email'] = 'El email puede tener hasta 100 caracteres';
    }

}elseif (empty($_POST['email'])){
    $errores['email'] = 'El email no puede estar vacío';

} else{
    $email_escapado = mysqli_real_escape_string($cnx, $_POST['email']);
    $select_email = "SELECT email FROM usuarios WHERE email = '$email_escapado'";
    $res_select_email = mysqli_query($cnx, $select_email);

    if (strlen($_POST['email']) > 100){
        $errores['email'] = 'El email puede tener hasta 100 caracteres';
    }
}

if (empty($id)){

    if (empty($_POST['password'])){
        $errores['password'] = 'La contraseña no puede estar vacía';
    }elseif (strlen($_POST['password']) < 4){
        $errores['password'] = 'La contraseña debe de tener al menos 4 caracteres';
    }
}

if (empty($_POST['tipo_user'])) {
    $errores['tipo_user'] = 'Seleccione un tipo de usuario';  
}else{
    $tipo_user_escapado = intval($_POST['tipo_user']);
    $select_tipo_user = "SELECT tipo FROM tipo_usuarios WHERE id_tipo = '$tipo_user_escapado'";
    $res_select_tipo_user = mysqli_query($cnx, $select_tipo_user);

    if (!$res_select_tipo_user->num_rows){
        $errores['tipo_user'] = 'No existe ese tipo de usuario';  
    }
}

if (count($errores)) {
    $_SESSION['errores'] = $errores;

    header("Location: ../index.php?seccion=alta_usuario&id=$id&status=errorenproceso");
    exit;
}

$nombre_escape = mysqli_real_escape_string($cnx, $_POST['nombre']);
$nombre = $nombre_escape;

$apellido_escape = mysqli_real_escape_string($cnx, $_POST['apellido']);
$apellido = $apellido_escape;

$usuario = '';
if (empty($_POST['usuario']) && !empty($id)) {
    $select_usu = "SELECT usuario 
    FROM usuarios
    WHERE id_usuario=$id";
    $res_select_usu = mysqli_query($cnx, $select_usu);
    $user = mysqli_fetch_assoc($res_select_usu);
    $usuario = $user['usuario'];
}else{
$usuario_escape = mysqli_real_escape_string($cnx, $_POST['usuario']);
$usuario = $usuario_escape;
}

$email = '';
if (empty($_POST['email']) && !empty($id)) {
    $select_email = "SELECT email 
    FROM usuarios
    WHERE id_usuario=$id";
    $res_select_email = mysqli_query($cnx, $select_email);
    $email_assoc = mysqli_fetch_assoc($res_select_email);
    $email = $email_assoc['email'];
}else{
$email_escape = mysqli_real_escape_string($cnx, $_POST['email']);
$email = $email_escape;
}

$password = '';
if (empty($_POST['password']) && !empty($id)) {
    $select_pass = "SELECT password 
    FROM usuarios
    WHERE id_usuario=$id";
    $res_select_pass = mysqli_query($cnx, $select_pass);
    $pass_assoc = mysqli_fetch_assoc($res_select_pass);
    $password = $pass_assoc['password'];
}else{
$pass_escape = mysqli_real_escape_string($cnx, $_POST['password']);
$password = password_hash($pass_escape, PASSWORD_DEFAULT);
}

$tipo_user_escape = intval($_POST['tipo_user']);
$tipo_user = $tipo_user_escape;

$insert = "UPDATE usuarios SET
nombre='$nombre', apellido='$apellido', usuario='$usuario', email='$email', password='$password', id_fk_tipo='$tipo_user' WHERE id_usuario = $id";
$res_insert = mysqli_query($cnx, $insert);

header("Location: ../index.php?seccion=usuarios&status=ok&accion=editado"); 