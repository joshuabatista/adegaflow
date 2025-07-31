<?php

require __DIR__ . '../../../../../public_html/config/bootstrap-backend.php';

$pdo->beginTransaction();

$data_venda = $_POST['data_venda'] ?? null;
$carrinho = $_POST['carrinho'];
$venda_id = rand(100000, 999999);

if(empty($carrinho)) {
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Carrinho vazio'
    ]);
}

if(empty($data_venda)){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Informe a data de venda'
    ]);
}

$sql = "INSERT INTO vendas 
        (venda_id, adega_id, produto_id, qtd, valor_total) 
        VALUES (?, ?, ?, ?, ?)";

foreach ($carrinho as $produto) {
    $columns = [
        $venda_id,
        $adega_id,
        $produto['id'],
        $produto['quantidade'],
        floatval($produto['valor'])
    ];

    $query = prepare($sql, $columns); 

    if (!empty($query->exception)) {
        $pdo->rollback();
        response([
            'status' => false,
            'message' => 'Erro ao salvar item, contate o suporte tecnico',
        ]);
    }
}

$pdo->commit();

response([
    'status' => true,
    'message' => 'Venda registrada com sucesso!',
]);