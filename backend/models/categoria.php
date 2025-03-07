<?php
require_once 'conexion.php';

class Categorias {
    private $nombre;

    //Getters
    //Setters 
    // Funciones
    public function crearCategoria($nombre) {
        $this->nombre = $nombre;

        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();

        $sql = "CALL crearCategoria(?)";
        $stmt = $conexion->prepare($sql);

        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }

         $stmt->bind_param("s", $this->nombre);
         $resultado = $stmt->execute();

         $stmt->close();
         $conexion->close();

         return $resultado;
    }

}





?>