let fechaInicio;
let fechaFinal;
$(document).ready(function(){
    $("#ventaTable").DataTable();
    $("#ventaProductoTable").DataTable();
    var ano = (new Date).getFullYear();
    
    for(let i=2000;i<=parseInt(ano);i++){
        $("#select-anno").append('<option value="'+i+'">'+i+'</option>');
    }
    $('#select-anno').selectpicker('refresh');

    $('#rangoFechas').daterangepicker({
        "startDate": "06/04/2020",
        "endDate": "06/10/2020",
        "opens": "center"
    }, function(start, end, label) {
        fechaInicio=start.format('YYYY-MM-DD');
        fechaFinal=end.format('YYYY-MM-DD');
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

        }else{
            $("#productos").css("display","none");
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



$(document).on("click","#btnBuscarPorMesAno",function(){
    $("#ventaTable").DataTable({
        "responsive": true,
        "scrollX": true,
        "destroy": true,
        "ajax": {
            "method": "POST",
            "url": "?controlador=Producto&accion=obtenerVentasMesAnno",
            "data": {"Mes":$("#select-mes option:selected").val(), "Anno": $("#select-anno option:selected").val()},
        },
        "columns": [
            { "data": '0', "visible": false },
            { "data": '1', "className": "text-center" },
            { "data": '2', "className": "text-center" },
            { "data": '3', "className": "text-center" }
        ]
    });
});

$(document).on("click","#btnMA",function(){
    $("#botones").css("display","none");
    $("#divMesAnno").css("display","block");
});

$(document).on("click","#btnR",function(){
    $("#botones").css("display","none");
    $("#divRangos").css("display","block");
})

$(document).on("click",".back",function(){
    $("#botones").css("display","block");
    $("#divMesAnno").css("display","none");
    $("#divRangos").css("display","none");

});



$(document).on("click","#btnBuscarPorRango",function(){
    $("#ventaTable").DataTable({
        "responsive": true,
        "scrollX": true,
        "destroy": true,
        "ajax": {
            "method": "POST",
            "url": "?controlador=Producto&accion=obtenerVentasPorRango",
            "data": {"FechaI":fechaInicio, "FechaF":fechaFinal},
        },
        "columns": [
            { "data": '0', "visible": false },
            { "data": '1', "className": "text-center" },
            { "data": '2', "className": "text-center" },
            { "data": '3', "className": "text-center" }
        ]
    });
    
});


