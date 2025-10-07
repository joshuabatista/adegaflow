<?php
require __DIR__ . '../../../../../public_html/config/bootstrap-backend.php';

$sql = "SELECT produto_id, quantidade, produto
        FROM produtos
        WHERE adega_id = ?
        AND quantidade > 0";

$query = prepareAll($sql, [$adega_id]);

if(!empty($query->exception)){
    response([
        'status'=>false,
        'message'=>'Erro ao buscar produtos, contate o suporte tecninco'
    ]);
}

$data = $query->data;

response([
    'status'=>true,
    'data'=>$data
]);