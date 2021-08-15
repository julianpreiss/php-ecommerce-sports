<?php

	if (isset($_SESSION['errores']) && isset($_SESSION['errores']['usuario'])):
?>
    <div class="alert alert-danger fade show mt-2" role="alert">
        <?= $_SESSION['errores']['usuario']?>
    </div>
<?php
endif;
?>

<?php
if((!empty($_GET['status']) && $_GET['status'] == 'procesorealizado')){
?>
            <div class="alert alert-success text-center fade show" role="alert">
			Ya te enviamos el email para que recuperes la contraseña
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
}?>


<h2 class="col-12 text-center">Tu ecommerce deportivo favorito</h2>

<section class="container mt-3">
	<div class="row mt-3 align-items-center d-flex">
			<div class="col-md-8">
			<h3 class="text-center col-12 py-3">Todo los balones en un solo lugar</h3>
				<p><strong>En Sports Cracks podrás encontrar todos los balones y pelotas deportivas que estás buscando.</strong> Desde Fútbol hasta tenis. Navegá a través de la web y dejate sorprender por la variedad de marcas y modelos que tenemos.</p>
				<p>También <strong>te animamos a que consultes la página a diario</strong>, ya que todas las semanas se lanzan nuevas promociones y sorteos. Asegurate de no perder tu oportunidad de ganar.</p>
				<p>Sports Cracks se caracteriza desde sus inicios por la rápidez con la que ingresa nuevas tecnologías al país. <strong>Siempre somos pioneros en los nuevos modelos de  pelotas</strong> y constantemente trabajamos con clubes deportivos para mejorar la calidad de sus recursos de entrenamiento.</p>
				
			</div>
			<div class="col-md-4">
				​<picture>
					<source media="(max-width: 768px)" srcset="recursos/img/jordan-tablet.jpg">
					<img class="img-fluid" src="recursos/img/jordan.jpg" alt="Michael Jordan ensestando">
				</picture>

			</div>
	</div>	
</section>

<section class="bg-light mt-4 py-3">
	<div class="container">
	<div class="row">
		<h3 class="text-center col-12 py-3">La tecnología de la nueva pelota mundialista de Adidas</h3>
		<p class="text-muted text-center mx-auto">Conocé la historia de la nueva pelota que está por ingresar a nuestro stock</p>
		<div class="offset-md-2 col-md-8 my-3">
		<p>Para diseñar la pelota de la Copa del Mundo tecnológicamente más sofisticada de la historia, Adidas tuvo que remontarse a un tiempo en el que las transmisiones de TV eran en su mayoría en blanco y negro, los balones de fútbol eran de cuero pesado e implacable, y los chips se agregaban a las galletas, no al equipamiento deportivo.</p>

<p>La primera vez que se jugó un partido del Mundial con una pelota Adidas fue en 1970. Los paneles pentagonales en blanco y negro de ese producto, el Telstar Elust, se convirtieron desde entonces en un sinónimo de ese deporte.</p>

<p>Como director de categoría para equipamiento global de fútbol de Adidas, el trabajo de Roland Rommler fue ayudar a recrear ese balón para esta próxima copa en Rusia, añadiendo a la vez avances tecnológicos que habrían sido considerado como ciencia ficción medio siglo atrás.</p>

<p>“Todos nuestros artículos para todas las áreas -cada camiseta y cada bota- tienen una inspiración auténtica”, señaló Rommler. “Desde una perspectiva de marca, quisimos recuperar el producto más auténtico e icónico en el campo de juego, pero con un toque moderno”.</p>

<p>El Telstar 18 es un primo de alta tecnología y similar al balón que cambió para siempre el fútbol. Pero la mayor innovación del nuevo modelo no se observa a simple vista: cada bola está integrada con comunicación de campo cercano (NFC, por sus siglas en inglés), un chip que permite la interacción con la pelota a través de un teléfono inteligente.</p>
<div class="col-12">
					<div id="galeria" class="carousel slide mx-auto my-4" data-ride="carousel">
						<div class="carousel-inner">
						<div class="carousel-item active">
							<picture>
								<source media="(max-width: 576px)" srcset="recursos/img/italia-mobile.jpg">
								<source media="(max-width: 768px)" srcset="recursos/img/italia-tablet.jpg">
								<img class="d-block w-100" src="recursos/img/italia-pc.jpg" alt="Pelota Etrusco">
							</picture>
						</div>
						<div class="carousel-item">
							<picture>
								<source media="(max-width: 576px)" srcset="recursos/img/pelotasmundialistas-mobile.jpg">
								<source media="(max-width: 768px)" srcset="recursos/img/pelotasmundialistas-tablet.jpg">
								<img class="d-block w-100" src="recursos/img/pelotasmundialistas-pc.jpg" alt="Pelotas mundialistas de Adidas">
							</picture>
						</div>
						<div class="carousel-item">
							<picture>
								<source media="(max-width: 576px)" srcset="recursos/img/trespelotas-mobile.jpg">
								<source media="(max-width: 768px)" srcset="recursos/img/trespelotas-tablet.jpg">
								<img class="d-block w-100" src="recursos/img/trespelotas-pc.jpg" alt="Tres pelotas marca Adidas">
							</picture>
						</div>
						</div>
					</div>
				</div>

<p>La tecnología no mide la velocidad, la altura o la curva del balón, pero ello podría ocurrir en una próxima versión. “Este es el primer paso [hacia] el mundo digital”, auguró Rommler.</p>

<p>Un modelo anterior de Adidas, el miCoach Smart Ball, usaba un sensor integrado para registrar el punto de golpe, el giro y la trayectoria, pero ese producto -ya discontinuado- nunca fue lo suficientemente resistente como para ser usado en ligas competitivas.</p>

<p>El Telstar 18 permite a los usuarios algo más que interactuar con el balón dándole un nombre o accediendo a contenido e información exclusivos de esa pelota; es realmente un artículo de equipo deportivo de alto rendimiento.</p>

		</div>
	</div>
	</div>
</section>

<section class="container">
	<h3 class="text-center col-12 py-3">Lo que se viene - nuevo modelo de Nike</h3>
	<div class="row">
		<div class="embed-responsive embed-responsive-16by9 offset-md-2 col-md-8">
			<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/9A24l3dWsp4" allowfullscreen></iframe>
		</div>
		<div class="offset-md-2 col-md-8 my-3">
			<p>Llega el nuevo balón Nike Flight, el gran protagonista de la campaña 20/21, el cual, está listo para echar a rodar en las mejores ligas del mundo. El nuevo balón Flight presenta un llamativo diseño que incluye novedosas tecnologías que marcarán un antes y un después en los terrenos de juego.</p>
			<p>A simple vistazo, lo que llama la atención son los profundos canales que posee en toda la superifice este nuevo modelo de la marca norteamericana. Es una tecnología que surgió hace unos años bajo la denominación Aerowtrac, pero que ahora se desarrolla aun más con la nueva Aerowsculpt. Estas hendiduras proporcionan un ‘camino’ por donde puede viajar el aire, evitando que se pegue a la superficie y logrando un vuelo con la menor distorisión posible (30% menos, según la marca). Parece un argumento de marketing, una mentira, pero son miles de horas de pruebas y muchos ingenieros los que están detrás de un lanzamiento así.</p>
		</div>
	</div>

</section>

<?= $_SESSION['errores'] = ''; ?>