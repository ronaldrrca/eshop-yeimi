<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="./backend/controlers/clients/registrar-clientes-back.php" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre">
        <label for="telefono">Teléfono</label>
        <input type="tel" name="telefono" id="telefono">
        <label for="usuario">Email</label>
        <input type="text" name="email" id="email">
        <label for="email_confirmacion">Reperir email</label>
        <input type="email" name="email_confirmacion" id="email_confirmacion">
        <label for="password">Password</label>
        <input type="password" name="password" id="">
        <label for="password_confirmacion">Repetir password</label>
        <input type="password" name="password_confirmacion" id="password_confirmacion">
        <input type="submit" value="Login">
    </form>
</body>
</html>