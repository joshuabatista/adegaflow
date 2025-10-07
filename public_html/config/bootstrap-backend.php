<?php
    require 'conection.php';
    require '../../../../app/functions.php';
    date_default_timezone_set('America/Sao_Paulo');
    
    session_start();

    $adega_id = $_SESSION['adega_id'];

    if(empty($adega_id)){
        response([
            'status'=>false
        ]);
    }
    
?>