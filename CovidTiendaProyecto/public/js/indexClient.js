let productoRecomendados = [];
let productoPos;
let cantCarrito=0;
let cantidad=0;
let productoVenta = [];

$(document).ready(function () {
    cargarProductos();
    $.ajax({
        type: 'POST',
        url: "?controlador=Producto&accion=obtenerCantidadCarrito",
        success: function (response) {
            cantCarrito=parseInt(response);
            $("#carrito").text(cantCarrito);
        }
    });
});



$(document).on("click","#btnInfoPConfirm",function(){
    $("#modalPago").modal("show");
    alert(cantidad);
});

productoRecomendados

function cargarProductos() {
    $.ajax({
        type: 'POST',
        url: "?controlador=Producto&accion=obtenerProductosRecomendados",
        success: function (response) {
            productoRecomendados = JSON.parse(response);
            cargarPagina();
        }
    });
}

function cargarPagina() {
    alert(JSON.stringify(productoRecomendados));

    for (let i = 0; i < productoRecomendados.data.length; i++) {
        if (productoRecomendados.data[i][6] == null) {
            $("#contenedor").append(
                '<div class="col-12 col-sm-8 col-md-6 col-lg-4 py-2">' +
                '<div class="card h-100">' +
                '<img class="card-img" src="' + productoRecomendados.data[i][4] + '" style="height: 200px;" alt="Vans">' +
                '<div class="card-body">' +
                '<h4 class="card-title">' + productoRecomendados.data[i][1] + '</h4>' +
                '<h6 class="card-subtitle mb-2 text-muted">Categoria: ' + productoRecomendados.data[i][5] + '</h6>' +
                '<p class="card-text">' +
                productoRecomendados.data[i][2]
                + '</p>' +

                '<div class="buy d-flex justify-content-between align-items-center">' +
                '<div class="price">' +
                '<h5 class="mt-1">$' + productoRecomendados.data[i][3] + ' </h5>' +
                '</div>' +
                '</div>' +
                '<div class="buy d-flex justify-content-end">' +
                '<button class="btn btn-danger mt-3 btoncarrito" id="' + i + '"><i class="fa fa-cart-plus" aria-hidden="true"></i> Añadir </button>' +
                '<button class="btn btn-danger mt-3 ml-3 btoncompra" id="' + i + '"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Comprar </button>' +

                '<a href="#" class="card-link text-danger like mt-3 ml-3" id="' + i + '" style="font-size: 1.5em;">' +
                '<i class="fas fa-heart"></i>' +
                '</a>' +
                '</div>' +
                '</div>' +
                '</div>');
        } else {
            let precioDesc=parseInt(productoRecomendados.data[i][3])-(parseInt(productoRecomendados.data[i][3])*(parseInt(productoRecomendados.data[i][6])*0.01));
            $("#contenedor").append(
                '<div class="col-12 col-sm-8 col-md-6 col-lg-4 py-2">' +
                '<div class="card h-100 text-white bg-info">' +
                '<img class="card-img" src="' + productoRecomendados.data[i][4] + '" style="height: 200px;" alt="Vans">' +
                '<div class="card-body">' +
                '<h4 class="card-title">' + productoRecomendados.data[i][1] + '-Promocion</h4>' +
                '<h6 class="card-subtitle mb-2 text-muted">Categoria: ' + productoRecomendados.data[i][5] + '</h6>' +
                '<p class="card-text">' +
                productoRecomendados.data[i][2]
                + '</p>' +

                '<div class="buy d-flex justify-content-between align-items-center">' +
                '<div class="price text-white">' +
                '<h5 class="mt-1">Antes: $' + productoRecomendados.data[i][3] + ' </h5>' +
                '<h5>Ahora: $' +precioDesc+ ' </h5>' +
                '</div>' +
                '</div>' +
                '<div class="buy d-flex justify-content-end">' +
                '<button class="btn btn-danger mt-3 btoncarrito" id="' + i + '"><i class="fa fa-cart-plus" aria-hidden="true"></i> Añadir </button>' +
                '<button class="btn btn-danger mt-3 ml-3 btoncompra" id="' + i + '"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Comprar </button>' +
                '<a href="#" class="card-link text-danger like mt-3 ml-3" id="' + i + '" style="font-size: 1.5em;">' +
                '<i class="fas fa-heart"></i>' +
                '</a>' +
                '</div>' +
                '</div>' +
                '</div>');
        }
    }
};

