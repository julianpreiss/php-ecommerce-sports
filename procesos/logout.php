<?php

session_start();
session_destroy();

setcookie('usuarioactivo', '', 1, '/');

header("Location: ../index.php?seccion=home");
