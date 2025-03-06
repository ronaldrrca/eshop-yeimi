<?php
session_start();
require_once "../../models/usuarios-modelo.php"; 
header('Content-Type: application/json');  // Indicar que la respuesta es JSON

$respuesta = [];
$id = 0;
$usuario = "";
$password_actual = "";
$password_nuevo = "";
$password_confirmacion = "";

// Verificamos que se reciban los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = trim($_POST["id"]);
    $usuario = trim($_POST['usuario']);
    $password_actual = trim($_POST['password_actual']);
    $password_nuevo = trim($_POST['password_nuevo']);
    $password_confirmacion = trim($_POST['password_confirmacion']);

}else {
    $respuesta = [
        "mensaje" => "No se recibieron datos.",
        "status" => "error"
    ];
    
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON
    exit;
}

// Verificamos que los datos de la sesión sean los mismos del id recibido
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_usuario'] != $id) {
    $respuesta = [
        "mensaje" => "No existe un asesión iniciada, o el id enviado no corresponde al id de la sesión.",
        "status" => "error",
        ];
    
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        exit;
}


// Verifivamos que todos los campos están llenos
if (empty($id) || empty($password_nuevo) || empty($usuario) || empty($password_actual) || empty($password_confirmacion)) {
    $respuesta = [
        "mensaje" => "Hay campo(s) vacío(s) en el formulario.",
        "status" => "error"
    ];
            
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON
    exit;
}

// Verificamos que el nuevo password y el password de confirmación, sean iguales
if ($password_nuevo != $password_confirmacion) {
    $respuesta = [
        "mensaje" => "La nueva contraseña y su confirmación no coindicen",
        "status" => "error"
    ];
            
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON
    exit;   
}

$objUsuarios = new Usuarios();
$autenticar = $objUsuarios->loginUsuario($usuario);

if ($resultadoAutenticar = $autenticar->fetch_assoc()) {
    if (password_verify($password_actual, $resultadoAutenticar["password_usuario"])) {
                     
        $passwordHasheada = password_hash($password_nuevo, PASSWORD_DEFAULT);

        $cambiar = $objUsuarios->cambiarPasswordUsuario($id, $passwordHasheada);
                    
        if ($cambiar) {
            $respuesta = [
                "mensaje" => "Contraseña cambiada exitosamente",
                "status" => "succes"
            ];
            
        } else {
            $respuesta = [
                "mensaje" => "Ocurrió un error y no se generó la actualización",
                "status" => "error"
            ];
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON

    } else {
        $respuesta = [
            "mensaje" => "Contraseña inválida. Intente nuevamente",
            "status" => "error"
        ];
        
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON
        exit;
    }
} else {
    echo "Sin datos asociados al id consultado";
}
        
        
       
        
?>

    

