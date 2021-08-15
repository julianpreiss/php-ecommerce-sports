<?php
$errores = [];
$idusuario = $_SESSION['usuario']['id_usuario'];

$select_producto = "SELECT id_fk_producto FROM carrito WHERE id_fk_usuario = $idusuario";
$res_select_producto = mysqli_query($cnx, $select_producto);

if (!$res_select_producto->num_rows) {
    $errores['pagar'] = 'No hay productos en el carrito';
    $_SESSION['errores'] = $errores;
    header("Location: index.php?seccion=carrito&status=nohayproductos");
    exit;
}

?>

<section>
    <h2>Checkout</h2>
    <ul>

    </ul>
    <form class="text-center" action="procesos/completarcompra.php">
        <fieldset>
            <legend>Información personal</legend>
            <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" required>
            </div>
            <div class="form-group">
            <label for="celular">Celular</label>
            <input type="tel" id="celular" required>
            </div>
            <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" required> 
            </div>           
        </fieldset>

        <fieldset>            
            <legend>Datos de Entrega</legend>
            <div class="form-group">
            <label for="ciudad">Ciudad</label>
            <input type="text" id="ciudad" required>
            </div>
            <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" id="direccion" required> 
            </div>     
        </fieldset>

        <fieldset>
            <legend>Datos de tarjeta</legend>
            <div class="form-group">
            <label for="numero">Numero de tarjeta</label>
            <input type="number" id="numero" required>
            </div>
            <div class="form-group">
            <label for="caducidad">Fecha de caducidad</label>
            <input type="number" id="caducidad" required> 
            </div>
            <div class="form-group">
            <label for="codigo">Codigo de seguridad</label>
            <input type="number" id="codigo" required> 
            </div>     
        </fieldset>
        <button class="btn btn-primary d-block offset-3 offset-md-4 col-md-4 col-6 px-4 mt-3" type="submit">Confirmar Pago</button>
        <a class="btn btn-secondary d-block offset-3 offset-md-4 col-md-4 col-6 px-4 mt-3" href="index.php?seccion=carrito">Volver atrás</a>
    </form>

</section>