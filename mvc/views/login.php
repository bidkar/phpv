<?php
require '../models/conexion.php';
require 'app/models/usuario.php';

// validar sesion iniciado
session_start();
if (isset($_SESSION['usuario'])) {
    header('Location:home.php');
}
// fin validacion

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
            $_SESSION['usuario'] = $usuario;
            header('Location:home.php');
        }
    }
}
?>
<?php include_once 'layouts/master.tpl.php'; ?>
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