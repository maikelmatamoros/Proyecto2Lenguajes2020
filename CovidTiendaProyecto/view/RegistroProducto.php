<?php
include_once "public/header.php";
?>
<script type="text/javascript" src="public/js/producto.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="card" style="margin: auto; ">
            <div class="card-header">Datos del producto</div>
            <div class="card-body">
                <form autocomplete="off" class="form" method="?controlador=Producto&accion=registrarProducto" id="formularioP" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Nombre</label>
                        <div class="col-lg-9">
                            <input class="form-control" id="Nombre" name="Nombre" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Precio</label>
                        <div class="col-lg-9">
                            <input class="form-control" id="Precio" name="Precio" type="number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Descripción</label>
                        <div class="col-lg-9">
                            <input class="form-control" id="Descripcion" name="Descripcion" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="imagen" id="customFile">
                            <label class="custom-file-label" for="imagen">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Cantidad</label>
                        <div class="col-md-9" style="margin-bottom: 1%; width: 100%">
                            <select name="select" class="selectpicker" data-live-search="true" id="select" title="Seleccione una categoría...">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12" id="alertControl1"></div>

                    <button type="submit" class="btn btn-primary center-block " id="btnAddProducto" style="width: 100%;margin-top: 5%;">
                        Aceptar
                    </button>
                </form>
                <div class="row" id="add" style="display: none">
                    <label class="col-lg-3 col-form-label form-control-label " style="margin-top: 3%">Categoria</label>
                    <div class="col-lg-6" style="margin-top: 3%">
                        <input class="form-control" id="Categoria" name="Categoria" type="text">
                    </div>
                    <button class="btn btn-info col-md-3" id="CategoriaAdd" style="margin-top: 3%">Añadir</button>
                    <div class="col-md-12" id="alertControl"></div>
                </div>

            </div>

        </div>

    </div>
</div>

</body>

</html>