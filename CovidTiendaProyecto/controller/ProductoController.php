<?php

class ProductoController
{

    public function __construct()
    {
        session_start();

        if (!isset($_SESSION['Carrito'])) {
            $_SESSION['Carrito'] = array();
        }


        $this->view = new View();
    } // constructor

    public function mostrarRegistroProductoView()
    {
        $this->view->show("RegistroProducto.php", null);
    }


    public function mostrarCarritoView()
    {
        $this->view->show("CarritoView.php", null);
    }

    public function mostrarRegistroComboView()
    {
        $this->view->show("RegistroCombos.php", null);
    }

    public function agregarAlCarrito()
    {
        $productID = $_POST["ID"];
        $_SESSION['Carrito'] = array();
        if (!in_array($productID, $_SESSION['Carrito'])) {
            require 'model/ProductoModel.php';
            $model = new ProductoModel();
            array_push($_SESSION['Carrito'], $productID);
            echo $model->agregarAlCarrito($productID, "DGCR");
            //$_SESSION['Username']);
        }
    }

    public function marcarFavorito()
    {
        $productID = $_POST["ID"];
        require 'model/ProductoModel.php';
        $model = new ProductoModel();
        echo $model->marcarFavorito($productID, "DGCR");
        //$_SESSION['Username']);

    }

    public function eliminarDelCarrito()
    {
        require 'model/ProductoModel.php';
        $model = new ProductoModel();
        echo $model->eliminarDelCarrito($_POST["ID"], "DGCR");
        //$_SESSION['Username']);

    }
    


    public function registrarProducto()
    {
        $date = new DateTime();
        $indicador = $date->getTimestamp();
        $nombreImagen = $_FILES['imagen']['name'];
        $tipoImagen = $_FILES['imagen']['type'];
        $tamaño = $_FILES['imagen']['size'];
        $pathParcial = "/CovidTiendaProyecto/public/img/";

        if ($tamaño <= 3000000) {

            if ($tipoImagen == 'image/jpg' || $tipoImagen == 'image/jpeg' || $tipoImagen == 'image/png') {
                $carpetaDestino = $_SERVER['DOCUMENT_ROOT'] . $pathParcial;
                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $carpetaDestino . $indicador . $nombreImagen)) {
                    require 'model/ProductoModel.php';
                    $producto = new ProductoModel();
                    echo $producto->registrarProducto($_POST['Nombre'], $_POST['Descripcion'], $_POST['Precio'], $pathParcial . $indicador . $nombreImagen, $_POST['select']);
                } else {
                    echo 'Ocurrió un error al subir la imagen, intente otra vez';
                }
            } else {
                echo 'El formato del archivo debe ser .PNG , .JPG o .JPEG';
            }
        } else {
            echo 'El archivo superó el limite de tamaño(2MB)';
        }
    }

    public function generarCompraDirecta()
    {
        require 'model/ProductoModel.php';
        $modelo = new ProductoModel();
        $productos = json_decode($_POST['Producto'], true);
        $resultado = $modelo->generarCompraDirecta($productos, $_POST["Cantidad"], "DGCR");
        echo json_encode($resultado);
    }

    public function generarCompra()
    {
        require 'model/ProductoModel.php';
        $modelo = new ProductoModel();
        $productos = json_decode($_POST['Productos'], true);
        $resultado = $modelo->generarCompra($productos, $_POST["Total"], "DGCR");
        echo json_encode($resultado);
    }
    public function guardarPromociones()
    {
        require 'model/ProductoModel.php';
        $modelo = new ProductoModel();
        $productos = json_decode($_POST['Productos'], true);
        $resultado = $modelo->guardarPromocion($_POST['Descuento'], $_POST['FechaI'], $_POST['FechaF'], $productos);
        echo json_encode($resultado);
    }

    public function obtenerCantidadCarrito()
    {
        require 'model/ProductoModel.php';
        $producto = new ProductoModel();
        echo $producto->obtenerCantidadCarrito("DGCR");
    } // registrar 


    public function registrarCategoria()
    {
        require 'model/ProductoModel.php';
        $producto = new ProductoModel();
        echo $producto->registrarCategoria($_POST['Nombre']);
    } // registrar    

    public function obtenerCategorias()
    {
        require 'model/ProductoModel.php';
        $producto = new ProductoModel();
        $datos['data'] = $producto->obtenerCategorias();
        echo json_encode($datos);
    }

    public function obtenerProductos()
    {
        require 'model/ProductoModel.php';
        $producto = new ProductoModel();
        $datos['data'] = $producto->obtenerProductos();
        echo json_encode($datos);
    }

    public function obtenerProductosMasPromociones()
    {
        require 'model/ProductoModel.php';
        $producto = new ProductoModel();
        $datos['data'] = $producto->obtenerProductosMasPromociones();
        echo json_encode($datos);
    }
    public function obtenerCarrito()
    {
        require 'model/ProductoModel.php';
        $producto = new ProductoModel();
        $datos['data'] = $producto->obtenerCarrito("DGCR");
        echo json_encode($datos);
    }

    public function obtenerVentasMesAnno()
    {
        require 'model/ProductoModel.php';
        $producto = new ProductoModel();
        $datos['data'] = $producto->obtenerVentasPorMesAnno($_POST["Mes"],$_POST["Anno"]);
        echo json_encode($datos);
    }

    public function obtenerVentasPorRango()
    {
        require 'model/ProductoModel.php';
        $producto = new ProductoModel();
        $datos['data'] = $producto->obtenerVentasPorRango($_POST["FechaI"],$_POST["FechaF"]);
        echo json_encode($datos);
    }

    public function obtenerHistorial()
    {
        require 'model/ProductoModel.php';
        $producto = new ProductoModel();
        $datos['data'] = $producto->obtenerHistorial("DGCR");
        echo json_encode($datos);
    }

    public function obtenerVentasProductos()
    {
        require 'model/ProductoModel.php';
        $producto = new ProductoModel();
        $datos['data'] = $producto->obtenerProductoVentas($_POST["ventaID"]);
        echo json_encode($datos);
    }

    public function obtenerProductosRecomendados()
    {
        require 'model/ProductoModel.php';
        $producto = new ProductoModel();
        $datos['data'] = $producto->obtenerProductosRecomendados();
        echo json_encode($datos);
    }
    

} // fin clase
