<?php
$errores = [];
if (!empty($_GET['campos']))
    $errores = json_decode($_GET['campos']);
?>

<section class="container">

<div class="row">
	<h2 class="col-12 text-center">Contáctanos</h2>
</div>
	<div class="row">
		<div class="col-md-8 offset-md-2 border rounded">
			<p class="text-center mt-2">Completa el formulario y hacenos llegar tu mensaje</p>

			<form  action="procesos/datos_post.php" method="post">
				<div class="form-group">
					<label for="nombre">Nombre (Requerido) </label>
					<input class="form-control" type="text" name="nombre" id="nombre"/>

				    <?php

		            if (isset($errores) && isset($errores->nombre)):
		                ?>
		                <div class="alert alert-danger fade show mt-2" role="alert">
		                    <?= $errores->nombre?>
		                </div>
		            <?php
		            endif;
		            ?>
				</div>
				<div class="form-group">
					<label for="apellido">Apellido </label>
					<input class="form-control" type="text" name="apellido" id="apellido"/>
				</div>
				<div class="form-group">
					<label for="email">Tu Email (Requerido) </label>
					<input class="form-control" type="email" name="email" id="email"/>
				    <?php

			            if (isset($errores) && isset($errores->email)):
			                ?>
			                <div class="alert alert-danger fade show mt-2" role="alert">
			                    <?= $errores->email?>
			                </div>
		            <?php
		            endif;
		            ?>
				</div>

					<div class="form-group">
					<label class="d-block">Recibir novedades </label>
						<?php 
						for($x = 0; $x < count($categorias); $x++ ):
							echo "<label class='form-check-label d-block px-4' for='$categorias[$x]'><input class='form-check-input' type='checkbox' value='$categorias[$x]' id='$categorias[$x]' name='categoria[]' /> $categorias[$x]</label>";
						endfor;
						?>
					</div>
				<div class="form-group">
					<label for="mensaje">Mensaje (Requerido) </label>
					<textarea rows="6" cols="70" name="mensaje" id="mensaje"></textarea>
					<?php

			            if (isset($errores) && isset($errores->mensaje)):
			                ?>
			                <div class="alert alert-danger fade show mt-2" role="alert">
			                    <?= $errores->mensaje?>
			                </div>
		            <?php
		            endif;
		            ?>
				</div>
				<div class="form-group">
					<input class="btn btn-primary" type="submit" value="Enviar mensaje" />
				</div>
			</form>
		</div>
	</div>
</section>
