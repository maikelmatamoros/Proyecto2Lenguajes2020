<?php

class UsuarioController {
    
    public function __construct() {
        session_start();
        
        $this->view = new View();
    } // constructor
    
    public function mostrarRegistroUsuarioView(){
        $this->view->show("RegistroAdministradores.php", null);
    }

    public function mostrarAdmVentasView()
    {
        $this->view->show("AdminVentasView.php", null);
    }

    public function mostrarClienteHistorialView()
    {
        $this->view->show("ClienteHistorial.php", null);
    }

    public function mostrarClienteProductosView(){
        $this->view->show("ClienteCompra.php", null);
    }

    public function mostrarAdministradorView(){
        $this->view->show("AdministradorView.php", null);
    }

    public function mostrarClienteView(){
        $this->view->show("ClienteView.php", null);
    }

    public function Login() {
        require 'model/UsuarioModel.php';
        $model = new UsuarioModel();
        $response = $model->Login($_POST['Usuario'], $_POST['Contraseña']);
        if ($response=="A" || $response=="C"|| $response=="S") {
            echo $response;
            $_SESSION['Username'] = $_POST['Usuario'];
            $_SESSION['tipo'] = $response;
        } else {
            echo $response;
        }
    }

    
    public function registrarUsuario(){
        require "model/UsuarioModel.php";
        $model=new UsuarioModel();
        echo $model->registrarUsuario($_POST["Nombre"],$_POST["Apellidos"],$_POST["Edad"],
        $_POST["Genero"],$_POST["Contraseña"],$_POST["UserName"],$_POST["Direccion"],$_POST["Correo"],$_POST["Tipo"]);
    }

}

?>