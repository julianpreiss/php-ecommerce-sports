<?php
$s_usuario= 'SELECT id_usuario, nombre, apellido, email, usuario, tipo  
FROM usuarios
JOIN tipo_usuarios ON id_tipo = id_fk_tipo;';
$res_usuario= mysqli_query($cnx, $s_usuario);
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
	            El usuario fue <?= $accion ?> exitosamente 
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	            </button>
	        </div>
	    <?php
	    elseif ((!empty($_GET['status']) && $_GET['status'] == 'errorenproceso') && 
	    	(!empty($_GET['accion']) && ($_GET['accion'] == 'creado' || $_GET['accion'] == 'eliminado' || $_GET['accion'] == 'editado'))
	    ):
	    	$accion = $_GET['accion'];
	    ?>
	    <div class="alert alert-danger fade show" role="alert">
	            El usuario no pudo ser <?= $accion ?>. 
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	            </button>
	    </div>
	    <?php
	     endif;
	    ?>

	<div class="row">
		<h2 class="col-12 text-center display-3 my-5">Panel de usuarios</h2>
		
		<a href="index.php?seccion=alta_usuario" class="col-12 btn btn-primary float-center my-2">Agregar nuevo usuario</a>
		
		<table class="table table-bordered table-dark table-responsive">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Email</th>
					<th>Usuario</th>
					<th>Tipo de usuario</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			<?php
				while ($usuario = mysqli_fetch_assoc($res_usuario)):
			?>
				<tr>
					<td><?= $usuario['id_usuario'] ?></td>
					<td><?= $usuario['nombre'] ?></td>
					<td><?= $usuario['apellido'] ?></td>
					<td><?= $usuario['email'] ?></td>
					<td><?= $usuario['usuario'] ?></td>
					<td><?= $usuario['tipo'] ?></td>
					<td class="text-center">
						<div class="dropdown">
						    <button class="btn btn-primary dropdown-toggle" type="button"
						            id="<?= $usuario['id_usuario'] ?>" data-toggle="dropdown"
						            aria-haspopup="true"
						            aria-expanded="false">
						        Acciones
						    </button>
						    <div class="dropdown-menu text-center" aria-labelledby="<?= $usuario['id_usuario'] ?>">
						        <a class="btn btn-warning" href="index.php?seccion=alta_usuario&id=<?= $usuario['id_usuario'] ?>">Editar</a>
						        <form action="procesos/baja_usuarios.php" method="POST"
						              class="dropdown-item">
						            <input type="hidden" name="id" value="<?= $usuario['id_usuario'] ?>">
						            <input type="submit" value="Eliminar" class="btn btn-danger">
						        </form>
						    </div>
						</div>
					</td>
				</tr>
			<?php
				endwhile;
				mysqli_free_result($res_usuario);
			?>
			</tbody>
		</table>
	</div>	
</section>