<?php

require __DIR__ . '../../../../../public_html/config/bootstrap-backend.php';

$today = date("Y-m-d");   

$sql = "SELECT SUM(valor_total) vendas_hoje
        FROM vendas
        WHERE data_venda = '$today'
        AND adega_id = ?";

$query = prepare($sql, [$adega_id]);

if(!empty($query->exception)){
    response([
        'status'=>false,
        'message'=>'Erro ao buscar vendas de hoje'
    ]);
}

$data = (int) $query->data->vendas_hoje;

response([
    'status'=>true,
    'data'=>$data
]);
