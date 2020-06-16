



//----------------------------------------Registrar Nuevo Usuario Administrador-----------------------------
$(document).on("click","#btnRegAdmin",function(){
    $.ajax({
        type: 'POST',
        url: "?controlador=Usuario&accion=registrarUsuario",
        data: {"Nombre": $("#Nombre").val(),
               "Apellidos": $("#Apellidos").val(),
               "Edad": $("#Edad").val(),
               "Correo": $("#Correo").val(),
               "UserName": $("#UserName").val(),
               "Contraseña":$("#Contraseña").val(),
               "Direccion": $("#Direccion").val(),
               "Tipo": "A",
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
            $("#Resultado").html('<div class="alert alert-success" id="alert">' + response + '</div>');
            window.setTimeout(function () {
                $(".alert").fadeTo(900, 0).slideUp(900, function () {
                    $(this).remove();
                });
            }, 5000);


        }
    });
});
//----------------------------------------Registrar Nuevo Usuario Administrador-----------------------------

//----------------------------------------Registrar Nuevo Usuario Cliente-----------------------------
$(document).on("click","#btnRegClient",function(){
    $.ajax({
        type: 'POST',
        url: "?controlador=Usuario&accion=registrarUsuario",
        data: {"Nombre": $("#Nombre").val(),
               "Apellidos": $("#Apellidos").val(),
               "Cedula": $("#Cedula").val(),
               "Edad": $("#Edad").val(),
               "Correo": $("#Correo").val(),
               "UserName": $("#UserName").val(),
               "Contraseña":$("#Contraseña").val(),
               "Direccion": $("#Direccion").val(),
               "Tipo": "C",
        },
        beforeSend: function () {
            $("#alertControl").html('<div class="alert alert-success" id="alert"> Procesando... </div>');
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 3000);
        },
        success: function (response) {
            $("#alertControl").html('<div class="alert alert-success" id="alert">' + response + '</div>');
            window.setTimeout(function () {
                $(".alert").fadeTo(900, 0).slideUp(900, function () {
                    $(this).remove();
                });
            }, 5000);


        }
    });
});
//----------------------------------------Registrar Nuevo Usuario Cliente-----------------------------

//----------------------------------------Login-----------------------------
$(document).on("click","#btnLogin",function(){
    $.ajax({
        type: 'POST',
        url: "?controlador=Usuario&accion=usuarioLogin",
        data: {"UserName": $("#UserName").val(),
               "Contraseña":$("#Contraseña").val(),
        },
        beforeSend: function () {
            $("#alertControl").html('<div class="alert alert-success" id="alert"> Procesando... </div>');
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 3000);
        },
        success: function (response) {
            $("#alertControl").html('<div class="alert alert-success" id="alert">' + response + '</div>');
            window.setTimeout(function () {
                $(".alert").fadeTo(900, 0).slideUp(900, function () {
                    $(this).remove();
                });
            }, 5000);
        }
    });
});
//----------------------------------------Login-----------------------------

