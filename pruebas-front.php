<?php
session_start();
$_SESSION['rol_usuario'] = "superadmin";
// $_SESSION['id_cliente'] = 3;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="./backend/controlers/products/gestionar-favoritoDelAdmin-back.php" method="post">
        <!-- <label for="id">ID</label>
        <input type="number" name="id" id=""> -->
        <!-- <label for="id">ID cliente</label>
        <input type="number" name="id_cliente" id=""> -->
        <!-- <label for="medio_pago">Medio de pago</label>
        <input type="text" name="medio_pago" id="medio_pago"> -->
        <!-- <label for="numero_referencia_pago">Número de referencia del pago</label>
        <input type="text" name="numero_referencia_pago" id="numero_referencia_pago"> -->
        <!-- <label for="id_producto">ID producto</label>
        <input type="number" name="id_producto[]" id=""> -->
        <label for="id_producto">ID producto</label>
        <input type="number" name="id_producto" id="">
        <!-- <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad[]" id=""> -->
        <!-- <label for="id_producto">ID producto</label>
        <input type="number" name="id_producto[]" id=""> -->
        <!-- <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad[]" id=""> -->
        <!-- <label for="precio">Precio</label>
        <input type="number" name="precio[]" id="precio"> -->
        <!-- <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre"> -->
        <!-- <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario"> -->
        <!-- <label for="telefono">Teléfono</label>
        <input type="tel" name="telefono" id="telefono"> -->
        <!-- <label for="email">Email</label>
        <input type="text" name="email" id="email"> -->
        <!-- <label for="email_actual">Email actual</label>
        <input type="email" name="email_actual" id="email_actual"> -->
        <!-- <label for="email_nuevo">email nuevo</label>
        <input type="email" name="email_nuevo" id="email_nuevo"> -->
        <!-- <label for="email_confirmacion">Reperir email</label>
        <input type="email" name="email_confirmacion" id="email_confirmacion">  -->
        <!-- <label for="password">Password</label>
        <input type="password" name="password" id=""> -->
        <!-- <label for="password_actual">Contraseña actual</label>
        <input type="password" name="password_actual" id="password_actual"> -->
        <!-- <label for="password_nuevo">Contrasña nueva</label>
        <input type="password" name="password_nuevo" id="password_nuevo"> -->
        <!-- <label for="password_confirmacion">Repetir password</label>
        <input type="password" name="password_confirmacion" id="password_confirmacion"> -->
        <!-- <label for="rol">Rol</label>
        <input type="text" name="rol" id="rol"> -->
        <!-- <label for="rol_actual">Rol actual</label>
        <input type="text" name="rol_actual" id="rol_actual"> -->
        <!-- <label for="rol_nuevo">Rol nuevo</label>
        <input type="text" name="rol_nuevo" id="rol_nuevo"> -->
        <!-- <label for="nombre">Nombre producto</label>
        <input type="text" name="nombre_producto" id="nombre"> -->
        <!-- <label for="descripcion">descripcion</label>
        <input type="text" name="descripcion_producto" id="descripcion"> -->
        <!-- <label for="categoria">categoria</label>
        <input type="text" name="categoria_producto" id="categoria"> -->
        <!-- <label for="codigo_barras">codigo_barras</label>
        <input type="text" name="codigo_barras_producto" id="codigo_barras"> -->
        <!-- <label for="marca">marca</label>
        <input type="text" name="marca_producto" id="marca"> -->
        <!-- <label for="precio">precio</label>
        <input type="number" name="precio_producto" id="precio"> -->
        <!-- <label for="stosk">stock</label>
        <input type="number" name="stock_producto" id="stock"> -->
        <!-- <label for="departamento">Departamento</label>
        <input type="text" name="departamento" id="departamento"> -->
        <!-- <label for="ciudad">Ciudad</label>
        <input type="text" name="ciudad" id="ciudad"> -->
        <!-- <label for="barrio">Barrio</label>
        <input type="text" name="barrio" id="barrio"> -->
        <!-- <label for="direccion_envio">Direccion</label>
        <input type="text" name="direccion_envio" id="envio"> -->
        <!-- <label for="id_venta">Id venta</label>
        <input type="number" name="id_venta" id=""> -->
        <!-- <label for="id_categoria">id</label>
        <input type="number" name="id_categoria" id=""> -->
        <!-- <label for="nombre_categoria">Categoría</label>
        <input type="text" name="nombre_categoria" id=""> -->
        
        <input type="submit" value="Acción">
        
    </form>
</body>
</html>