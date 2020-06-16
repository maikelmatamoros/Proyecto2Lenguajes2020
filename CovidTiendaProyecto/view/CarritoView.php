<?php 
    include_once "public/header.php";
?>

<script type="text/javascript" src="public/js/carrito.js"></script>

<div class="table-responsive col-md-12">
    <table id="carritoTable" class="table display nowrap" style="width: 100%">
        <thead>
            <tr>
                <th> ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descuento Actual</th>
                <th>Imagen</th>
                <th>Cantidad?</th>
                <th>Total</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <div class="row">
        <div class="col-md-4">
        <h4 class="ml-3" id="total">Total: $0 </h4>
        </div>
        <div class="col-md-8">
            <button class="btn btn-info" id="Comprar">Comprar</button>
        </div>
    </div> 
</div>

<?php 
include_once "public/modalPago.php";
?>