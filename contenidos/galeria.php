<section class="container-fluid" id="galeria">
	<div class="row">
		<h2 class="col-12 text-center">Galería</h2>
		<p class="col-12 text-center mt-4">
		<!-- Aplicación de la función para crear fecha de la manera en que la usamos en Argentina, con opción a simplificar el formato-->
		<?php
		echo "Galería actualizada al ";
		echo generar_fecha_por_idioma(16, 5, 2021,true);
		?>
		</p>
	</div>

	<?php

if (isset($_SESSION['errores']) && isset($_SESSION['errores']['producto'])):
?>
	<div class="alert alert-danger fade show mt-2" role="alert">
		<?= $_SESSION['errores']['producto']?>
	</div>
<?php
endif;
?>

<?php

if (isset($_SESSION['errores']) && isset($_SESSION['errores']['id'])):
	?>
	<div class="alert alert-danger fade show mt-2" role="alert">
		<?= $_SESSION['errores']['id']?>
	</div>
<?php
endif;
?>	

<?php
if (isset($_SESSION['errores']) && isset($_SESSION['errores']['comentario'])):
	?>
	<div class="alert alert-danger fade show mt-2" role="alert">
		<?= $_SESSION['errores']['comentario']?>
	</div>
<?php
endif;
?>

	<?php
	if ((!empty($_GET['status']) && $_GET['status'] == 'ok') && (!empty($_GET['accion']) && ($_GET['accion'] == 'agregado'))):
	$accion = $_GET['accion'];
	?>
    <div class="alert alert-success fade show" role="alert">
        El comentario fue <?= $accion ?> exitosamente 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
	<?php
	endif;
	?>

	<?php
	if (!empty($_GET['status']) && $_GET['status'] == 'agregado'):
	?>
    <div class="alert alert-success fade show" role="alert">
        El producto fue agregado exitosamente 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
	<?php
	endif;
	?>

	<?php
	if (!empty($_GET['status']) && $_GET['status'] == 'cantidadactualizada'):
	?>
    <div class="alert alert-success fade show" role="alert">
        El producto fue agregado exitosamente y se ha actulizado la cantidad 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
	<?php
	endif;
	?>	
</section>


<section class="text-center offset-md-1 col-md-10 container mt-3">
	<div class="row">
		<?php

		$select_productos = 'SELECT * FROM productos;';
		$res_select_productos = mysqli_query($cnx, $select_productos);

		while ($productos = mysqli_fetch_assoc($res_select_productos)):
            ?>

			<article class="col-md-4 py-3 border rounded d-sm-block justify-content-center">
				<h3><?php echo $productos['nombre'] ?></h3>
				<figure>
					<div class="row">
						<img class="img-fluid offset-2 col-8" src='<?= RUTA . $productos['img'] ?>' alt="Pelota <?= $productos['nombre'] ?>">
					</div>

					<!--BOTON PARA AGREGAR PRODUCTO AL CARRITO -->
					<?php
					
					if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id_fk_tipo'] == 2) {
					?>
					<form action="procesos/agregar_carrito.php" method="POST" >
						<input type="text" name="idproducto" id="agrega<?= $productos['id_producto'] ?>" value="<?= $productos['id_producto'] ?>" class="d-none">
						<button 
						type="submit" class="btn btn-primary mx-auto d-block px-4 mt-5">Agregar al carrito</button>
					</form>
					<?php }?>
									
					<figcaption class="mt-4">		
						<a class="btn btn-secondary mt-3" data-toggle="collapse" href="#desplegable<?= $productos['id_producto'] ?>" role="button" aria-expanded="false" aria-controls="desplegable<?= $productos['id_producto'] ?>">Caracteristicas</a>

						<div class="collapse" id="desplegable<?= $productos['id_producto'] ?>">	
							<div class="mt-2">
								<ul class="list-unstyled mt-3">
	     			 				<li class="mb-4 "> <span class="h4">Marca:</span> <?= $productos['marca'] ?></li>
	     			 		
	     			 				<li class="my-4 "> <span class="h4">Deporte:</span> <?= $productos['deporte'] ?></li>
	     			 		
	     			 				<li class="my-4 "> <span class="h4">Tamaño:</span> <?= $productos['medidas'] ?></li>
	     			 		
	     			 				<li class="my-4 "> <span class="h4">Color:</span> <?= $productos['color'] ?></li>

	     			 				<li class="my-4 "> <span class="h4">Precio:</span> $<?= $productos['precio'] ?></li>
	     			 			</ul>
							</div>
						</div>
					</figcaption>
				</figure>

				<div class="accordion" id="accordion<?=$productos['id_producto']?>">
					<div class="card border-0">
						<div class="card-header bg-transparent" id="heading<?=$productos['id_producto']?>">
								<button class="btn btn-secondary btn-block text-center" type="button" data-toggle="collapse" data-target="#collapse<?=$productos['id_producto']?>" aria-expanded="false" aria-controls="collapse<?=$productos['id_producto']?>">
								Comentarios
								</button>
						</div>

					    <div id="collapse<?=$productos['id_producto']?>" class="collapse " aria-labelledby="heading<?=$productos['id_producto']?>" data-parent="#accordion<?=$productos['id_producto']?>">
							<div class="card-body">
								<ul class="list-unstyled">
									<?php
										$select_comment = 'SELECT * 
										FROM comentarios
										JOIN usuarios ON id_usuario = id_fk_usuario 
										WHERE id_fk_producto =' . $productos['id_producto'];
										$res_select_comment = mysqli_query($cnx, $select_comment);

										while ($comentario = mysqli_fetch_assoc($res_select_comment)):

									?>
									<li class="border-bottom mt-3">
										<p class="font-weight-bold"><?= $comentario['nombre'] ?></p>
										<p><?= $comentario['comentario'] ?></p>
									</li>
									<?php
										endwhile;
										mysqli_free_result($res_select_comment);
									?>
								</ul>
								<?php if (isset($_SESSION['usuario'])){ ?>
								<form action="procesos/comentarios_proceso.php" method="POST" class="dropdown-item">
									<input type="hidden" name="id" value="<?= $productos['id_producto'] ?>">
									<div class="form-group">
										<label>Dejanos tu comentario</label>
										<textarea class="form-control" name="comentario" id="comentario<?= $productos['id_producto'] ?>" rows="3"></textarea>
										<button type="submit" class="btn btn-primary">Enviar</button>
									</div>
								</form>
								<?php } ?>
							</div>
					    </div>
				    </div>
				</div>
			</article>
		<?php
		endwhile;
		mysqli_free_result($res_select_productos)
		?>
	</div>
</section>

<?= $_SESSION['errores'] = ''; ?>

