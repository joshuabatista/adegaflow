<?php

require __DIR__ . '../../../../../public_html/config/bootstrap-backend.php';

$pdo->beginTransaction();

$data_venda = $_POST['data_venda'] ?? null;
$carrinho = $_POST['carrinho'];
$venda_id = rand(100000000, 999999999);

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

foreach ($carrinho as $produto) {
    $produto_id = $produto['id'];
    $qtd_venda = $produto['quantidade'];

    $sql = "SELECT quantidade
            FROM produtos 
            WHERE produto_id = ?
            AND adega_id = ?";

    $columns = [
        $produto_id,
        $adega_id
    ];

    $query = prepare($sql, $columns);

    if(!empty($query->exception)){
        $pdo->rollback();
        response([
            'status'=>false,
            'message'=>'Erro ao dar baixa em quantidade vendida, contate o suporte tecnico'
        ]);
    }

    $data = $query->data;

    $qtd_estoque = $data->quantidade;

    $new_qtd = $qtd_estoque - $qtd_venda ;

    if($new_qtd < 0){
        $pdo->rollback();
        response([
            'status'=>false,
            'message'=>'Você está tentando vender mais produtos do que tem no estoque!'
        ]);
    }
    
    $sql = "UPDATE produtos SET
            quantidade = ?
            WHERE produto_id = ?
            AND adega_id = ?";

    $columns = [
        $new_qtd,
        $produto_id,
        $adega_id
    ];

    $query = prepare($sql, $columns);

    if(!empty($query->exception)){
        $pdo->rollback();
        response([
            'status'=>false,
            'message'=>'Erro ao dar baixa em quantidade de produto, contate o suporte tecnico[2]'
        ]);
    }
}

$pdo->commit();

response([
    'status' => true,
    'message' => 'Venda registrada com sucesso!',
]);