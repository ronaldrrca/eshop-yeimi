<?php
session_start();
require_once '../../models/usuarios-modelo.php';
header("Content-Type: application/json");

// DATOS SIMULADOS PARA PRUEBAS *****************************************************
$_SESSION['rol_usuario'] = "superadmin";
//***********************************************************************************

$respuesta = "";

// Recibir datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST["usuario"]);
    $password = trim($_POST["password"]);


    // ******************** Validaciones previas ********************
    
    // Validar que no estén vacíos
    if (empty($usuario) || empty($password)) {
        $respuesta = [
            "mensaje" => "Hay campo(s) vacío(s) en el formulario.",
            "status" => "error"
        ];
        
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  
        exit();
    }

       
    // ******************** Ejecusión de código si se cumple con todas las validaciones ********************  

    $objetoUsuarios = new Usuarios();
    $consulta = $objetoUsuarios->loginUsuario($usuario);

    if ($resultado = $consulta->fetch_assoc()) {
        
        if (password_verify($password, $resultado["password_usuario"])) {
            // Iniciar sesión con los datos del usuario
            $_SESSION["usuario"] = $resultado["nombre_usuario"];
            $_SESSION['rol_usuario'] = $resultado['rol_usuario'];
    
            $respuesta = [
                "mensaje" => "Inicio de sesión exitoso.",
                "status" => "success"
            ];
        
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  
            $objetoUsuarios = null;
            echo "usuario: " . $_SESSION['usuario'] . ", rol: " . $_SESSION['rol_usuario'];
            exit();
            
        } else {
            $respuesta = [
                "mensaje" => "Correo o contraseña incorrectos.",
                "status" => "error"
            ];
            
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
            exit();
        } 

    } else {
        $respuesta = [
            "mensaje" => "No se recibieron datos de la base de datos.",
            "status" => "error",
        ];
    }
    
} else {
    $respuesta = [
            "mensaje" => "No se recibieron los datos desde el frontend.",
            "status" => "error",
        ];
}
echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON

?>
