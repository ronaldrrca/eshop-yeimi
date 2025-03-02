<?php
session_start();
require_once '../../models/clientes-modelo.php';
header("Content-Type: application/json");

// DATOS SIMULADOS PARA PRUEBAS *****************************************************
$_SESSION['rol_usuario'] = "superadmin";
//***********************************************************************************

$respuesta = "";

// Recibir datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);


    // ******************** Validaciones previas ********************
    
    // Validar que no estén vacíos
    if (empty($email) || empty($password)) {
        $respuesta = [
            "mensaje" => "Hay campo(s) vacío(s) en el formulario.",
            "status" => "error"
        ];
        
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  
        exit();
    }

    // Validar el formato del correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $respuesta = [
            "mensaje" => "El correo electrónico no es válido.",
            "status" => "error"
        ];
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        exit();
    }
    
    
    // ******************** Ejecusión de código si se cumple con todas las validaciones ********************  

    $objetoClientes = new Clientes();
    $consulta = $objetoClientes->loginCliente($email);

    if ($resultado = $consulta->fetch_assoc()) {
        
        if (password_verify($password, $resultado["password_cliente"])) {
            // Iniciar sesión con los datos del usuario
            $_SESSION["cliente"] = $resultado["nombre_cliente"];
            $_SESSION['id_cliente'] = $resultado['id_cliente'];
    
            $respuesta = [
                "mensaje" => "Inicio de sesión exitoso.",
                "status" => "success"
            ];
        
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  
            $objetoClientes = null;
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
