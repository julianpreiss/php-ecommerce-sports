<?php

$cantidad_pp = 5;

$s_pagt = "SELECT COUNT(*) AS total FROM productos;";
$r_pagt = mysqli_query($cnx, $s_pagt);
$pagtotal = mysqli_fetch_assoc($r_pagt);

$pags_totales = ceil($pagtotal['total'] / $cantidad_pp);

$pag_actual = 1;

if (!empty($_GET['pag']) && $_GET['pag'] < 1) {
	$pag_actual = 1;
}elseif (!empty($_GET['pag']) && $_GET['pag'] > $pags_totales) {
	$pag_actual = $pags_totales;
}elseif (!empty($_GET['pag'])) {
	$pag_actual = $_GET['pag'];
}

$pag_ant = $pag_actual - 1;
$pag_sig = $pag_actual + 1;

$inicio = ($cantidad_pp * $pag_actual) - $cantidad_pp;

$s_datos= "SELECT id_producto, nombre, marca, deporte, medidas, color, img, precio 
FROM productos
LIMIT $inicio, $cantidad_pp";

$res_datos = mysqli_query($cnx, $s_datos);

echo mysqli_error($cnx);
?>
<section class="container my-5">

<?php
    		if ((!empty($_GET['status']) && $_GET['status'] == 'ok') &&
        	(!empty($_GET['accion']) && ($_GET['accion'] == 'creado' || $_GET['accion'] == 'eliminado' || $_GET['accion'] == 'editado'))
    		):
        	$accion = $_GET['accion'];
        	?>
	        <div class="alert alert-success fade show" role="alert">
	            El producto fue <?= $accion ?> exitosamente 
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	            </button>
	        </div>
	    <?php
	    elseif ((!empty($_GET['status']) && $_GET['status'] == 'error') && 
	    	(!empty($_GET['accion']) && ($_GET['accion'] == 'creado' || $_GET['accion'] == 'eliminado' || $_GET['accion'] == 'editado'))
	    ):
	    	$accion = $_GET['accion'];
	    ?>
	    <div class="alert alert-success fade show" role="alert">
	            El producto no pudo ser <?= $accion ?>. 
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	            </button>
	    </div>
	    <?php
	     endif;
	    ?>
		
		<a href="index.php?seccion=alta_producto" class="col-12 btn btn-primary float-center my-2">Agregar nuevo producto</a>
		<form action="procesos/buscador.php" method="GET">
        <label for="busqueda" class="sr-only">Buscador</label>
        <input type="text" class="text-black-50" name="busqueda" id="busqueda" placeholder="Buscar producto" value="<?= isset($_SESSION['busqueda']) ? $_SESSION['busqueda']['palabra'] : '' ?>">

        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

<table class="table table-bordered table-dark table-responsive">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Marca</th>
			<th>Deporte</th>
			<th>Medidas</th>
			<th>Color</th>
			<th>Precio</th>
			<th>Acciones</th>
		</tr>
	</thead>

            <tbody>

            <?php
            if (isset($_SESSION['busqueda'])) {
                foreach ($_SESSION['busqueda']['resultados'] as $datos) {
                    ?>
		<tr>
			<td><?= $datos['id_producto'] ?></td>
			<td><?= $datos['nombre'] ?></td>
			<td><?= $datos['marca'] ?></td>
			<td><?= $datos['deporte'] ?></td>
			<td><?= $datos['medidas'] ?></td>
			<td><?= $datos['color'] ?></td>
			<td><?= $datos['precio'] ?></td>
			<td class="text-center">
				<div class="dropdown">
				    <button class="btn btn-primary dropdown-toggle" type="button"
				            id="<?=$datos['id_producto']?>" data-toggle="dropdown"
				            aria-haspopup="true"
				            aria-expanded="false">
				        Acciones
				    </button>
				    <div class="dropdown-menu text-center" aria-labelledby="<?=$datos['id_producto']?>">
				        <a class="btn btn-warning" href="index.php?seccion=alta_producto&id=<?= $datos['id_producto'] ?>">Editar</a>
				        <form action="procesos/baja_productos.php" method="POST"
				              class="dropdown-item">
				            <input type="hidden" name="id" value="<?= $datos['id_producto'] ?>">
				            <input type="submit" value="Eliminar" class="btn btn-danger">
				        </form>
				    </div>
				</div>
			</td>
		</tr>
                    <?php
                }
            } else {

		while ($datos = mysqli_fetch_assoc($res_datos)):
	?>
		<tr>
			<td><?= $datos['id_producto'] ?></td>
			<td><?= $datos['nombre'] ?></td>
			<td><?= $datos['marca'] ?></td>
			<td><?= $datos['deporte'] ?></td>
			<td><?= $datos['medidas'] ?></td>
			<td><?= $datos['color'] ?></td>
			<td><?= $datos['precio'] ?></td>
			<td class="text-center">
				<div class="dropdown">
				    <button class="btn btn-primary dropdown-toggle" type="button"
				            id="<?=$datos['id_producto']?>" data-toggle="dropdown"
				            aria-haspopup="true"
				            aria-expanded="false">
				        Acciones
				    </button>
				    <div class="dropdown-menu text-center" aria-labelledby="<?=$datos['id_producto']?>">
				        <a class="btn btn-warning" href="index.php?seccion=alta_producto&id=<?= $datos['id_producto'] ?>">Editar</a>
				        <form action="procesos/baja_productos.php" method="POST"
				              class="dropdown-item">
				            <input type="hidden" name="id" value="<?= $datos['id_producto'] ?>">
				            <input type="submit" value="Eliminar" class="btn btn-danger">
				        </form>
				    </div>
				</div>
			</td>
		</tr>
	<?php
		endwhile;
		mysqli_free_result($res_datos);
	}
	?>
	</tbody>
</table>

<nav aria-label="Navegación de productos" class="d-flex col-12 justify-content-center">
	    <ul class="pagination">
	        <li class="page-item <?= $pag_ant < 1 ? 'disabled' : '' ?>">
	            <a class="page-link" href="index.php?seccion=eventos&pag=<?= $pag_ant ?>" aria-label="Anterior">
	                <span aria-hidden="true">&laquo;</span>
	            </a>
	        </li>
	        <?php
	        for ($i = 1; $i <= $pags_totales; $i++):
	            ?>
	            <li class="page-item"><a class="page-link" href="index.php?seccion=eventos&pag=<?= $i ?>"><?= $i ?></a></li>
	        <?php
	        endfor;
	        ?>
	        <li class="page-item <?= $pag_sig > $pags_totales ? 'disabled' : '' ?>">
	            <a class="page-link" href="index.php?seccion=eventos&pag=<?= $pag_sig ?>" aria-label="Siguiente">
	                <span aria-hidden="true">&raquo;</span>
	            </a>
	        </li>
	    </ul>
	</nav>

</section>