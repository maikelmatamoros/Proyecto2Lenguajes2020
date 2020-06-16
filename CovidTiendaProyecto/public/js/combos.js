let fechaI;
let fechaF;


$(document).ready(function(){
    listarProductos();
    seleccionarProductos();

    $('#rangoFechas').daterangepicker({
        "startDate": "06/04/2020",
        "endDate": "06/10/2020",
        "opens": "center"
    }, function(start, end, label) {
        fechaI=start.format('YYYY-MM-DD');
        fechaF=end.format('YYYY-MM-DD');
    });

});

$(document).on('click', '#addPromociones', function () {

    var parametros = {
        "Descuento": $("#Descuento").val(),
        "FechaI": fechaI,
        "FechaF": fechaF,
        "Productos": JSON.stringify(array)
    };

    $.ajax({
        type: 'POST',
        url: "?controlador=Producto&accion=guardarPromociones",
        data: parametros,
        beforeSend: function () {
            $("#AlertControl").html('<div class="alert alert-success" id="alert"> Procesando... </div>');
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 3000);
        },
        success: function (response) {
            $("#AlertControl").html('<div class="alert alert-success col-md-12" id="alert">' + response + '</div>');
            console.log(response);
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 300);
        }
    });
});


let array = [];
function seleccionarProductos() {
    var table = $('#productosTable').DataTable();
    $('#productosTable tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
        if ($(this).hasClass('filaseleccionada')) {
            $(this).removeClass('filaseleccionada');
            array.splice(array.indexOf(data[0]), 1);
        } else {
            $(this).addClass('filaseleccionada');
            array.push([data[0],data[1],data[3]]);
        }
        //alert(JSON.stringify(array));
    });
};

//--------------------------------------------Listar Productos-------------------------------------------------
function listarProductos () {
    $("#productosTable").DataTable({
        "responsive": true,
        "scrollX": true,
        "destroy": true,
        "ajax": {
            "method": "POST",
            "url": "?controlador=Producto&accion=obtenerProductos"
        },
        "columns": [
            {"data": '0', "className": "text-center"},
            {"data": '1', "className": "text-center"},
            {"data": '3', "className": "text-center"},
            {"data": '2',"className": "text-center"},
            {"data": '4',"className": "text-center"},
            {"data": '5', "className": "text-center",
                "render": function (data) {
                    return '<img src="' + data + '" class="img-fluid rounded mx-auto d-block" width="60" height="20" alt="Responsive image">';
                }
            }
        ]
    });
    //colorRow();
};
//--------------------------------------------Listar Productos-------------------------------------------------