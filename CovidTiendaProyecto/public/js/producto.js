$(document).ready(function () {
    $('select').change(function () {
        if ($('select option:selected').text() == "Añadir") {
            $("#add").show();
        } else {
            $("#add").css("display", "none");
        }
    })
    obtenerCategorias();
    registrarProductos()
});




//------------------------------------------Obtener Categorias--------------------------------------------
let categorias;
function obtenerCategorias(){
    
    $.ajax({
        type: 'POST',
        url: "?controlador=Producto&accion=obtenerCategorias",
        success: function (response) {
            $("#select").empty();
            categorias=JSON.parse(response);
            for(let i=0;i<categorias.data.length;i++){
                
                $("#select").append(
                    '<option value="'+categorias.data[i].categoria_id+'">' + categorias.data[i].categoria_nombre + '</option>'
                );
            }
            $("#select").append(
                '<option value="-1">Añadir</option>'
            );
            $('#select').selectpicker('refresh');
        }
    });
};
//------------------------------------------Obtener Categorias--------------------------------------------


//-------------------------------------------Registrar Nueva Categoria---------------------------------
$(document).on("click","#CategoriaAdd",function(){
    $.ajax({
        type: 'POST',
        url: "?controlador=Producto&accion=registrarCategoria",
        data: {"Nombre": $("#Categoria").val()},
        beforeSend: function () {
            $("#alertControl").html('<div class="alert alert-success" id="alert"> Procesando... </div>');
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 3000);
        },
        success: function (response) {
            obtenerCategorias();
            $("#alertControl").html('<div class="alert alert-success" id="alert">' + response + '</div>');
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 3000);

            $("#add").hide();

        }
    });
});
//-------------------------------------------Registrar Nueva Categoria---------------------------------

//--------------------------------------- registrar nuevo producto---------------------------------
function registrarProductos() {
    $("#formularioP").on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "?controlador=Producto&accion=registrarProducto",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#alertControl1").html('<div class="alert alert-success" id="alert"> Procesando... </div>');
                window.setTimeout(function () {
                    $(".alert").fadeTo(500, 0).slideUp(500, function () {
                        $(this).remove();
                    });
                }, 3000);
            },
            success: function (response) {
                $("#alertControl1").html('<div class="alert alert-success" id="alert">' + response + '</div>');

                window.setTimeout(function () {
                    $(".alert").fadeTo(500, 0).slideUp(500, function () {
                        $(this).remove();
                    });
                }, 3000);

            }
        });
    });
};
//--------------------------------------- registrar nuevo producto---------------------------------

