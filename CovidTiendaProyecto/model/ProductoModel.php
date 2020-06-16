<?php

class ProductoModel
{

    protected $db;

    public function __construct()
    {
        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    } // constructor

    public function registrarProducto($nombre, $decripcion, $precio, $rutaImagen, $categoria)
    {
        $stml = $this->db->prepare('call sp_crear_producto(?,?,?,?,?)');
        $data = array($nombre, $decripcion, $precio, $rutaImagen, $categoria);
        $result = $stml->execute($data);
        if ($result) {
            return 'Registro exitoso';
        } else {
            return $stml->errorInfo()[2];
        }
    }

    public function guardarPromocion($descuento, $fechaI, $fechaF, $productos)
    {
        try {
            $this->db->beginTransaction();
            $this->db->exec("set names utf8");
            $errores = array();
            $consulta = $this->db->prepare('call sp_crear_promocion(?,?,?,?,?,?)');
            foreach ($productos as $producto) {
                $precioReal = $producto[2];
                $precioDescuento = $producto[2] - $producto[2] * ($descuento * 0.01);
                $data = array($precioReal, $precioDescuento, $descuento, $fechaI, $fechaF, $producto[0]);
                $result = $consulta->execute($data);
                if ($result) {
                    array_push($errores, 'Registro exitoso: ' . $producto[1]);
                } else {
                    //array_push($errores,$consulta->errorInfo()[2]);
                    if ($consulta->errorInfo()[2] == "Error") {
                        array_push($errores, 'Ya existe una promocion ' . $producto[1] . ' en ese rango de fechas');
                    }
                }
            }
            // commit the transaction
            $consulta->closeCursor();
            $this->db->commit();
            return $errores;
        } catch (PDOException $e) {
            $this->db->rollBack();
            echo $e->getMessage();
            die($e->getMessage());
        }
    }

    public function registrarCategoria($nombre)
    {
        $stml = $this->db->prepare('call sp_crear_categoria(?)');
        $data = array($nombre);
        $result = $stml->execute($data);
        if ($result) {
            return 'Registro exitoso';
        } else {
            $resultArray = explode(" ", $stml->errorInfo()[2]);
            $size = sizeof($resultArray);
            return $resultArray;
        }
    }

    public function obtenerCategorias()
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare('call sp_obtener_categorias()');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }

    public function obtenerProductos()
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare('call sp_obtener_productos()');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }

    public function agregarAlCarrito($id, $userName)
    {
        $stml = $this->db->prepare('call sp_agregarCarrito(?,?)');
        $result = $stml->execute(array($userName, $id));
        if ($result) {
            return 'S';
        } else {
            return $stml->errorInfo()[2];
        }
    }

    public function marcarFavorito($id, $userName)
    {
        $stml = $this->db->prepare('call sp_marcar_favorito(?,?)');
        $result = $stml->execute(array($userName, $id));
        if ($result) {
            return 'S';
        } else {
            return $stml->errorInfo()[2];
        }
    }

    public function eliminarDelCarrito($id, $userName)
    {
        $stml = $this->db->prepare('call sp_eliminar_producto_carrito(?,?)');
        $result = $stml->execute(array($userName, $id));
        if ($result) {
            return 'S';
        } else {
            return $stml->errorInfo()[2];
        }
    }

    public function generarCompraDirecta($producto, $cantidad, $usuario)
    {

        $venta = $this->db->prepare('call sp_generarVenta(?,?)');
        $ventaProducto = $this->db->prepare('call generar_venta_producto(?,?,?,?)');
        try {
            $this->db->beginTransaction();
            $total = ($producto[1] * $cantidad) - (($producto[1] * $cantidad) * ($producto[2] * 0.01));
            $venta->execute(array($usuario, $total));
            $resultado = $venta->fetchAll();
            $id = $resultado[0];
            $venta->CloseCursor();
            $ventaProducto->execute(array($id[0], $producto[0], $cantidad, $producto[2]));
            $ventaProducto->CloseCursor();
            $this->db->commit();
            return "Success";
        } catch (Exception $e) {
            $this->db->rollback();
            return "Fallo";
        }
    }

    public function generarCompra($productos, $total, $usuario)
    {
        try {
            $this->db->beginTransaction();
            $this->db->exec("set names utf8");
            $venta = $this->db->prepare('call sp_generarVenta(?,?)');
            $ventaProducto = $this->db->prepare('call generar_venta_producto(?,?,?,?)');
            $vaciarCarrito = $this->db->prepare('call sp_eliminar_carrito(?)');
            $venta->execute(array($usuario, $total));
            $resultado = $venta->fetchAll();
            $id = $resultado[0];
            $venta->closeCursor();
            foreach ($productos as $value) {

                $ventaProducto->execute(array($id[0], $value[0], $value[3], $value[2]));
            }
            $vaciarCarrito->execute(array($usuario));
            
            $this->db->commit();
            echo 'Guardada correctamente';
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            echo $e->getMessage();
            die($e->getMessage());
        }
    }

    public function obtenerCantidadCarrito($usuario)
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare('call sp_carritoCantidad(?)');
        $consulta->execute(array($usuario));
        $resultado = $consulta->fetchAll();
        $numero = $resultado[0];
        $consulta->CloseCursor();
        return $numero[0];
    }

    public function obtenerCarrito($usuario)
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare('call sp_getCarrito(?)');
        $consulta->execute(array($usuario));
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }
    
    public function obtenerVentasPorMesAnno($mes,$anno)
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare('call sp_getVentasPorMesAnno(?,?)');
        $consulta->execute(array($mes,$anno));
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }

    public function obtenerVentasPorRango($fechaInicio,$fechaFin)
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare('call sp_getVentasPorFecha(?,?)');
        $consulta->execute(array($fechaInicio,$fechaFin));
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }

    public function obtenerHistorial($usuario)
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare('call sp_getHistorial(?)');
        $consulta->execute(array($usuario));
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }

    public function obtenerProductoVentas($ventaID)
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare('call sp_getAdmVentaProductos(?)');
        $consulta->execute(array($ventaID));
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }

    public function obtenerProductosRecomendados()
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare('call sp_getRecomedados()');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }
    

    public function obtenerProductosMasPromociones()
    {
        $this->db->exec("set names utf8");
        $consulta = $this->db->prepare('call sp_obtener_productos_promociones()');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $resultado;
    }
} // fin clase
