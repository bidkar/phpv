<?php
require '../conexion.php';
require '../usuario.php';

$error = false;

if (isset($_POST['txtUsuario'])) {
    if (isset($_POST['txtPassword'])) {
        $user = $_POST['txtUsuario'];
        $pwd = $_POST['txtPassword'];
        $usuario = Usuario::login($user, $pwd);
        if (!$usuario) {
            $error = true;
        } else {
            // redireccionar a la pagina principal
            // despues de iniciar sesion
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio de sesión</title>
</head>
<body>
    <?php
    if ($error) {
        echo 'Usuario o contraseña incorrectos';
    } ?>
    <form method="post" action="#">
        <label for="txtUsuario">Usuario:</label>
        <input type="text" name="txtUsuario" id="txtUsuario">
        <div class="divider"></div>
        <label for="txtPassword">Contraseña:</label>
        <input type="password" name="txtPassword" id="txtPassword">
        <button type="submit">Iniciar sesión</button>
    </form>
</body>
</html>