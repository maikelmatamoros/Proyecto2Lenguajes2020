<?php
include_once "public/header.php";
?>

<script type="text/javascript" src="public/js/combos.js"></script>

<div class="row justify-content-center">
    <div class="card col-md-6">
        <div class="card-header">Arme su combo...</div>
        <div class="card-body">
            <table id="productosTable" class="table table-bordered display" style="width:100%">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Descripcion</th>
                        <th>Categoria</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <div class="card col-md-4" >
        <div class="card-header">Arme su combo...</div>
        <div class="card-body">
            <div class="form-group" style="margin: auto;">
                <div class="row">
                    <div class=" col-md-12">
                        <label for="usr">Rango de Fechas:</label>
                        <input class="form-control" type="text" name="daterange" id="rangoFechas" value="01/01/2018 - 01/15/2018" />
                    </div>
                </div>
                <div class="row">
                    <div class=" col-md-12">
                        <label for="usr">Descuento:</label>
                        <input class="form-control" type="number" id="Descuento" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary center-block " id="addPromociones" style="width: 100%;margin-top: 5%;">
                            Añadir Promociones
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="AlertControl"></div>
                </div>
                
            </div>
        </div>


    </div>
</div>
</div>