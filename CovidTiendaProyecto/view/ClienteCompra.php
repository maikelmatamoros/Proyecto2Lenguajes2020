<?php
include_once "public/header.php";
?>

<script type="text/javascript" src="public/js/compras.js"></script>

<div class="row ">
    <div class="col-md-12" id="botones">
        <button class="btn btn-info " id="btnN">Buscar Nombre</button>
        <button class="btn btn-info" id="btnC">Buscar por categoria</button>
        
            <select name="selectOrder" class="selectpicker"  id="selectOrder" title="Ordenar...">
                <option value="A">Ascendente</option>
                <option value="D">Decendente</option>
            </select>
        
    </div>
    <div class="col-md-12" id="divNombre" style="margin-left: 1%; display: none">
        <div class="row">
            <label class="col-md-1 col-form-label form-control-label">Nombre</label>
            <div class="col-md-3">
                <input class="form-control" id="Nombre" name="Nombre" type="text">
            </div>
            <button class="btn col-md-1 btn-info" id="btnBuscarPorNombre">Buscar</button>
            <button class="btn col-md-1 btn-info back">Atras</button>
        </div>

    </div>
    <div class="col-md-12" id="divCategoria" style="margin-left: 1%; display: none">
        <div class="row">
            <label class="col-lg-1 col-form-label form-control-label ">Categoria</label>
            <div class="col-lg-3">
                <select name="select" class="selectpicker" data-live-search="true" id="select" title="Seleccione una categoría...">
                </select>
            </div>
            <button class="btn btn-info" id="btnBuscarPorCategoria">Buscar</button>
            <button class="btn btn-info back">Atras</button>
        </div>

    </div>
</div>

<div class="container">
    <div class="row" id="contenedor">


    </div>
</div>
<?php
include_once "public/modalInfoProducto.php";
include_once "public/modalPago.php";
include_once "public/modalMensaje.php";
?>