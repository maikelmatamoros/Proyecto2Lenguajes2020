let productoPromociones;
let productoPos;
let cantCarrito=0;
let cantidad=0;
let productoVenta = [];

$(document).ready(function () {
    cargarProductos();
    obtenerCategorias();
    $('#selectOrder').change(function () {
        if ($('#selectOrder').val() == "D") {
            //order desc
            productosSubBusqueda=productosSubBusqueda.sort(function (a, b){
                return (b[3] - a[3])
            });
            cargarPagina(productosSubBusqueda);
            $('#selectOrder').val(0); 
            
        } else {
            //order asc
            productosSubBusqueda=productosSubBusqueda.sort(function (a, b) {
                return (a[3] - b[3])
            });
            cargarPagina(productosSubBusqueda);
        }
    })
    $.ajax({
        type: 'POST',
        url: "?controlador=Producto&accion=obtenerCantidadCarrito",
        success: function (response) {
            cantCarrito=parseInt(response);
            $("#carrito").text(cantCarrito);
        }
    });
});

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


$(document).on("click","#btnInfoPConfirm",function(){
    $("#modalPago").modal("show");
    alert(cantidad);
});



$(document).on("click","#mas",function(){
    cantidad++;
    $("#cantidad").html(cantidad);
    $("#totalC").html("Total: $"+productoPromociones.data[productoPos][3]*cantidad);
});

$(document).on("click","#menos",function(){
    if(cantidad>0){
        cantidad--;
    }
    $("#cantidad").html(cantidad);
    $("#totalC").html("Total: $"+productoPromociones.data[productoPos][3]*cantidad);
});


$('body').on('click', '.btoncompra', function () {

    productoPos = $(this).attr('id');
    
    if(productoPromociones.data[productoPos][10] == 'I'){
        productoVenta.push(productoPromociones.data[productoPos][0], productoPromociones.data[productoPos][3],0);
    }else{
        productoVenta.push(productoPromociones.data[productoPos][0], productoPromociones.data[productoPos][3],
            productoPromociones.data[productoPos][7]);
    }
    
    agregarCartaCompraProducto(productoPos,productosSubBusqueda);
    $("#cantidad").html(cantidad);
    $("#totalC").html("Total: $"+productoPromociones.data[productoPos][3]*cantidad);
    $("#modalInfoP").modal("show");

});

function pagar(){
     $.ajax({
        type: 'POST',
        url: "?controlador=Producto&accion=generarCompraDirecta",
        data: {
            "Producto": JSON.stringify(productoVenta),
            "Cantidad": cantidad
        },
        beforeSend: function () {
            $("#mensaje").html("Procesando...");
            $("#modalMensaje").modal("show");
        },
        success: function (response) {
            $("#mensaje").html(JSON.stringify(productoVenta));
            productoVenta=[];
        }
    });
}



$('body').on('click', '.btoncarrito', function () {
    $.ajax({
        type: 'POST',
        url: "?controlador=Producto&accion=agregarAlCarrito",
        data: { "ID": productoPromociones.data[$(this).attr('id')][0] },
        beforeSend: function () {

        },
        success: function (response) {
            if(response.length==3){
                cantCarrito++;
                $("#carrito").html(cantCarrito);
            }

        }
    });

});

$('body').on('click','.like', function () {
    $.ajax({
        type: 'POST',
        url: "?controlador=Producto&accion=marcarFavorito",
        data: { "ID": productoPromociones.data[$(this).attr('id')][0] },
        success: function (response) {
            console.log(response);

        }
    });
    alert("Favorito: "+$(this).attr('id'));

});


function cargarPagina(productos) {
    $("#contenedor").html("");
    for (let i = 0; i < productos.length; i++) {
        if (productos[i][10] == 'I') {
            $("#contenedor").append(
                '<div class="col-12 col-sm-8 col-md-6 col-lg-4 py-2">' +
                '<div class="card h-100">' +
                '<img class="card-img" src="' + productos[i][4] + '" style="height: 200px;" alt="Vans">' +
                '<div class="card-body">' +
                '<h4 class="card-title">' + productos[i][1] + '</h4>' +
                '<h6 class="card-subtitle mb-2 text-muted">Categoria: ' + productos[i][5] + '</h6>' +
                '<p class="card-text">' +
                productos[i][2]
                + '</p>' +

                '<div class="buy d-flex justify-content-between align-items-center">' +
                '<div class="price">' +
                '<h5 class="mt-1">$' + productos[i][3] + ' </h5>' +
                '</div>' +
                '</div>' +
                '<div class="buy d-flex justify-content-end">' +
                '<button class="btn btn-danger mt-3 btoncarrito" id="' + i + '"><i class="fa fa-cart-plus" aria-hidden="true"></i> Añadir </button>' +
                '<button class="btn btn-danger mt-3 ml-3 btoncompra" id="' + i + '"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Comprar </button>' +

                '<a href="#" class="card-link text-danger like mt-3 ml-3" id="'+i+'" style="font-size: 1.5em;">' +
                '<i class="fas fa-heart"></i>' +
                '</a>' +
                '</div>' +
                '</div>' +
                '</div>');
        } else {
            $("#contenedor").append(
                '<div class="col-12 col-sm-8 col-md-6 col-lg-4 py-2">' +
                '<div class="card h-100 text-white bg-info">' +
                '<img class="card-img" src="' + productos[i][4] + '" style="height: 200px;" alt="Vans">' +
                '<div class="card-body">' +
                '<h4 class="card-title">' + productos[i][1] + '-Promocion</h4>' +
                '<h6 class="card-subtitle mb-2 text-muted">Categoria: ' + productos[i][5] + '</h6>' +
                '<p class="card-text">' +
                productos[i][2]
                + '</p>' +

                '<div class="buy d-flex justify-content-between align-items-center">' +
                '<div class="price text-white">' +
                '<h5 class="mt-1">Antes: $' + productos[i][3] + ' </h5>' +
                '<h5>Ahora: $' + productos[i][6] + ' </h5>' +
                '</div>' +
                '</div>' +
                '<div class="buy d-flex justify-content-end">' +
                '<button class="btn btn-danger mt-3 btoncarrito" id="' + i + '"><i class="fa fa-cart-plus" aria-hidden="true"></i> Añadir </button>' +
                '<button class="btn btn-danger mt-3 ml-3 btoncompra" id="' + i + '"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Comprar </button>' +
                '<a href="#" class="card-link text-danger like mt-3 ml-3" id="'+i+'" style="font-size: 1.5em;">' +
                '<i class="fas fa-heart"></i>' +
                '</a>' +
                '</div>' +
                '</div>' +
                '</div>');
        }


    }
};

