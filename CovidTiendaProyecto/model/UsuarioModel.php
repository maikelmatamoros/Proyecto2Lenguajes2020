<?php

class UsuarioModel
{

    protected $db;

    public function __construct()
    {
        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    } // constructor

    public function registrarUsuario($nombre,$apellidos,$edad,$genero,$contraseña,$userName,$direccion,$correo,$tipo)
    {
        $stml = $this->db->prepare('call sp_registrar_usuario(?,?,?,?,?,?,?,?,?)');
        $data = array($nombre,$apellidos,$userName,$contraseña,$edad,$correo,$genero,$direccion,$tipo);
        $result = $stml->execute($data);
        if ($result) {
            return 'Registro exitoso';
        } else {
            return $stml->errorInfo()[2];
        }
    }


    public function Login($userName, $pass) {
        $consulta = $this->db->prepare('call sp_Login(?,?)');
        $data = array($userName, $pass);
        $consulta->execute($data);
        $resultado = $consulta->fetch();
        $col = $consulta->rowCount();
        if ($col > 0) {
            $consulta->CloseCursor();
            return $resultado[0];
        }else if($col==0){
            $consulta->CloseCursor();
            return "N";
        }else{
            $consulta->CloseCursor();
            return $consulta->errorInfo()[2];
        
        }
    }
}
