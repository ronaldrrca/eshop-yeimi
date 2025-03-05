<?php
session_start();
$_SESSION['id_cliente'] = 1;


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="./backend/controlers/clients/actualizar-clientes-back.php" method="post">

        <!-- <label for="id">ID</label> -->
        <input type="number" name="id" id="" value="1" hidden>
        <!-- <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre">
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario"> -->
        <label for="telefono">Teléfono</label>
        <input type="tel" name="telefono" id="telefono">
        <!-- <label for="usuario">Email</label>
        <input type="text" name="email" id="email"> -->
        <label for="email_actual">Email actual</label>
        <input type="email" name="email_actual" id="email_actual">
        <label for="email_nuevo">email nuevo</label>
        <input type="email" name="email_nuevo" id="email_nuevo">
        <label for="email_confirmacion">Reperir email</label>
        <input type="email" name="email_confirmacion" id="email_confirmacion"> 
        <label for="password">Password</label>
        <input type="password" name="password" id="">
        <label for="password_confirmacion">Repetir password</label>
        <input type="password" name="password_confirmacion" id="password_confirmacion">
        <!-- <label for="rol">Rol</label>
        <input type="text" name="rol" id="rol"> -->
        <input type="submit" value="Acción">
    </form>
</body>
</html>