<?php
if ((!empty($_GET['status']) && $_GET['status'] == 'ok')) {
    ?>
    <div class="alert alert-success fade show text-center" role="alert">
    'Gracias! Ya podés iniciar sesión'
    </div>
<?php
}
?>

<section>
    <form action="procesos/logeo.php" method="POST" class="p-5 w-50 m-auto">
        <div class="form-group">
            <label for="user" class="font-weight-bold">Usuario</label>
            <input type="text" name="user" id="user" class="form-control">
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
            <label for="pass" class="font-weight-bold">Contraseña</label>
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
        <div class="form-group">
            <input type="checkbox" name="recordarme" id="recordarme" value="true">
            <label for="recordarme" class="font-weight-bold">Recordarme</label>
        </div>

        <button type="submit" class="btn btn-primary mx-auto d-block px-4 mt-5">Iniciar sesión</button>

        <small class="mt-4 col-12 text-center">Registrarse
            <a href="index.php?seccion=registro" class="text-primary font-weight-bold">acá</a></small>

        <small class="mt-4 col-12 text-center">Recuperar Clave
            <a href="index.php?seccion=recuperar_clave" class="text-primary font-weight-bold">acá</a></small>

    </form>
</section>

<?= $_SESSION['errores'] = ''; ?>