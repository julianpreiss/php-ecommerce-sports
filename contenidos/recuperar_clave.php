<?php
if(isset($_SESSION['usuario'])){
    header('Location: index.php?seccion=home');
    exit;
}
if (isset($_SESSION['errores']) && isset($_SESSION['errores']['emailerror'])) {
    ?>

    <div class="alert alert-danger text-center fade show" role="alert">
    <?= $_SESSION['errores']['emailerror']?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

<!-- Este error que está abajo es para el proceso de creacion de clave nueva, solo comprobaremos si ha ocurrido un error y pondremos un mensaje generico para ambos tipos de errores, ya que los unicos errores que se pueden dar son por una mala configuración de los archivos php o porque el usuario intentó manipular los datos enviados por get. En ambos casos no serviría especificar al usuario que fue lo ocurrido.  -->

<?php
} elseif((!empty($_GET['error']))){
?>
            <div class="alert alert-danger text-center fade show" role="alert">
			Ocurrió un error en el proceso de cambio de contraseña, intenta de nuevo más tarde.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<?php
}
?>


<section>
    <form action="procesos/recuperar_clave.php" method="POST" class="p-5 w-50 m-auto">
        <div class="form-group">
            <label for="email" class="font-weight-bold">Ingresá tu email para iniciar el proceso de recuperación de password</label>
            <input type="email" name="email" id="email" class="form-control">
            <?php
            if (isset($_SESSION['errores']) && isset($_SESSION['errores']['email'])):
                ?>
                <div class="alert alert-danger fade show mt-2" role="alert">
                    <?= $_SESSION['errores']['email'] ?>
                </div>
            <?php
            endif;
            unset($_SESSION['errores']);
            ?>
        </div>

        <button type="submit" class="btn btn-primary mx-auto d-block px-4 mt-5">Recuperar</button>

    </form>
</section>

<?= $_SESSION['errores'] = ''; ?>