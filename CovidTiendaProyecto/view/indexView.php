<?php
// if (session_status() == !PHP_SESSION_ACTIVE) {
//     session_start();
// }else{
//     session_start();
// }
// if (isset($_SESSION['Username']) && (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'C')) {
    
//     header('Location:?controlador=Usuario&accion=mostrarClienteView');
//     exit();
// } else if (isset($_SESSION['Username']) && (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'A')) {
//     header('Location:?controlador=Usuario&accion=mostrarAdministradorView');
//     exit();
// }else{
//     echo $_SESSION['Username'];
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script type="text/javascript" src="public/js/index.js"></script>
    <title>Formulario Login y Registro de Usuarios</title>

    <style>
        html,
        body {
            height: 100%;
            width: 100%;
            background-color: #456;
        }

        .login-form {
            background-color: #ebebeb;
        }
    </style>
</head>

<body>
    <div class="container d-flex w-100 h-100">
        <div class="row align-items-center w-100 h-100">
            <div class="card col-md-6 col-sm-12 login-form" style="margin-left: auto;margin-right: auto;">
                <div class="card-body">
                    <div class="form">
                        <form style="display: none">
                            <h3 class="card-title text-center">Registrar</h3>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Nombre</label>
                                <div class="col-lg-9">
                                    <input class="form-control" id="Nombre" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Apellidos</label>
                                <div class="col-lg-9">
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
                                    <input class="form-control" id="ContraseñaR" type="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Correo</label>
                                <div class="col-lg-3">
                                    <input class="form-control" id="Correo" type="text">
                                </div>
                                <label class="col-lg-2 col-form-label form-control-label">Genero</label>
                                <div class="col-lg-4">
                                    <select class="form-control" id="Genero">
                                        <option value="F">Femenino</option>
                                        <option value="M">Masculino</option>
                                    </select>
                                </div>
                            </div>


                            <button id=btnReg class="btn btn-primary btn-block">Registrar</button>
                            <div class="row">
                                <div class="col-12" id="Resultado">

                                </div>
                            </div>
                            <div class="mensaje">
                                Ya tienes cuenta? <a href="#">Inicia Sesion</a>
                            </div>
                        </form>
                        <form>
                            <h3 class="card-title text-center">Login</h3>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Usario</label>
                                <div class="col-lg-9">
                                    <input class="form-control" id="Usuario" name="Usuario" type="text">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Contraseña</label>
                                <div class="col-lg-9">
                                    <input class="form-control" id="Contraseña" name="Contraseña" type="password">
                                </div>
                            </div>

                            <button id="btnIniciar" class="btn btn-primary btn-block">Iniciar Sesión</button>
                            <div class="row">
                                <div class="col-12" id="ResultadoLog">

                                </div>
                            </div>
                            <p class="mensaje">
                                No tienes cuenta? <a href="#">Crea una</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>