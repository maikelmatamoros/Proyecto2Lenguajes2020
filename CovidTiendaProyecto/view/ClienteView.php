<?php
include_once "public/header.php";
?>

<script type="text/javascript" src="public/js/indexClient.js"></script>

<div class="jumbotron jumbotron-fluid">
  <div class="container align-items-center">
    <h2>Encuentra todo lo que necesitas para protegerte a ti y a los tuyos</h1>
    <p>Recuerda, esta batalla la ganamos entre todos...</p>
  </div>
</div>


<div class="container d-flex justify-content-center">
<div class="row">
    <h4>Productos Recomendados</h4>
</div>
</div>

<div class="container">
    <div class="row " id="contenedor">
        
    </div>
</div>
<?php
    include_once "public/modalInfoProducto.php";
    include_once "public/modalPago.php";
    include_once "public/modalMensaje.php";
?>