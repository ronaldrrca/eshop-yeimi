<?php
session_start();
require_once "../../models/usuarios-modelo.php"; 
header('Content-Type: application/json');  

$respuesta = [];

//Verificamos si se reciben los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = trim($_POST["id"]);

} else {
    echo 'No se recibieron datos';
    exit;
}   

// Veridicamos los privilegios
if (!isset($_SESSION['rol_usuario']) || $_SESSION['rol_usuario'] != "superadmin") {
    echo "Usuario no tiene suficientes privilegios";
    exit;
}    

// Verificamos si se recibe el ID del usuario a editar
if (empty($id)) {
    echo "Falta el ID del usuario a editar.";
    exit;
}  

$objUsuarios = new Usuarios();
$eliminar = $objUsuarios->eliminarUsuario($id);

if ($eliminar) {
    $respuesta = [
        "mensaje" => "Usuario eliminado con éxito.",
        "status" => "success"
    ];
    
} else {
    $respuesta = [
        "mensaje" => "Ocurrió un error.",
        "status" => "error"
    ];
}

echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);  // Convertir array PHP a JSON

?>           
        
        
        

    


    