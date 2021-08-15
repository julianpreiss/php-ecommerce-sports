<?php


$usuario = [];
$accion = 'Agregar';
$archivo = 'alta_usuarios_proceso.php';
$user_tipo = '';

if (!empty($_GET['id'])) {
	$id_user_escape = intval($_GET['id']);
    $id_usuario = $id_user_escape;
    $select_usu = "SELECT * 
    FROM usuarios
    WHERE id_usuario=$id_usuario";
    $res_select_usu = mysqli_query($cnx, $select_usu);
    if (!$res_select_usu->num_rows) {
        header('Location: index.php?secciones=usuarios&status=errorenproceso&accion=editado');
        exit;
    }
    $accion = 'Editar';
    $archivo = 'editar_usuarios.php';
    $usuario = mysqli_fetch_assoc($res_select_usu);

    $select_tipo_user = "SELECT id_fk_tipo FROM usuarios WHERE id_usuario = $id_usuario;";
    $res_select_tipo_user = mysqli_query($cnx, $select_tipo_user);
    $tipo_user_res = mysqli_fetch_assoc($res_select_tipo_user);
    $user_tipo = $tipo_user_res['id_fk_tipo'];
    
}
echo mysqli_error($cnx);

$select_tipouser = "SELECT * FROM tipo_usuarios;";
$res_select_tipouser = mysqli_query($cnx, $select_tipouser);
?>

<section class="container border border-warning my-5">

	<div class="row justify-content-center">
		<h2 class="col-12 text-center display-3 my-5"><?= $accion ?> un usuario</h2>

		<form class="col-8" action="procesos/<?= $archivo ?>" method="POST" enctype="multipart/form-data">
			<?php
            if(isset($usuario['id_usuario'])):

            ?>
                <input type="hidden" name="id" value="<?= $usuario['id_usuario'] ?>">
            <?php
            endif;
            ?>

			<div class="form-group">
			    <label for="nombre">Nombre *</label>
			    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresar nombre" value="<?= isset($usuario['nombre']) ? $usuario['nombre'] : '' ?>">
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
				    <label for="apellido">Apellido *</label>
				    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresar la apellido" value="<?= isset($usuario['apellido']) ? $usuario['apellido'] : '' ?>">
				    <small class="form-text text-muted">(*)</small>
				    <?php

				    if (isset($_SESSION['errores']) && isset($_SESSION['errores']['apellido'])):
				        ?>
				        <div class="alert alert-danger fade show mt-2" role="alert">
				            <?= $_SESSION['errores']['apellido']?>
				        </div>
				    <?php
				    endif;
				    ?>
				</div>
				<div class="col-md-6 d-inline-block">
				    <label for="email">Email *</label>
				    <input type="email" class="form-control" id="email" name="email" placeholder="<?= isset($usuario['email']) ? $usuario['email'] : 'Ingresar el mail' ?>">
				    <small class="form-text text-muted">(*)</small>
				    <?php

				    if (isset($_SESSION['errores']) && isset($_SESSION['errores']['email'])):
				        ?>
				        <div class="alert alert-danger fade show mt-2" role="alert">
				            <?= $_SESSION['errores']['email']?>
				        </div>
				    <?php
				    endif;
				    ?>
				</div>
			</div>
		  	<div class="form-group row">
			  	<div class="col-md-6 form-group">
				    <label for="usuario">Usuario *</label>
				    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="<?= isset($usuario['usuario']) ? $usuario['usuario'] : 'Ingresar usuario de la pelota' ?>">
				    <small class="form-text text-muted">(*)</small><?php

		            if (isset($_SESSION['errores']) && isset($_SESSION['errores']['usuario'])):
		                ?>
		                <div class="alert alert-danger fade show mt-2" role="alert">
		                    <?= $_SESSION['errores']['usuario']?>
		                </div>
		            <?php
		            endif;
		            ?>
			  	</div>
			  	<div class="col-md-6 form-group">
				    <label for="password">Password *</label>
				    <input type="password" class="form-control" id="password" name="password" placeholder="<?= isset($usuario['password']) ? 'Ingresa la nueva password' : 'Ingresa la password' ?>" >
				    <small class="form-text text-muted">(*)</small><?php

		            if (isset($_SESSION['errores']) && isset($_SESSION['errores']['password'])):
		                ?>
		                <div class="alert alert-danger fade show mt-2" role="alert">
		                    <?= $_SESSION['errores']['password']?>
		                </div>
		            <?php
		            endif;
		            ?>
			  	</div>
			  	<div class="col-md-6 form-group">
			  		<label for="tipouser">Tipo de usuario</label>
			  		<select name="tipo_user" id="tipouser" class="form-control">
					<?php

					    while ($tipo_user = mysqli_fetch_assoc($res_select_tipouser)):
					        ?>
					        <option value="<?= $tipo_user['id_tipo'] ?>"
					                class=" text-dark"
					            <?= $tipo_user['id_tipo'] == $user_tipo ? 'selected' : '' ?>
					        ><?= $tipo_user['tipo'] ?></option>
				    <?php
				    endwhile;
				    ?>
					</select>
					<?php

		            if (isset($_SESSION['errores']) && isset($_SESSION['errores']['tipo_user'])):
		                ?>
		                <div class="alert alert-danger fade show mt-2" role="alert">
		                    <?= $_SESSION['errores']['tipo_user']?>
		                </div>
		            <?php
		            endif;
		            ?>
			  	</div>
		  	</div>
		  
			<div class="mb-4">
				<button type="submit" class="btn btn-primary">Guardar</button>
				<button type="button" class="btn btn-danger" onclick="location.href='index.php?seccion=usuarios'">Cancelar</button>
			</div>
		</form>

	</div>
</section>

<?= $_SESSION['errores'] = ''; ?>