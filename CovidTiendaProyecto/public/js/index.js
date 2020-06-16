
$(document).ready(function () {
    $('.mensaje a').click(function () {
        $('form').animate({
            height: "toggle",
            opacity: "toggle"
        }, "slow");
    });

});


$(document).on("click", "#btnReg", function (e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: "?controlador=Usuario&accion=registrarUsuario",
        data: {
            "Nombre": $("#Nombre").val(),
            "Apellidos": $("#Apellidos").val(),
            "Edad": $("#Edad").val(),
            "Correo": $("#Correo").val(),
            "UserName": $("#UserName").val(),
            "Contraseña": $("#ContraseñaR").val(),
            "Direccion": $("#Direccion").val(),
            "Tipo": "C",
            "Genero": $("#Genero").val()
        },
        beforeSend: function () {
            $("#Resultado").html('<div class="alert alert-success" id="alert"> Procesando... </div>');
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 3000);
        },
        success: function (response) {
            let respuesta = response.split("\n").join("");
            console.log(respuesta);
            let mensaje = respuesta.split(" ");
            if (mensaje[0] == "Duplicate") {
                $("#Resultado").html('<div class="alert alert-success" id="alert">El Nombre de Usuario no se encuentra disponible, elija otro e intente de nuevo</div>');
                window.setTimeout(function () {
                    $(".alert").fadeTo(900, 0).slideUp(900, function () {
                        $(this).remove();
                    });
                }, 5000);
            }else{
                $("#Resultado").html('<div class="alert alert-success" id="alert">' + response + '</div>');
                window.setTimeout(function () {
                    $(".alert").fadeTo(900, 0).slideUp(900, function () {
                        $(this).remove();
                    });
                }, 5000);
            }

        }
    });
});


$(document).on("click", "#btnIniciar", function (e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: "?controlador=Usuario&accion=Login",
        data: {
            "Usuario": $("#Usuario").val(),
            "Contraseña": $("#Contraseña").val(),
        },
        beforeSend: function () {
            $("#ResultadoLog").html('<div class="alert alert-success" id="alert"> Procesando... </div>');
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 3000);
        },
        success: function (response) {
            
            let respuesta = response.split("\n").join("");
            
            if (respuesta == "N") {
                $("#ResultadoLog").html('<div class="alert alert-success" id="alert"> No se encontró un usuario con esas credenciales, revise en intente de nuevo. </div>');
                window.setTimeout(function () {
                    $(".alert").fadeTo(900, 0).slideUp(900, function () {
                        $(this).remove();
                    });
                }, 5000);
            } else if (respuesta == "C") {
                window.location.href = "?controlador=Usuario&accion=mostrarClienteView";
            } else if (respuesta == "A") {
                window.location.href = "?controlador=Usuario&accion=mostrarAdministradorView";
            }else if (respuesta == "S") {
                window.location.href = "?controlador=Usuario&accion=mostrarAdministradorView";
            }
        }
    });
});