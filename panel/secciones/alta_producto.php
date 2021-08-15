<?php
$errores = [];
if (!empty($_GET['campos']))
    $errores = json_decode($_GET['campos']);

$producto = [];
$accion = 'Agregar';
$archivo = 'alta_producto_proceso.php';

if (!empty($_GET['id'])) {
	$id_prod_escape = intval($_GET['id']);
    $id_producto = $id_prod_escape;
    $select_prod = "SELECT * 
    FROM productos
    WHERE id_producto=$id_producto";
    $res_select_prod = mysqli_query($cnx, $select_prod);
    if (!$res_select_prod->num_rows) {
        header('Location: index.php?secciones=productos&status=errorenproceso&accion=editado');
        exit;
    }
    $accion = 'Editar';
    $archivo = 'editar_productos.php';
    $producto = mysqli_fetch_assoc($res_select_prod);
}
echo mysqli_error($cnx);
?>

<section class="container border border-warning my-5">

	<div class="row justify-content-center">
		<h2 class="col-12 text-center display-3 my-5"><?= $accion ?> Una nueva pelota</h2>

		<form class="col-8" action="procesos/<?= $archivo ?>" method="POST" enctype="multipart/form-data">
			<?php
            if(isset($producto['id_producto'])):

            ?>
                <input type="hidden" name="id" value="<?= $producto['id_producto'] ?>">
            <?php
            endif;
            ?>

		  <div class="form-group">
		    <label for="nombre">Nombre *</label>
		    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresar nombre" value="<?= isset($producto['nombre']) ? $producto['nombre'] : '' ?>">
		    <small class="form-text text-muted">Obligatorio (*)</small>
		    <?php

            if (isset($_SESSION['errores']) && isset($_SESSION['errores']['nombre'])):
                ?>
                <div class="alert alert-danger fade show mt-2" role="alert">
                    <?= $_SESSION['errores']['nombre']?>
                </div>
            <?php
            endif;
            ?>
		  </div>
		  <div class="form-group row">
		  	<div class="col-md-6 d-inline-block ">	
			    <label for="marca">Marca *</label>
			    <input type="text" class="form-control" id="marca" name="marca" placeholder="Ingresar la marca" value="<?= isset($producto['marca']) ? $producto['marca'] : '' ?>">
			    <small class="form-text text-muted">(*)</small>
			    <?php

	            if (isset($_SESSION['errores']) && isset($_SESSION['errores']['marca'])):
	                ?>
	                <div class="alert alert-danger fade show mt-2" role="alert">
	                    <?= $_SESSION['errores']['marca']?>
	                </div>
	            <?php
	            endif;
	            ?>
			</div>
			<div class="col-md-6 d-inline-block">
			    <label for="deporte">Deporte *</label>
			    <input type="text" class="form-control" id="deporte" name="deporte" placeholder="Ingresar el deporte" value="<?= isset($producto['deporte']) ? $producto['deporte'] : '' ?>">
			    <small class="form-text text-muted">(*)</small>
			    <?php

	            if (isset($_SESSION['errores']) && isset($_SESSION['errores']['deporte'])):
	                ?>
	                <div class="alert alert-danger fade show mt-2" role="alert">
	                    <?= $_SESSION['errores']['deporte']?>
	                </div>
	            <?php
	            endif;
	            ?>
			</div>
		  </div>
		  <div class="form-group row">
		  	<div class="col-md-6 form-group">
			    <label for="medidas">Medidas *</label>
			    <input type="text" class="form-control" id="medidas" name="medidas" placeholder="Ingresar medidas de la pelota" value="<?= isset($producto['medidas']) ? $producto['medidas'] : '' ?>">
			    <small class="form-text text-muted">(*)</small><?php

	            if (isset($_SESSION['errores']) && isset($_SESSION['errores']['medidas'])):
	                ?>
	                <div class="alert alert-danger fade show mt-2" role="alert">
	                    <?= $_SESSION['errores']['medidas']?>
	                </div>
	            <?php
	            endif;
	            ?>
		  	</div>
		  	<div class="col-md-6 form-group">
			    <label for="color">Color *</label>
			    <input type="text" class="form-control" id="color" name="color" placeholder="Ingresa el color" value="<?= isset($producto['color']) ? $producto['color'] : '' ?>">
			    <small class="form-text text-muted">(*)</small><?php

	            if (isset($_SESSION['errores']) && isset($_SESSION['errores']['color'])):
	                ?>
	                <div class="alert alert-danger fade show mt-2" role="alert">
	                    <?= $_SESSION['errores']['color']?>
	                </div>
	            <?php
	            endif;
	            ?>
		  	</div>
		  </div>
		  <div class="form-group row">
		  	<div class="form-group col-md-6">
			    <label for="precio">Precio *</label>
			    <input type="number" class="form-control" id="precio" name="precio" min="0.01" step="0.01" placeholder="Ingresar precio" value="<?= isset($producto['precio']) ? $producto['precio'] : '' ?>">
			    <small class="form-text text-muted">(*)</small><?php

	            if (isset($_SESSION['errores']) && isset($_SESSION['errores']['precio'])):
	                ?>
	                <div class="alert alert-danger fade show mt-2" role="alert">
	                    <?= $_SESSION['errores']['precio']?>
	                </div>
	            <?php
	            endif;
	            ?>
		  	</div>
		  	
		  

		  <div class="col-sm-6">
			<figure class="card shadow border">
				<img src="../recursos/img/articulos/<?= !empty($producto['img']) ? $producto['img'] : 'sin_img.jpg' ?>" alt="<?= !empty($producto['nombre']) ? $producto['nombre'] : 'Producto nuevo' ?>" class=" rounded">
			</figure>

			<div class="input-group mb-3">
			<small class="form-text text-muted">(*)</small>
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroupFileAddon01">Subir</span>
				</div>
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="inputGroupFile01"
							aria-describedby="inputGroupFileAddon01" name="img">
					<label class="custom-file-label text-muted" for="inputGroupFile01">Subí la foto del producto</label>
				</div>
				<?php if (!empty($_GET['id'])) {?>
					<span class="d-block text-muted">
						Recuerda que al editar productos siempre debés seleccionar una nueva imagen o resubir la que el producto ya tenía asignada.
					</span>
				<?php } ?>
				<span class="d-block text-muted">Solo se admiten archivos de extensión .png o .jpg</span>
			</div>

			<?php
			if (isset($_SESSION['errores']['img'])):
				?>
				<div class="alert alert-danger fade show mt-2" role="alert">
					<?= $_SESSION['errores']['img'] ?>
				</div>
			<?php
			endif;
			?>
		</div>

		</div>
		  
		  <div class="mb-4">
		  	<button type="submit" class="btn btn-primary">Guardar</button>
		  	<button type="button" class="btn btn-danger" onclick="location.href='index.php?seccion=productos'">Cancelar</button>
		  </div>
		</form>

	</div>
</section>
<?= $_SESSION['errores'] = ''; ?>