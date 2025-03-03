<?php
require_once 'conexion.php';

class Usuarios {
    private $id;
    private $nombre;
    private $usuario;
    private $email;
    private $password;
    private $rol;

    // Constructor con valores predeterminados
    public function __construct($id = null, $nombre = null, $usuario = null, $password = null, $rol = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $usuario;
        $this->stock = $password;
        $this->password = $rol;
    }
    

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRol() {
        return $this->rol;
    }

    
    // Setters
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setTelefono($usuario) {
        $this->usuario = $usuario;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

   
    // Funciones
    public function loginUsuario($usuario) {
        $this->usuario = $usuario;

        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();
        $sql = "CALL loginUsuario(?)";
        $stmt = $conexion->prepare($sql);
        
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }
    
        // Enlazar el parámetro
        $stmt->bind_param("s", $this->usuario);
    
        // Ejecutar la consulta
        $stmt->execute();
    
        // Obtener el resultado
        $resultado = $stmt->get_result();

        $stmt->close();
        $conexion->close();
    
        return $resultado;
    }
    
    
}


?>
