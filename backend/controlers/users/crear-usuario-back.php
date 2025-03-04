<?php
session_start();
require_once "../../models/usuarios-modelo.php"; 
header('Content-Type: application/json');  

$respuesta = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = ucwords(strtolower(trim($_POST["nombre"])));
    $usuario = trim($_POST["usuario"]);
    $password = trim($_POST["password"]);
    $password_confirmacion = trim($_POST["password_confirmacion"]);
    $passwordHasheada = password_hash($password, PASSWORD_DEFAULT);
    $rol = trim($_POST['rol']);

       // Validar que los campos no estén vací­os
    if (empty($nombre) || empty($usuario) || empty($password) || empty($password_confirmacion) || empty($rol)) {
        $respuesta = [
            "mensaje" => "Hay campo(s) vacío(s) en el formulario.",
            "status" => "error"
        ];
        
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE); 
        // header("Location: formulario-registro-usuario.php");
        exit();
    }


     // Validar que el password de confirmación sea igual al password
    if ($password != $password_confirmacion) {
        $respuesta = [
            "mensaje" => "Las contraseñas no coindicen.",
            "status" => "error"
        ];
        
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  
        // header("Location: formulario-registro-usuario.php");
        exit();
    }


     // Validar que las contraseñas tengan el número de caracteres requerido
    if (strlen($password) < 6 || strlen($password) > 8) {
        $respuesta = [
            "mensaje" => "La contraseña debe tener entre 6 y 8 caracteres.",
            "status" => "error"
        ];
        
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  
        header("Location: formulario-registro-usuario.php");
        exit();
    }


    // Verificar si el usuario ya está registrado
    $objetoUsuarios = new Usuarios();
    $validarUsuario =$objetoUsuarios->validarUsuario($usuario);

    if ($validarUsuario) {
                        
        $respuesta = [
            "mensaje" => "El usuario ya se encuentra registrado.",
            "status" => "error"
        ];
        
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  
        exit();
    }  
    
    $consulta = $objetoUsuarios->crearUsuario($nombre, $usuario, $passwordHasheada, $rol);
        
    if ($consulta === true) {
        $respuesta = [
            "mensaje" => "Usuario registrado con éxito.",
            "status" => "success"
        ];
        
    } else {
        $respuesta = [
            "mensaje" => "Ocurrió un error, no se realizó el registro.",
            "status" => "error"
        ];
    }
     
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  
       
} else {
    echo 'No se recibieron datos';
}
?>
