<?php
session_start();
require_once "../../models/clientes-modelo.php"; 
header('Content-Type: application/json');  // Indicar que la respuesta es JSON

$respuesta = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = ucwords(strtolower(trim($_POST["nombre"])));
    $telefono = isset($_POST['telefono']) ? trim($_POST["telefono"]) : "";
    $email = trim($_POST["email"]);
    $email_confirmacion = trim($_POST['email_confirmacion']);
    $password = trim($_POST["password"]);
    $password_confirmacion = trim($_POST["password_confirmacion"]);
    $passwordHasheada = password_hash($password, PASSWORD_DEFAULT);// Hashear la contraseña

    // Validar que los campos no estén vací­os
    if (empty($nombre) || empty($telefono) || empty($email) || empty($email_confirmacion) || empty($password) || empty($password_confirmacion)) {
        $respuesta = [
            "mensaje" => "Hay campo(s) vacío(s) en el formulario.",
            "status" => "error"
        ];
        
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON
        // header("Location: formulario-registro-cliente.php");
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

    // Validar que los emails ingresados sean iguales
    if ($email != $email_confirmacion) {
        $respuesta = [
            "mensaje" => "Los emails son diferentes.",
            "status" => "error"
        ];
        
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON
        // header("Location: formulario-registro-cliente.php");
        exit();
    }


    // Validar que el password de confirmación sea igual al password
    if ($password != $password_confirmacion) {
        $respuesta = [
            "mensaje" => "Las contraseñas no coinciden.",
            "status" => "error"
        ];
        
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON
        // header("Location: formulario-registro-cliente.php");
        exit();
    }

    
    // Validar que las contraseñas tengan el número de caracteres requerido
    if (strlen($password) < 6 || strlen($password) > 8) {
        $respuesta = [
            "mensaje" => "La contraseña debe tener entre 6 y 8 caracteres.",
            "status" => "error"
        ];
        
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON
        // header("Location: formulario-registro-cliente.php");
        exit();
    }


    // ******************** Ejecución de código si se cumple con todas las validaciones ********************  
         
    $objetoClientes = new Clientes();
    $validarEmail =$objetoClientes->validarEmail($email);
    
    if (!$validarEmail) {
        $consulta = $objetoClientes->registrarCliente($nombre, $telefono, $email, $passwordHasheada);
        // echo $consulta; die();
        if ($consulta) {
            // Obtener el ID del cliente recién registrado
            $id_cliente = $consulta;

            // Iniciar sesiónn automáticamente
            $_SESSION["cliente"] = $nombre;
            $_SESSION["id_cliente"]= $id_cliente;
            
            $respuesta = [
                "mensaje" => "Registrado con éxito.",
                "status" => "success"
            ];
            
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON 
                    
            if (isset($_SESSION['redirect_to'])) {
                // header("Location: ../../" . $_SESSION['redirect_to']); // Redirigir al panel del cliente
                exit;
            } else {
                // header("Location: .. /../index.php"); // Redirigir al panel del cliente
                exit;
            }

        } else {
            $respuesta = [
                "mensaje" => "Se produjo un error.",
                "status" => "error"
            ];
            
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON
            // header("Location: formulario-registro-cliente.php");
            exit();
        }

    } else {
        $respuesta = [
            "mensaje" => "Email ya se encuentra registrado.",
            "status" => "error"
        ];
        
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON
        // header("Location: formulario-registro-cliente.php");
        exit();
    }

} else {
    $respuesta = [
        "mensaje" => "No se recibieron datos.",
        "status" => "error"
    ];
    
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON
    // header("Location: formulario-registro-cliente.php");
    exit();
}
?>
