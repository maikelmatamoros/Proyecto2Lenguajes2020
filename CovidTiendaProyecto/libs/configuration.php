<?php
    require 'libs/Config.php';
    $config= Config::singleton();
    $config->set('controllerFolder','controller/');
    $config->set('modelFolder', 'model/');
    $config->set('viewFolder', 'view/');
    
    $config->set('dbhost', '163.178.107.10'); // ip
    $config->set('dbname', 'db_b64219_proyecto2_if4101');
    $config->set('dbuser', 'laboratorios');
    $config->set('dbpass', 'UCRSA.118');
    
?>

