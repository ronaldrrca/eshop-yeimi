<?php
session_start();
require_once '../../models/clientes-modelo.php';
header("Content-Type: application/json");

$redirect_to = $_SESSION['redirect_to'] ?? "index.php";
unset($_SESSION['redirect_to']);


// Validando la recepción de los datos
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["mensaje" => "No se recibieron datos.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

$email = trim($_POST["email"]);
$password = trim($_POST["password"]);

// Validar que no estén vacíos
if (empty($email) || empty($password)) {
    echo json_encode(["mensaje" => "Hay campos vacíos en el formulario.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}

// Validar el formato del correo electrónico
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["mensaje" => "El correo electrónico no es válido.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    exit;
}
    
    
// ******************** Ejecusión de código si se cumple con todas las validaciones ********************  

$objetoClientes = new Clientes();
$consulta = $objetoClientes->loginCliente($email);

if ($resultado = $consulta->fetch_assoc()) {
        
    if (password_verify($password, $resultado["password_cliente"])) {
        // Desglozando el nombre del cliente para mostrar la primera palabra, la inicial de la segunda y un punto.
        $nombre_cliente = $resultado["nombre_cliente"];

        // Obtener la primera palabra
        $primera_palabra = strtok($nombre_cliente, " ");

        // Obtener la primera letra de la segunda palabra
        $segunda_palabra = strtok(" ");
        $primera_letra_segunda = $segunda_palabra ? $segunda_palabra[0] : '';

        // Iniciar sesión con los datos del cliente
        $_SESSION["cliente"] = $primera_palabra . " " . $primera_letra_segunda . "." ;
        $_SESSION['id_cliente'] = $resultado['id_cliente'];
    
        echo json_encode(["mensaje" => "Inicio de sesión exitoso.", "status" => "success", "redirect_to" => $redirect_to], JSON_UNESCAPED_UNICODE); 
        $objetoClientes = null;
                   
    } else {
        echo json_encode(["mensaje" => "Correo o contraseña incorrectos.", "status" => "error"], JSON_UNESCAPED_UNICODE);
    } 

} else {
    echo json_encode(["mensaje" => "Email no registrado.", "status" => "error"], JSON_UNESCAPED_UNICODE);
}

?>
