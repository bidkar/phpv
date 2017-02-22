<?php require 'usuario.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Apache + PHP funciona!</title>
</head>
<body>
    <h1><?php echo 'Apache + PHP funciona!'; ?></h1>
    <?php
    $usuario = new Usuario();
    $usuario->id = 10;
    $usuario->nombre = 'Bidkar';
    ?>
    <!-- table>thead>tr>th*2^tbody>tr>td*2 -->
    <table>
        <thead>
            <tr>
                <th>UserID</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $usuario->id; ?></td>
                <td><?php echo $usuario->nombre; ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>