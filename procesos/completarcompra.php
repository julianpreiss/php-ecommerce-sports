<?php
include( '../setup/configuracion.php' );
include( '../setup/funciones.php' );

$idusuario = $_SESSION['usuario']['id_usuario'];

$delete_carrito = "DELETE FROM carrito WHERE id_fk_usuario = $idusuario";
$delete = mysqli_query($cnx, $delete_carrito);

header("Location: ../index.php?seccion=home&status=compraok");