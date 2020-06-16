<?php
include_once "public/header.php";
?>
<script type="text/javascript" src="public/js/admVentas.js"></script>
<div class="container col-12">
    <div class="row ">
        <div class="col-md-12 justify-content-center" id="botones">
            <button class="btn btn-info " id="btnMA">Buscar por Mes y Año</button>
            <button class="btn btn-info" id="btnR">Buscar por rango de fechas</button>
        </div>
        <div class="col-md-12" id="divMesAnno" style="display: none">
            <select name="select" class="selectpicker" id="select-mes" title="Seleccione un mes...">
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
            <select name="select-anno" class="selectpicker" id="select-anno" title="Seleccione un año...">

            </select>
            <button class="btn btn-info" id="btnBuscarPorMesAno">Buscar</button>
            <button class="btn btn-info back" >Atras</button>

        </div>
        <div class="col-md-12" id="divRangos" style="margin: 1%; display: none">
            <div class="row">
                <label for="usr">Rango de Fechas:</label>
                <div class="col-md-3">
                    <input class="form-control" type="text" name="daterange" id="rangoFechas" value="01/01/2018 - 01/15/2018" />
                </div>
                <button class="btn btn-info" id="btnBuscarPorRango">Buscar</button>
                <button class="btn btn-info back" >Atras</button>
            </div>

        </div>
    </div>
    <div class="row justify-content-center"style="margin-top:3% ;">
        <div class="col-md-4" ">
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