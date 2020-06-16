<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script src="https://kit.fontawesome.com/d607ba8689.js" crossorigin="anonymous"></script>


    <title>CovStoreCR</title>

    <style>
        tr.filaseleccionada {

            background-color: cornflowerblue;
        }

        .highlight {
            background: yellow;
        }

        

        th {
            background-color: #4CAF50;
            color: white;
        }


        .card,
        .card-img,
        #carritoTable {
            border-radius: 15px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="?controlador=Producto&accion=mostrarRegistroProductoView">Agregar Producto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?controlador=Producto&accion=mostrarRegistroComboView">Agregar Promocion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?controlador=Usuario&accion=mostrarRegistroUsuarioView">Registrar Administradores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?controlador=Usuario&accion=mostrarAdmVentasView">Ventas</a>
                </li>
            </ul>

        </div>

    </nav>
    <br>