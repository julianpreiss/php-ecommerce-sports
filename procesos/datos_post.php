<?php
$errores = []; 

if(empty($_POST['nombre'])){
	$errores['nombre'] = 'El nombre no puede estar vacío';	
}

if(empty($_POST['email'])){
	$errores['email'] = 'El email no puede estar vacío';

}elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	$errores['email'] = 'El email no tiene un formato correcto';
}

if(empty($_POST['mensaje'])){
	$errores['mensaje'] = 'El mensaje no puede estar vacío';	
}

if (count($errores)) {

  	$json_errores = json_encode($errores);

    header("Location: ../index.php?seccion=contacto&status=error&campos=$json_errores");
    exit;
}

$nombre= $_POST['nombre'];
$apellido= $_POST['apellido'];
$email = $_POST['email'];
$mensaje = $_POST['mensaje'];
$categorias_seleccionadas = empty($_POST['categoria']) ? 'No eligió ninguna ' : implode( ', ', $_POST['categoria'] ); 

header('Location:../index.php?seccion=gracias&nombre=' . $nombre . '&apellido=' . $apellido . '&email=' . $email . '&categorias=' . $categorias_seleccionadas . '&mensaje=' . $mensaje);	