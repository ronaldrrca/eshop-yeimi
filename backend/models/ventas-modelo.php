<?php
require_once 'conexion.php';

class Ventas {
    private $conexion;

    public function __construct() {
        $objConexion = new Conexion();
        $this->conexion = $objConexion->conectarse();
    }

    public function registrarVenta($id_cliente, $medio_pago, $numero_referencia, $id_producto, $cantidad, $precio_venta) {
        try {
            // Iniciar transacción
            $this->conexion->begin_transaction();

            // Registrar la venta
            $stmt = $this->conexion->prepare("CALL registrarVenta(?, ?, ?, @idVenta)");
            $stmt->bind_param("iss", $id_cliente, $medio_pago, $numero_referencia);

            if (!$stmt->execute()) {
                throw new Exception("Error al registrar la venta");
            }
            $stmt->close();

            // Obtener el ID de la venta registrada
            $resultado = $this->conexion->query("SELECT @idVenta AS idVenta");
            $fila = $resultado->fetch_assoc();
            $idVenta_registrado = $fila['idVenta'] ?? null;

            if (!$idVenta_registrado) {
                throw new Exception("Error: No se pudo recuperar el ID de la venta");
            }

            // Registrar los productos en la venta
            if (!$this->registrarDetallesVenta($idVenta_registrado, $id_producto, $cantidad, $precio_venta)) {
                throw new Exception("Error al registrar los detalles de la venta");
            }

            // Confirmar la transacción
            $this->conexion->commit();

            return ["status" => "success", "mensaje" => "Venta registrada correctamente", "idVenta" => $idVenta_registrado];
        } catch (Exception $e) {
            $this->conexion->rollback();
            return ["status" => "error", "mensaje" => $e->getMessage()];
        }
    }

    private function registrarDetallesVenta($idVenta, $id_producto, $cantidad, $precio_venta) {
        $stmt = $this->conexion->prepare("CALL registrarFilaVenta(?, ?, ?, ?)");

        if (!$stmt) {
            return false;
        }

        foreach ($id_producto as $index => $producto) {
            $stmt->bind_param("iiii", $idVenta, $producto, $cantidad[$index], $precio_venta[$index]);

            if (!$stmt->execute()) {
                return false;
            }
        }

        $stmt->close();
        return true;
    }


    public function verVentas() {
        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();
        $sql = "CALL verVentas()";
        $stmt = $conexion->prepare($sql);
    
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }
    
        // Ejecutar y validar la consulta
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $stmt->close();
        $conexion->close();
    
        return $resultado;  // Devuelve true si se ejecutó correctamente, false en caso de error
    }


    public function verVenta($idVenta) {
        $objConexion = new Conexion();
        $conexion = $objConexion->conectarse();
        $sql = "CALL verVenta(?)";
        $stmt = $conexion->prepare($sql);
            
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }

        $stmt->bind_param("i", $idVenta);
    
        // Ejecutar y validar la consulta
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $stmt->close();
        $conexion->close();
    
        return $resultado;  // Devuelve true si se ejecutó correctamente, false en caso de error
    }
}




?>