$(document).on("click","#btnN",function(){
    $("#botones").css("display","none");
    $("#divNombre").css("display","block");
});

$(document).on("click","#btnC",function(){
    $("#botones").css("display","none");
    $("#divCategoria").css("display","block");
})

$(document).on("click",".back",function(){
    $("#botones").css("display","block");
    $("#divCategoria").css("display","none");
    $("#divNombre").css("display","none");

});


function agregarCartaCompraProducto(i,productos){
    if (productos[i][10] == 'I') {
        $("#Producto").html(
            '<div class="col-12 py-2">' +
            '<div class="card h-100">' +
            '<img class="card-img" src="' + productos[i][4] + '" style="height: 200px;" alt="Vans">' +
            '<div class="card-body">' +
            '<h4 class="card-title">' + productos[i][1] + '</h4>' +
            '<h6 class="card-subtitle mb-2 text-muted">Categoria: ' + productos[i][5] + '</h6>' +
            '<p class="card-text">' +
            productos[i][2]
            + '</p>' +

            '<div class="buy d-flex justify-content-between align-items-center">' +
            '<div class="price">' +
            '<h5 class="mt-1">$' + productos[i][3] + ' </h5>' +
            '<div class="row">'+
            '<a href="#" id="menos" class="card-link text-danger like mt-3 ml-3" style="font-size: 2em;">' +
            '<i class="fas fa-angle-left"></i>' +
            '</a>'+
            '<h4 class="mt-4 ml-3" id="cantidad" style="font-size: 1.5em;">5</h4>'+
            '<a href="#" id="mas" class="card-link text-danger like mt-3 ml-3" style="font-size: 2em;">' +
            '<i class="fas fa-angle-right"></i>' +
            '</a>'+
            '<h4 class="mt-4 ml-3" id="totalC" style="font-size: 1.5em;"></h4>'+
            '</div>'+
            
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>');
    } else {
        $("#Producto").html(
            '<div class="col-12 py-2">' +
            '<div class="card h-100 text-white bg-info">' +
            '<img class="card-img" src="' + productos[i][4] + '" style="height: 200px;" alt="Vans">' +
            '<div class="card-body">' +
            '<h4 class="card-title">' + productos[i][1] + '-Promocion</h4>' +
            '<h6 class="card-subtitle mb-2 text-muted">Categoria: ' + productos[i][5] + '</h6>' +
            '<p class="card-text">' +
            productos[i][2]
            + '</p>' +

            '<div class="buy d-flex justify-content-between align-items-center">' +
            '<div class="price text-white">' +
            '<h5 class="mt-1">Antes: $' + productos[i][3] + ' </h5>' +
            '<h5>Ahora: $' + productos[i][6] + ' </h5>' +
            '<div class="row">'+
            '<a href="#" id="menos" class="card-link text-body like mt-3 ml-3" style="font-size: 2em;">' +
            '<i class="fas fa-angle-left"></i>' +
            '</a>'+
            '<h4 class="mt-4 ml-3" id="cantidad" style="font-size: 1.5em;">5</h4>'+
            '<a href="#" id="mas" class="card-link text-body like mt-3 ml-3" style="font-size: 2em;">' +
            '<i class="fas fa-angle-right"></i>' +
            '</a>'+
            '<h4 class="mt-4 ml-3" id="totalC" style="font-size: 1.5em;"></h4>'+
            '</div>'+
            '</div>' +
            '</div>' +
            
            '</div>' +
            '</div>');
    }
}
let productosSubBusqueda=[];

$(document).on("click","#btnBuscarPorCategoria",function(){
    productosSubBusqueda=[];
    let categoriaText=$("#select option:selected").text();
    for(let i=0;i<productoPromociones.data.length;i++){
        alert(productoPromociones.data[i][5]+" "+categoriaText); 
        if(productoPromociones.data[i][5].includes(categoriaText)){
            productosSubBusqueda.push(productoPromociones.data[i]);
         }

    }
    cargarPagina(productosSubBusqueda);
});

$(document).on("click","#btnBuscarPorNombre",function(){
    productosSubBusqueda=[];
    let nombre=$("#Nombre").val().toUpperCase();
    for(let i=0;i<productoPromociones.data.length;i++){ 
        if(productoPromociones.data[i][1].toUpperCase().includes(nombre)){
            productosSubBusqueda.push(productoPromociones.data[i]);
        }

    }
    cargarPagina(productosSubBusqueda);
});

function cargarProductos() {
    $.ajax({
        type: 'POST',
        url: "?controlador=Producto&accion=obtenerProductosMasPromociones",
        success: function (response) {
            productoPromociones = JSON.parse(response);
        }
    });
}