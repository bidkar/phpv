<?php
require 'conexion.php';
require 'usuario.php';

// se reciben los parametros del formulario
$user = 'bidkar';
$pwd = '1234';

$usuario = Usuario::login($user, $pwd);
var_dump($usuario);