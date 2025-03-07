<?php
require_once 'conexion.php';

class Categorias {
    private $id;
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


    public function editarCategoria($id, $nuevo_nombre) {
        $this->id = $id;
        $this->nombre = $nuevo_nombre;

        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();

        $sql = "CALL editarCategoria(?, ?)";
        $stmt = $conexion->prepare($sql);

        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }

         $stmt->bind_param("is", $this->id, $this->nombre);
         $stmt->execute();

         if ($stmt->affected_rows > 0) {
            $stmt->close();
            $conexion->close();
            return true;
        } else {
            $stmt->close();
            $conexion->close();
            return false;
        }
    }

    public function eliminarCategoria($id) {
        $this->id = $id;

        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();

        $sql = "CALL eliminarCategoria(?)";
        $stmt = $conexion->prepare($sql);

        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }

         $stmt->bind_param("i", $this->id);
         $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $stmt->close();
            $conexion->close();
            return true;
        } else {
            $stmt->close();
            $conexion->close();
            return false;
        }
    }
}





?>