<?php 

$seccion = isset($_GET['seccion']) ? $_GET['seccion']:'home';

include( '../setup/configuracion.php' );
include( '../setup/funciones.php' );
include( '../setup/arrays.php' );

if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id_fk_tipo'] == 2){
    header('Location: ../index.php?seccion=home&status=errordeacceso');
}

if(!isset($_SESSION['usuario'])) {
    header('Location: ../index.php?seccion=home&status=errordeacceso');
}



?>
<!DOCTYPE HTML>
<html lang="es-AR">
<head>
	<meta charset="UTF-8" />
	<title>Sport Cracks - Parcial Programación II - Julian Preiss - Andres Quintero</title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../recursos/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../recursos/css/estilos.css" />
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
</head>
	<header class="container-fluid bg d-flex justify-content-center">
		<div class="row darkbg">
		<nav class="navbar-expand col-12 d-flex justify-content-center">
			<div class="position-absolute d-flex text-center bg-white border rounded mt-2">
				<!--Creación de la botonera del nav, tomado desde un array con la url de las secciones -->
				<ul class="nav my-3 justify-content-end">
					<?php
						foreach ($menu_panel as $seccion => $url):
					?>
					<li class="nav-item">
						<a class="nav-link active" href='<?= $url ?>'><?= $seccion ?></a>
					</li>

					<?php endforeach; ?>

				</ul>
			</div>
		</nav>
		<div class="col-12 text-center">
			<h1>Sport Cracks - Panel</h1>
		</div>
		
		</div>
	</header>

	
	<main>
	<!-- En esta sección iré cargando el contenido según la sección que quiera acceder el usuario -->
		<?php
			$seccion = $_GET['seccion'] ?? 'productos';

			if (empty($seccion))
				$seccion = 'productos';

			$ruta = 'secciones/' . $seccion . '.php';

			if (file_exists($ruta))
				include($ruta);
			else
				include('secciones/productos.php');
		?>
	</main>
	<footer class="container mt-5">

		<div class="row">
			<div class="col-12 text-center">
				<h2>Navegación</h2>
				<ul class="list-group">
					<li class="list-group-item"><a href="../index.php?seccion=home">Home</a></li>
					<li class="list-group-item"><a href="../index.php?seccion=galeria">Galería</a></li>
					<li class="list-group-item"><a href="../index.php?seccion=contacto">Contacto</a></li>
					<li class="list-group-item"><a href="../index.php?seccion=login">Login</a></li>
					<li class="list-group-item"><a href="../index.php?seccion=registro">Registro</a></li>
				</ul>
						<!-- Botones con link hacia redes sociales -->
				<ul class="bsociales text-center">
				<?php foreach( $redes as $red => $url ){
					echo "<li class='d-inline'><a href='$url'>$red</a></li>";
				} ?>
				</ul>
			</div>
		</div>

		<div class="row">
			<ul class="text-center col-12">
				<li>Copyright &copy; 2021, Sports Cracks</li>
			</ul>
		</div>
	</footer>

	<script src="../recursos/js/jquery.min.js"></script>
	<script src="../recursos/js/bootstrap.bundle.min.js"></script>
</body>
</html>