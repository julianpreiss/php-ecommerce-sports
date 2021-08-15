<section class="container">

<div class="row">

<?php 
$categorias_seleccionadas = 'No seleccionó categorias';
if( !empty(  $_GET['categorias']  ) ){
	$categorias_seleccionadas = $_GET['categorias'];
}

$apellido_ingresado = 'No definido';
if( ! empty($_GET['apellido']) ){
	$apellido_ingresado = $_GET['apellido'];
}

$mensaje_ingresado = 'No definido';
if( !empty($_GET['mensaje'])){
	$mensaje_ingresado = $_GET['mensaje'];

} 

$nombre = 'No definido';
if( !empty($_GET['nombre'])){
	$nombre= $_GET['nombre'];
}

$email = 'No definido';
if( !empty($_GET['email'])){
	$email = $_GET['email'];;
}

$mensaje = <<<HTML

<div class="offset-1 col-10 rounded border border-success my-3 text-center">
	<h2 class="bg-primary list-group-item">Contacto desde la web</h2>

	<ul class="list-group">
	<li class="list-group-item">Nombre: $nombre</li>
	<li class="list-group-item">Apellido: $apellido_ingresado</li>
	<li class="list-group-item">Email: $email</li>
	<li class="list-group-item">Categorias seleccionadas: $categorias_seleccionadas</li>
	<li class="list-group-item">Mensaje: $mensaje_ingresado </li>
	</ul>

</div>

HTML;

echo $mensaje;
?>




	</div>
</section>
