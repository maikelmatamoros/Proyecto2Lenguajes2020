<?php
include_once "public/header.php";
?>

<script type="text/javascript" src="public/js/usuario.js"></script>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-outline-secondary" style="margin: 2%">
            <div class="card-header">
                <h3 class="mb-0">Registrar Empleado Administrador</h3>
            </div>
            <div class="card-body">
                <form autocomplete="off" class="form">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Cedula</label>
                        <div class="col-lg-9">
                            <input class="form-control" id="Cedula" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Nombre</label>
                        <div class="col-lg-3">
                            <input class="form-control" id="Nombre" type="text">
                        </div>
                        <label class="col-lg-3 col-form-label form-control-label">Apellidos</label>
                        <div class="col-lg-3">
                            <input class="form-control" id="Apellidos" type="text">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Direccion</label>
                        <div class="col-lg-9">
                            <input class="form-control" id="Direccion" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Edad</label>
                        <div class="col-lg-9">
                            <input class="form-control" id="Edad" type="number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Nombre de Usuario</label>
                        <div class="col-lg-3">
                            <input class="form-control" id="UserName" type="text">
                        </div>
                        <label class="col-lg-3 col-form-label form-control-label">Contraseña</label>
                        <div class="col-lg-3">
                            <input class="form-control" id="Contraseña" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Correo</label>
                        <div class="col-lg-4">
                            <input class="form-control" id="Correo" type="text">
                        </div>

                        <div class="col-lg-5">
                            <select class="selectpicker" id="Genero" title="Seleccione un Genero">
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select>

                        </div>


                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label"></label>
                        <div class="col-lg-2">
                            <button id="btnRegAdmin" type="button" class="btn btn-primary">Registrar</button>
                        </div>
                        <label class="col-lg-3 col-form-label form-control-label"></label>
                    </div>
                    <div class="col-md-12" id="alertControl"></div>
                </form>

            </div>
        </div><!-- /form user info -->
    </div>
</div>