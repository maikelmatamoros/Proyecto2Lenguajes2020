<div class="modal fade" tabindex="-1" id="modalPago">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h1 class="modal-title">Información de pagó</h1>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row" id="resumen">
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="sel1">Tipo de Tarjeta</label>
                        <select class="form-control" id="Tipo">
                            <option>VISA</option>
                            <option>Banco Nacional</option>
                            <option>Banco de Costa Rica</option>
                            <option>Master Card</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <h4>Fecha de Vencimiento y Codigo de Seguridad</h4>
                        <div class="row">

                            <div class="col-md-4">
                                <select class="form-control" id="Mes">
                                    <option>MM</option>
                                    <option>01</option>
                                    <option>02</option>
                                    <option>03</option>
                                    <option>04</option>
                                    <option>05</option>
                                    <option>06</option>
                                    <option>07</option>
                                    <option>08</option>
                                    <option>09</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" id="Año">
                                    <option>YY</option>
                                    <option>2019</option>
                                    <option>2020</option>
                                    <option>2021</option>
                                    <option>2022</option>
                                    <option>2023</option>
                                    <option>2024</option>
                                    <option>2025</option>
                                    <option>2026</option>
                                    <option>2027</option>
                                    <option>2028</option>
                                    <option>2029</option>
                                    <option>2030</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" id="No">
                            </div>

                        </div>
                    </div>
                    <h3> Información De Envio</h3>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="usr">Nombre:</label>
                                <input type="text" class="form-control" id="Nombre">
                            </div>
                            <div class="col-md-6">
                                <label for="usr">Apellidos:</label>
                                <input type="text" class="form-control" id="Apellidos">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="usr">Dirección:</label>
                        <input type="text" class="form-control" id="Dir">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="usr">Código Postal:</label>
                                <input type="number" class="form-control" id="CodPostal">
                            </div>
                            <div class="col-md-6">
                                <label for="usr">Provincia:</label>
                                <select class="form-control" id="Provincia">
                                    <option></option>
                                    <option>Cartago</option>
                                    <option>Heredia</option>
                                    <option>San José</option>
                                    <option>Guanacaste</option>
                                    <option>Puntarenas</option>
                                    <option>Limón</option>
                                    <option>Alajuela</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="usr">Telefono:</label>
                        <input type="phone" class="form-control" id="Telefono">
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-info" onclick='pagar()' data-dismiss="modal">Confirmar</button>
            </div>

        </div>
    </div>
</div>