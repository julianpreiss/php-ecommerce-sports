<?php
	require_once('../setup/configuracion.php');
	require_once('../setup/funciones.php');


if (empty($_POST['email']) || empty($_POST['token'])) {
    $_SESSION['error'] = 'Hubo un error al actualizar la contraseña. Intentalo nuevamente';

    header('Location: ../index.php?seccion=recuperar_clave');
    exit;
}

$email_escape = mysqli_real_escape_string($cnx, $_POST['email']);
$email = $email_escape;
$token_escape = mysqli_real_escape_string($cnx, $_POST['token']);
$token = $token_escape; 

if (empty($_POST['pass'])) {
    $_SESSION['errores']['pass'] = 'La contraseña no puede estar vacía';
}

if (empty($_POST['pass_conf'])) {
    $_SESSION['errores']['pass_conf'] = 'Se tiene que confirmar la contraseña';
}

if ($_POST['pass_conf'] !== $_POST['pass']) {
    $_SESSION['errores']['pass_conf'] = 'Las contraseñas no coinciden';
}
if (isset($_SESSION['errores'])) {
    header("Location: ../index.php?seccion=clave_nueva&email=$email&token=$token");
    exit;
}
$date = date('Y-m-d H:i') . ':00';


$select_user = "SELECT id_usuario FROM usuarios WHERE email = '$email'";
$res_select_user = mysqli_query($cnx, $select_user);

$select_reset = "SELECT email FROM password_resets WHERE email = '$email' AND token = '$token' AND limitetiempo > '$date'";
$res_select_reset = mysqli_query($cnx, $select_reset);

if (!$res_select_user->num_rows || !$res_select_reset->num_rows ) {
    $_SESSION['error'] = 'Hubo un error al actualizar la contraseña. Intentalo nuevamente';

    header("Location: ../index.php?seccion=clave_nueva&email=$email&token=$token");
    exit;
}

$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

$update_pass = "UPDATE usuarios SET password = '$pass' WHERE email = '$email'";
$res_update_pass = mysqli_query($cnx, $update_pass);

if ($res_update_pass) {

    $delete_reset = "DELETE FROM password_resets WHERE email = '$email'";
    $res_delete_reset = mysqli_query($cnx, $delete_reset);

    $_SESSION['ok'] = 'Tu contraseña se actualizó correctamente. Ya podés iniciar sesión';

    header('Location: ../index.php?seccion=login');
}