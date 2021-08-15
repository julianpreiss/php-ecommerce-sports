<?php
$errores = [];
if (!empty($_GET['campos'])) {
    $errores = json_decode($_GET['campos']);
}
?>

<section>
    <form action="procesos/registro.php" method="POST" class="p-5 w-50 m-auto">
        <div class="form-group">
            <label for="nombre" class="font-weight-bold text-primary">Nombre *</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="<?= isset($_SESSION['datosform']) && isset($_SESSION['datosform']['nombre']) ?  $_SESSION['datosform']['nombre'] : ''?>">
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
        <div class="form-group">
            <label for="apellido" class="font-weight-bold text-primary">Apellido *</label>
            <input type="text" name="apellido" id="apellido" class="form-control" value="<?= isset($_SESSION['datosform']) && isset($_SESSION['datosform']['apellido']) ?  $_SESSION['datosform']['apellido'] : ''?>">
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
        <div class="form-group">
            <label for="user" class="font-weight-bold text-primary">Nombre de usuario *</label>
            <input type="text" name="user" id="user" class="form-control" value="<?= isset($_SESSION['datosform']) && isset($_SESSION['datosform']['user']) ?  $_SESSION['datosform']['user'] : ''?>">
		    <?php
            if (isset($_SESSION['errores']) && isset($_SESSION['errores']['user'])):
                ?>
                <div class="alert alert-danger fade show mt-2" role="alert">
                    <?= $_SESSION['errores']['user']?>
                </div>
            <?php
            endif;
            ?>
        </div>
        <div class="form-group">
            <label for="email" class="font-weight-bold text-primary">Email *</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= isset($_SESSION['datosform']) && isset($_SESSION['datosform']['email']) ?  $_SESSION['datosform']['email'] : ''?>">
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

        <div class="form-group">
            <label for="pass" class="font-weight-bold text-primary">Contraseña *</label>
            <input type="password" name="pass" id="pass" class="form-control">
		    <?php
            if (isset($_SESSION['errores']) && isset($_SESSION['errores']['pass'])):
                ?>
                <div class="alert alert-danger fade show mt-2" role="alert">
                    <?= $_SESSION['errores']['pass']?>
                </div>
            <?php
            endif;
            ?>
        </div>

        <button type="submit" class="btn btn-primary mx-auto d-block px-4 mt-5">Registrarse</button>

    </form>
</section>

<?= $_SESSION['errores'] = ''; ?>