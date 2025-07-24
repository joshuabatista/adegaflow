<?php
    session_start();
    $adega_id = $_SESSION['adega_id'];
    $adega_nome = $_SESSION['adega_nome'];
    require 'conection.php';
    require '../../../../src/includes/head.php';
    require '../../../../app/functions.php';
    date_default_timezone_set('America/Sao_Paulo');
?>