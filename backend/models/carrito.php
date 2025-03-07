<?php
require_once 'conexion.php';

class Carritos {
    private $id_carrito;
    private $id_cliente;
    private $id_producto;
    private $cantidad;
    

    //Getters

    //Setters

    //Funcines

    public function agregarItem($id_cliente, $id_producto, $cantidad) {
        $this->id_cliente = $id_cliente;
        $this->id_producto = $id_producto;
        $this->cantidad = $cantidad;
    
        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();
        
        $sql = "CALL agregarAlCarrito(?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }
    
        // Recorrer los productos y agregarlos uno por uno
        foreach ($this->id_producto as $key => $producto) {
            $cantidad_producto = $this->cantidad[$key];
    
            // Enlazar los parámetros y ejecutar la consulta
            $stmt->bind_param("iii", $this->id_cliente, $producto, $cantidad_producto);
            $resultado = $stmt->execute();
        }
    
        $stmt->close();
        $conexion->close();
        
        return $resultado;
    }


    public function editarItemDelCarrito($id_cliente, $id_producto, $cantidad) {
        $this->id_cliente = $id_cliente;
        $this->id_producto = $id_producto;
        $this->cantidad = $cantidad;

        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();
        
        $sql = "CALL editarItemDelCarrito(?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }
    
        // Recorrer los productos y agregarlos uno por uno
        foreach ($this->id_producto as $key => $producto) {
            $cantidad_producto = $this->cantidad[$key];
    
            // Enlazar los parámetros y ejecutar la consulta
            $stmt->bind_param("iii", $this->id_cliente, $producto, $cantidad_producto);
            $resultado = $stmt->execute();
        }
       
        $stmt->close();
        $conexion->close();
        
        return $resultado;
    }
    
}


?>