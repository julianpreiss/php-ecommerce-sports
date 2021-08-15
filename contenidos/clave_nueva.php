<?php
if (empty($_GET['email']) || empty($_GET['token'])) {
    header('Location: index.php?index.php?seccion=recuperar_clave&error=datosvacios');
    exit;
}
$email_escape = mysqli_real_escape_string($cnx, $_GET['email']);
$email = $email_escape;

$token_escape = mysqli_real_escape_string($cnx, $_GET['token']);
$token = $token_escape;

$date = date('Y-m-d H:i') . ':00';
$select_reset = "SELECT email FROM password_resets WHERE email = '$email' AND token = '$token' AND limitetiempo > '$date'";
$res_select_reset = mysqli_query($cnx, $select_reset);

if (!$res_select_reset->num_rows) {
    header('Location: index.php?seccion=recuperar_clave&error=datosinvalidos');
    exit;
}

if (isset($_SESSION['error'])):
    ?>
    <div class="alert alert-danger fade show" role="alert">
        <?= $_SESSION['error'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
endif;
unset($_SESSION['error']);
?>
<section>
    <form action="procesos/cambiar_clave.php" method="POST" class="p-5 w-50 m-auto">
        <input type="hidden" name="email" value="<?= $email ?>">
        <input type="hidden" name="token" value="<?= $token ?>">
        <div class="form-group">
            <label for="pass" class="font-weight-bold">Ingresá tu nueva contraseña</label>
            <input type="password" name="pass" id="pass" class="form-control">
            <?php
            if (isset($_SESSION['errores']) && isset($_SESSION['errores']['pass'])):
                ?>
                <div class="alert alert-danger fade show mt-2" role="alert">
                    <?= $_SESSION['errores']['pass'] ?>
                </div>
            <?php
            endif;
            ?>
        </div>
        <div class="form-group">
            <label for="pass_conf" class="font-weight-bold">Confirmá tu contraseña nueva</label>
            <input type="password" name="pass_conf" id="pass_conf" class="form-control">
            <?php
            if (isset($_SESSION['errores']) && isset($_SESSION['errores']['pass_conf'])):
                ?>
                <div class="alert alert-danger fade show mt-2" role="alert">
                    <?= $_SESSION['errores']['pass_conf'] ?>
                </div>
            <?php
            endif;
            unset($_SESSION['errores']);
            ?>
        </div>

        <button type="submit" class="btn btn-warning mx-auto d-block px-4 mt-5">Cambiar</button>

    </form>
</section>