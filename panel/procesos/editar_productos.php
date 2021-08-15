<?php
require_once("../../setup/configuracion.php");
require_once("../../setup/funciones.php");
$id = intval($_POST['id']);
$select_prod = "SELECT * 
    FROM productos
    WHERE id_producto=$id";
$res_select_prod = mysqli_query($cnx, $select_prod);
if (!$res_select_prod->num_rows) {
    header('Location: ../index.php?secciones=alta_producto&status=errorenproceso&accion=editado');
    exit;
}

$errores = [];
if (empty($_POST['nombre'])) {
    $errores['nombre'] = 'El nombre no puede estar vacío';

} elseif (strlen($_POST['nombre']) > 80) {
    $errores['nombre'] = 'El nombre puede tener hasta 80 caracteres';
}

if (empty($_POST['marca'])) {
    $errores['marca'] = 'La marca no puede estar vacía';

} elseif (strlen($_POST['marca']) > 20) {
    $errores['marca'] = 'La marca puede tener hasta 20 caracteres';
}

if (empty($_POST['deporte'])) {
    $errores['deporte'] = 'El campo deporte no puede estar vacío';

} elseif (strlen($_POST['deporte']) > 20) {
    $errores['deporte'] = 'El campo deporte puede tener hasta 20 caracteres';
}

if (empty($_POST['medidas'])) {
    $errores['medidas'] = 'Las medidas no pueden estar vacias';

} elseif (strlen($_POST['medidas']) > 20) {
    $errores['medidas'] = 'Las medidas pueden tener hasta 20 caracteres';
}

if (empty($_POST['color'])) {
    $errores['color'] = 'El color no puede estar vacio';

} elseif (strlen($_POST['color']) > 30) {
    $errores['color'] = 'El color puede tener hasta 10 caracteres';
}

if (empty($_POST['precio'])) {
    $errores['precio'] = 'El precio no puede estar vacio';

} elseif (strlen($_POST['precio']) > 8) {
    $errores['precio'] = 'El precio puede tener hasta 8 caracteres';
}

$validacionimg = $_FILES['img'];

if (empty($validacionimg['type'])) {
    $errores['img'] = 'Recordá que la imagen es obligatoria';
}

if (count($errores)) {

    $_SESSION['errores'] = $errores;

    header("Location: ../index.php?seccion=alta_producto&id=$id");
    exit;
}

if (!empty($_FILES['img'])) {

    $img = $_FILES['img'];

    if ($img['type'] != "image/png" && $img['type'] != 'image/jpeg') {
        $errores['img'] = 'Recordá que la imagen es obligatoria y debe ser de tipo .png o .jpg';

        $json_errores = json_encode($errores);
        header("Location: ../index.php?seccion=alta_producto&status=errorenproceso&campos=$json_errores");
        exit;
    }

    if ($img['type'] == "image/png") {
        $extension = 'png';
    } else {
        $extension = 'jpeg';
    }
	
    $funcion = "imagecreatefrom$extension";
    $original = $funcion($img['tmp_name']);

    $nombre_imagen = basename(time() . '.jpg');

	$alto_o = imagesy( $original );
	$ancho_o = imagesx( $original ); 

	$ancho = 500;
	$alto = round( $ancho * $alto_o / $ancho_o );

    $lienzocopia = imagecreatetruecolor( $ancho, $alto );

    imagesavealpha( $lienzocopia, true ); 
    imagealphablending( $lienzocopia, false );


    $nueva_imagen = "../../recursos/img/articulos/" . $nombre_imagen;

    imagecopyresampled($lienzocopia, $original, 0, 0, 0, 0, $ancho, $alto, $ancho_o, $alto_o);

    imagejpeg( $lienzocopia , $nueva_imagen , 80 );

}

$nombre_escape = mysqli_real_escape_string($cnx, $_POST['nombre']);
$nombre = $nombre_escape;

$marca_escape = mysqli_real_escape_string($cnx, $_POST['marca']);
$marca = $marca_escape;

$deporte_escape = mysqli_real_escape_string($cnx, $_POST['deporte']);
$deporte = $deporte_escape;

$medidas_escape = mysqli_real_escape_string($cnx, $_POST['medidas']);
$medidas = $medidas_escape;

$color_escape = mysqli_real_escape_string($cnx, $_POST['color']);
$color = $color_escape;

$precio_escape = mysqli_real_escape_string($cnx, $_POST['precio']);
$precio = $precio_escape;

$img = $nombre_imagen;



$insert = "UPDATE productos SET
nombre='$nombre', marca='$marca', deporte='$deporte', medidas='$medidas', color='$color', img='$img', precio=$precio WHERE id_producto = $id";
$res_insert = mysqli_query($cnx, $insert);

header("Location: ../index.php?seccion=productos&status=ok&accion=editado");
