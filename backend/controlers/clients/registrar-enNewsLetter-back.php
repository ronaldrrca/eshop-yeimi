<?php
// Aseguramos que el archivo no se accesible desde el navegador
if ($_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
    http_response_code(403);
    die(json_encode(["error" => "Acceso no autorizado"]));
}

require_once "../../models/clientes-modelo.php"; 
header('Content-Type: application/json');

// Validando la recepción de los datos
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["mensaje" => "No se recibieron datos.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}
 

// Verificamos si se reciben los datos esperados
$nombre = ucwords(strtolower(trim($_POST["nombre"]))) ?? "";
$email = trim($_POST['email']) ?? "";

if (empty($nombre) || empty($email)) {
    echo json_encode(["mensaje" => "Faltan datos.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
} 

$objClientes = new Clientes();

try {
    $registrar = $objClientes->registrarEnNewsLetter($nombre, $email);
    
    if ($registrar) {
        echo json_encode(["mensaje" => "Registro exitoso.", "status" => "success"], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(["mensaje" => "Es probable que el email ingresado ya se encuentre registrado, por favor intente con uno diferente.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    }

} catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1062) { // Código de error de MySQL para entrada duplicada
        echo json_encode(["mensaje" => "El email ya está registrado, por favor ingrese un email diferente.", "status" => "duplicate"], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(["mensaje" => "Error en la base de datos.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    }
}


?>           
        
        
        

    


    