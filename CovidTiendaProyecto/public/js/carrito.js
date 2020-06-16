let productos = [];
let total = 0;

$(document).ready(function () {
    listarCarrito();
    // $.ajax({
    //     type: 'post',
    //     url: "?controlador=Producto&accion=getTipoCambio",
    //     success: function (response) {
    //         console.log(response);

    //     }
    // });

});



$(document).on('click', 'button.eliminarProductoCarrito', function () {

    var table = $("#carritoTable").DataTable();
    var data = table.row($(this).parents('tr')).data();
    table.row($(this).parents('tr')).remove().draw();
    $.ajax({
        url: "?controlador=Producto&accion=eliminarDelCarrito ",
        type: 'POST',
        data: { "ID": data[0] },
        success: function (response) {
            alert(response);
        }
    });

});

$(document).on("change", ".total", function () {
    let table = $("#carritoTable").DataTable();
    let data = table.row($(this).parents('tr')).data();
    let selectedRow = $(this).parents('tr').index();
    let subtotal = table.cell(selectedRow, 5).nodes().to$().find('input').val() * data.producto_precio;
    let precio = subtotal - (subtotal * (data.descuento * 0.01));
    table.cell(selectedRow, 6).data(precio).draw();
    total = 0;
    let rows = $('#carritoTable').dataTable().fnGetData();
    for (var i = 0; i < rows.length; i++) {
        total += parseFloat($('#carritoTable').DataTable().cell(i, 6).nodes().to$().html());
    }
    $("#total").html("Total: $" + total);

});

$(document).on("click", "#Comprar", function () {
    comprar();
});


function comprar() {
    $("#resumen").html('<h4>Resumen de compra</h4><br>');
    let tabla = $('#carritoTable').DataTable();
    var rows = $('#carritoTable').dataTable().fnGetData();

    for (var i = 0; i < rows.length; i++) {
        let id = tabla.cell(i, 0).nodes().to$().html();
        let nombre = tabla.cell(i, 1).nodes().to$().html();
        let descuento = tabla.cell(i, 3).nodes().to$().html();
        let cantidad = tabla.cell(i, 5).nodes().to$().find('input').val();
        let totalProducto = tabla.cell(i, 6).nodes().to$().html();
        productos.push([id, nombre, descuento, cantidad, totalProducto]);
        $("#resumen").append('<h5>' + nombre + ' -- x' + cantidad + ' -- Descuento:' + descuento + ' -- Total:' + totalProducto + '</h5><br><br>');
    }

    $("#modalPago").modal("show");

};

function pagar() {
    var parametros = {
        "Productos": JSON.stringify(productos),
        "Total": total
    };
    $.ajax({
        type: 'POST',
        url: "?controlador=Producto&accion=generarCompra",
        data: parametros,
        success: function (response) {
            alert(response);
            // if (response == "true") {
            //     window.location.href = "?controlador=Producto&accion=checkOut";
            // }
        }
    });
}

function listarCarrito() {
    $("#carritoTable").DataTable({
        "responsive": true,
        "scrollX": true,
        "destroy": true,
        "ajax": {
            "method": "POST",
            "url": "?controlador=Producto&accion=obtenerCarrito"
        },
        "columns": [
            { "data": '0', "visible": false },
            { "data": '1', "className": "text-center" },
            { "data": '2', "className": "text-center" },
            { "data": '4', "className": "text-center" },
            {
                "data": '3', "className": "text-center",
                "render": function (data) {
                    return '<img src="' + data + '" class="img-fluid rounded mx-auto d-block" width="100px" height="20px" alt="Responsive image">';
                }
            },

            { "defaultContent": "<input class=' form-control total' type='number'/>" },
            { "defaultContent": "0" },
            { "defaultContent": "<button type='button' class='eliminarProductoCarrito btn btn-danger'><i class='fas fa-trash-alt'></i></button>" }
        ]
    });
};