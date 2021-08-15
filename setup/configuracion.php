<?php 

ini_set('display_errors', true);
error_reporting(E_ALL);
date_default_timezone_set("America/Argentina/Buenos_Aires");

define('RUTA', 'recursos/img/articulos/');

$servidor = 'localhost';
$user = 'root';
$pass = '';
$db = 'sportcracks';
$cnx = mysqli_connect($servidor, $user, $pass, $db);

session_start();
