<?php

require __DIR__ . '../../../../../public_html/config/bootstrap-backend.php';

$pdo->beginTransaction();

$produto_id = $_GET['produto'] ?? null;
$qtd_venda = $_GET['qtd'] ?? null;
$valor_venda = (int)$_GET['valor_venda'] ?? null;

if(empty($produto_id)||empty($qtd_venda)||empty($valor_venda)){
    $pdo->rollback();
    response([ 
        'status'=>false,
        'message'=>'Erro ao buscar produto, contate o suporte tecnico'
    ]);
}

$sql = "SELECT quantidade, valor_venda
        FROM produtos 
        WHERE produto_id = ?
        AND adega_id = ? ";

$columns = [
    $produto_id,
    $adega_id
];

$query = prepare($sql, $columns);

if(!empty($query->exception)){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Erro ao buscar produto, contate o suporte tecnico'
    ]);
}

$data = $query->data;

$qtd_estoque = $data->quantidade;
$valor_venda_produto = (int) $data->valor_venda;

if($valor_venda != $valor_venda_produto){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Valor da venda não coincide com o valor cadastrado junto ao produto.',
        'erro'=>'0903'
    ]);
}

if($qtd_venda > $qtd_estoque){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Você esta tentando vender uma quantidade que não tem no Estoque!',
        'erro'=>'0902',
        'estoque'=>$qtd_estoque
    ]);
}

$pdo->commit();

response([
    'status'=>true
]);