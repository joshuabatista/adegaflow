<?php

require __DIR__ . '../../../../../public_html/config/bootstrap-backend.php';

$pdo->beginTransaction();

$produto_id = $_POST['produto'] ?? null;
$qtd = $_POST['qtd'] ?? null;
$qtd = (int)$qtd;

if(empty($produto_id)||empty($qtd)){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Erro a adicionar produto ao estoque, contate o suporte tecnico[01]'
    ]);
} 

$sql = "SELECT quantidade, valor_compra, valor_total_compra
        FROM produtos
        WHERE produto_id = ?
        AND adega_id = ?";


$query = prepare($sql, [$produto_id, $adega_id]);

if(!empty($query->exception)){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Erro a adicionar produto ao estoque, contate o suporte tecnico[02]'
    ]);
}

$data = $query->data;

$qtd_estoque = $data->quantidade;
$valor_compra = $data->valor_compra;
$valor_total_compra = $data->valor_total_compra;
$compra = $qtd * $valor_compra;
$new_valor_total_compra = $compra + $valor_total_compra;
$new_qtd = $qtd + $qtd_estoque;

$sql = "UPDATE produtos SET
        quantidade = ?,
        valor_total_compra = ?
        WHERE produto_id = ?
        AND adega_id = ?";

$columns = [
    $new_qtd,
    $new_valor_total_compra,
    $produto_id,
    $adega_id
];

$query = prepare($sql, $columns);

if(!empty($query->exception)){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Erro a adicionar produto ao estoque, contate o suporte tecnico[03]'
    ]);
}

$pdo->commit();

response([
    'status'=>true,
    'message'=>'Produto adicionado com sucesso!'
]);