<?php
include( '../setup/configuracion.php' );
include( '../setup/funciones.php' );
require_once('../Mail.php');

$errores = [];
if (empty($_POST['email'])) {
    $errores['emailerror'] = 'El email no puede estar vacío';
    $_SESSION['errores'] = $errores;
    header('Location: ../index.php?seccion=recuperar_clave');
    exit;
}
$email_escape = mysqli_real_escape_string($cnx, $_POST['email']);
$email = $email_escape;
$select_user = "SELECT usuario FROM usuarios WHERE email = '$email'";
$res_select_user = mysqli_query($cnx, $select_user);

if (!$res_select_user->num_rows) {
    $errores['emailerror'] = 'El email es inexistente';
    $_SESSION['errores'] = $errores;
    header('Location: ../index.php?seccion=recuperar_clave');
    exit;
}
$usuario = mysqli_fetch_assoc($res_select_user);
$token = password_hash(time() . $email, PASSWORD_DEFAULT);
$fecha = date('Y-m-d H:i', strtotime('+24 hour'));
$fecha .= ':00';

$insert_pas_reset = "INSERT INTO password_resets SET email = '$email', token = '$token', limitetiempo = '$fecha' ON DUPLICATE KEY UPDATE token = '$token', limitetiempo = '$fecha'";
$res_insert_pas = mysqli_query($cnx, $insert_pas_reset);

$informaciones['email'] = $email;
$informaciones['desde'] = 'info@sportcracks.com';
$informaciones['desde_nombre'] = 'Sport Cracks';
$informaciones['usuario'] = $usuario['usuario'];
$informaciones['asunto'] = 'Recuperacion de la clave';
$informaciones['body'] = "<!doctype html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport'
          content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Recuperar clave</title>
</head>
<body>
<main>
<h1>Restablecer clave</h1>
<p>Hola, como estas? Nos estamos contactando desde Sport Cracks</p>
<p>Se ha recibido una solicitud para reestablecimiento de clave. Para continuar con el proceso por favor ingresa al siguente link</p>
<a href='http://localhost/programacion/index.php?seccion=clave_nueva&email=$email&token=$token'>Recuperar</a>
</main>
</body>
</html>";

new Mail($informaciones);
header('Location: ../index.php?seccion=home&status=procesorealizado');