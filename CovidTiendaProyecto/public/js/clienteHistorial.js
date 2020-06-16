$(document).ready(function(){
    $("#ventaTable").DataTable({
        "responsive": true,
        "scrollX": true,
        "destroy": true,
        "ajax": {
            "method": "POST",
            "url": "?controlador=Producto&accion=obtenerHistorial",
        },
        "columns": [
            { "data": '0', "visible": false },
            { "data": '1', "className": "text-center" },
            { "data": '2', "className": "text-center" },
            { "data": '3', "className": "text-center" }
        ]
    });
    seleccionarVenta();
});

let ventaSeleccionada=-1;
let activo=-1;
function seleccionarVenta() {

    $('#ventaTable tbody').on('click', 'tr', function () {
        let table = $('#ventaTable').DataTable();
        let data = table.row(this).data();
        if ($("tr").hasClass('filaseleccionada')) {
            $("tr").removeClass('filaseleccionada');
            $(this).addClass('filaseleccionada');
            ventaSeleccionada = data[0];
        } else {
            $(this).addClass('filaseleccionada');
            ventaSeleccionada = data[0];
        }

        if (activo != ventaSeleccionada) {
            activo = ventaSeleccionada;
            $("#productos").css("display","block");            
            listarVentaInfo();

        }
    });
};

function listarVentaInfo(){
    $("#ventaProductoTable").DataTable({
        "responsive": true,
        "scrollX": true,
        "destroy": true,
        "ajax": {
            "method": "POST",
            "url": "?controlador=Producto&accion=obtenerVentasProductos",
            "data": {"ventaID":ventaSeleccionada},
        },
        "columns": [
            { "data": '0', "className": "text-center" },
            { "data": '1', "className": "text-center" },
            { "data": '2', "className": "text-center" }
        ]
    });
}
