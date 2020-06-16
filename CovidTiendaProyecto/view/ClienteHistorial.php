<?php
include_once "public/header.php";
?>

<script type="text/javascript" src="public/js/clienteHistorial.js"></script>

<div class="container col-12">
    <div class="row justify-content-center"style="margin-top:3% ;">
        <div class="col-md-4" >
            <table id="ventaTable" class="table display nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th style="display: none">ID</th>
                        <th>Usuario</th>
                        <th>Total</th>
                        <th>Fecha de venta</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="col-md-4" id="productos" style="display: none">
            <table id="ventaProductoTable" class="table display nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Total</th>

                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

</div>

</body>