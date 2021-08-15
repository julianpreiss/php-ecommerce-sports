<?php

if(isset($_SESSION['usuario'])){
$idusuario = $_SESSION['usuario']['id_usuario'];
$select_producto = "SELECT id_fk_producto FROM carrito WHERE id_fk_usuario = $idusuario";
$res_select_producto = mysqli_query($cnx, $select_producto);
}
$total = 0;

?>


<section class="text-center offset-md-1 col-md-10 container mt-3">
    <?php
if (isset($_SESSION['errores']) && isset($_SESSION['errores']['pagar'])):
                    ?>
                    <div class="alert alert-danger fade show mt-2" role="alert">
                        <?= $_SESSION['errores']['pagar']?>
                    </div>
            <?php
            endif;
            ?>
    <h2>Carrito</h2>
    <p>Visualizá todos los artículos agregados a tu carrito</p>
    <?php if(!isset($_SESSION['usuario'])){ ?>
    <p>Para empezar a agregar articulos debes estar registrado y conectado con tu usuario</p>
    <?php } ?>


    <div>
        <?php
        if(isset($_SESSION['usuario'])){
        if (!$res_select_producto->num_rows) {
        ?>
        <p>No hay items agregados al carrito. Podés agregarlos visitando la galería de productos.</p>
        <?php } else {?>
        <span>
            Articulos en carrito:
        </span>
        <ul class="row">
            <?php
            while ($prod_bus = mysqli_fetch_assoc($res_select_producto)) {
                $idprod = $prod_bus["id_fk_producto"];
                $select_displayprod = "SELECT * FROM productos WHERE id_producto = $idprod";
                $res_select_displayprod = mysqli_query($cnx, $select_displayprod);
                $prodindividual = mysqli_fetch_assoc($res_select_displayprod);

                $select_cantidadprod = "SELECT cantidad FROM carrito WHERE id_fk_producto = $idprod AND id_fk_usuario = $idusuario";  
                $res_select_cantidadprod = mysqli_query($cnx, $select_cantidadprod);
                $cantidad = mysqli_fetch_assoc($res_select_cantidadprod); 
            ?>
            	<li class="col-md-3 py-3 border rounded d-sm-block justify-content-center">
                    <h3><?php echo $prodindividual['nombre'] ?></h3>
                    <figure>
                        <div class="row">
                            <img class="img-fluid offset-2 col-8" src='<?= RUTA . $prodindividual['img'] ?>' alt="Pelota <?= $prodindividual['nombre'] ?>">
                        </div>
                        <figcaption class="mt-4">		
						<a class="btn btn-secondary mt-3" data-toggle="collapse" href="#desplegable<?= $prodindividual['id_producto'] ?>" role="button" aria-expanded="false" aria-controls="desplegable<?= $prodindividual['id_producto'] ?>">Caracteristicas</a>

						<div class="collapse" id="desplegable<?= $prodindividual['id_producto'] ?>">	
							<div class="mt-2">
								<ul class="list-unstyled mt-3">
	     			 				<li class="mb-4 "> <span class="h4">Marca:</span> <?= $prodindividual['marca'] ?></li>
	     			 		
	     			 				<li class="my-4 "> <span class="h4">Deporte:</span> <?= $prodindividual['deporte'] ?></li>
	     			 		
	     			 				<li class="my-4 "> <span class="h4">Tamaño:</span> <?= $prodindividual['medidas'] ?></li>
	     			 		
	     			 				<li class="my-4 "> <span class="h4">Color:</span> <?= $prodindividual['color'] ?></li>

	     			 				<li class="my-4 "> <span class="h4">Precio:</span> $<?= $prodindividual['precio'] ?></li>
	     			 			</ul>
							</div>
						</div>
					</figcaption>
                    </figure>
                    <div>
                        <span class="d-block">Unidades</span>
                        <span class="d-block"><?= $cantidad['cantidad'] ?></span>
                        <span class="d-block">Subtotal</span>
                        <?php
                        $subtotal = $cantidad['cantidad'] * $prodindividual['precio'];
                        $total += $subtotal;
                        ?>
                        <span class="d-block">$<?= $subtotal ?></span>
                    </div>
                    <form action="procesos/eliminar_producto_carrito.php" method="POST" >
				    <input type="text" name="idproducto" id="idproducto" value="<?= $idprod ?>" class="d-none">
                    <input type="text" name="idusuario" id="idusuario" value="<?= $idusuario ?>" class="d-none">
					<button 
					type="submit" class="btn btn-primary mx-auto d-block px-4 mt-5">Eliminar producto/s</button>
				</form>
                </li>

            <?php }?>
        </ul>
        <?php }
        }?>      
    </div>
    <?php
    if($total != 0) {
    ?>
    <h3>Total a pagar</h3>
    <span class="h3">$<?= $total ?></span>
    <a href="index.php?seccion=pagar" class="btn btn-primary mx-auto d-block px-4 mt-5">Ir a pagar</a>
    <?php
    }
    ?>
</section>

<?= $_SESSION['errores'] = ''; ?>