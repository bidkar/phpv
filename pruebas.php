<?php
require __DIR__.'/config.php';
require __DIR__.'/app/autoload.php';

use MVC\Models\Rol;

$roles = Rol::getRoles();

var_dump($roles);