$('body').on('click', '.btoncarrito', function () {
    $.ajax({
        type: 'POST',
        url: "?controlador=Producto&accion=agregarAlCarrito",
        data: { "ID": productoRecomendados.data[$(this).attr('id')][0] },
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
        data: { "ID": productoRecomendados.data[$(this).attr('id')][0] },
        success: function (response) {
            console.log(response);

        }
    });
    alert("Favorito: "+$(this).attr('id'));

});

$('body').on('click', '.btoncompra', function () {

    productoPos = $(this).attr('id');
    if(productoRecomendados.data[productoPos][6] == null){
        productoVenta.push(productoRecomendados.data[productoPos][0], productoRecomendados.data[productoPos][3],0);
    }else{
        productoVenta.push(productoRecomendados.data[productoPos][0], productoRecomendados.data[productoPos][3],
            productoRecomendados.data[productoPos][6]);
    }

    
    agregarCartaCompraProducto(productoPos);
    $("#cantidad").html(cantidad);
    $("#totalC").html("Total: $"+productoRecomendados.data[productoPos][3]*cantidad);
    $("#modalInfoP").modal("show");

});

let totalCompraDirecta=0;
$(document).on("click","#mas",function(){
    cantidad++;
    $("#cantidad").html(cantidad);

    if(productoRecomendados.data[productoPos][6]==null){
        totalCompraDirecta=productoRecomendados.data[productoPos][3]*cantidad;
    }else{
        totalCompraDirecta=(parseInt(productoRecomendados.data[productoPos][3])-(parseInt(productoRecomendados.data[productoPos][3])*(parseInt(productoRecomendados.data[productoPos][6])*0.01)))*cantidad;
    }
    $("#totalC").html("Total: $"+totalCompraDirecta);
});

$(document).on("click","#menos",function(){
    if(cantidad>0){
        cantidad--;
    }  
    $("#cantidad").html(cantidad);
    if(productoRecomendados.data[productoPos][6]==null){
        totalCompraDirecta=productoRecomendados.data[productoPos][3]*cantidad;
    }else{
        totalCompraDirecta=(parseInt(productoRecomendados.data[productoPos][3])-(parseInt(productoRecomendados.data[productoPos][3])*(parseInt(productoRecomendados.data[productoPos][6])*0.01)))*cantidad;
    }
    $("#totalC").html("Total: $"+totalCompraDirecta);
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
};

function agregarCartaCompraProducto(i){
    if (productoRecomendados.data[i][6] == null) {
        $("#Producto").html(
            '<div class="col-12 py-2">' +
            '<div class="card h-100">' +
            '<img class="card-img" src="' + productoRecomendados.data[i][4] + '" style="height: 200px;" alt="Vans">' +
            '<div class="card-body">' +
            '<h4 class="card-title">' + productoRecomendados.data[i][1] + '</h4>' +
            '<h6 class="card-subtitle mb-2 text-muted">Categoria: ' + productoRecomendados.data[i][5] + '</h6>' +
            '<p class="card-text">' +
            productoRecomendados.data[i][2]
            + '</p>' +

            '<div class="buy d-flex justify-content-between align-items-center">' +
            '<div class="price">' +
            '<h5 class="mt-1">$' + productoRecomendados.data[i][3] + ' </h5>' +
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
        let precioDesc=parseInt(productoRecomendados.data[i][3])-(parseInt(productoRecomendados.data[i][3])*(parseInt(productoRecomendados.data[i][6])*0.01));
        $("#Producto").html(
            '<div class="col-12 py-2">' +
            '<div class="card h-100 text-white bg-info">' +
            '<img class="card-img" src="' + productoRecomendados.data[i][4] + '" style="height: 200px;" alt="Vans">' +
            '<div class="card-body">' +
            '<h4 class="card-title">' + productoRecomendados.data[i][1] + '-Promocion</h4>' +
            '<h6 class="card-subtitle mb-2 text-muted">Categoria: ' + productoRecomendados.data[i][5] + '</h6>' +
            '<p class="card-text">' +
            productoRecomendados.data[i][2]
            + '</p>' +

            '<div class="buy d-flex justify-content-between align-items-center">' +
            '<div class="price text-white">' +
            '<h5 class="mt-1">Antes: $' + productoRecomendados.data[i][3] + ' </h5>' +
            '<h5>Ahora: $' + precioDesc + ' </h5>' +
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



