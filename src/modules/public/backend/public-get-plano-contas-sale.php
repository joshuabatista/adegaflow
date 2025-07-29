<?php

require __DIR__ . '../../../../../public_html/config/bootstrap-backend.php';

$pdo->beginTransaction();

$product_id = $_GET['produto_id'];

if(empty($product_id)){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Erro ao buscar plano de contas, contate o suporte tecnico'
    ]);
}

$sql = "SELECT pca.descricao, p.valor_venda
        FROM produtos p
        LEFT JOIN plano_contas_analitico pca ON pca.codigo = p.plano_contas 
        WHERE p.produto_id = ?
        AND p.adega_id = ?";

$query = prepare($sql, [$product_id, $adega_id]);

if(!empty($query->exception)){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Erro ao buscar plano de contas, contate o suporte tecnico'
    ]);
}

$data = $query->data;

$pdo->commit();

response([
    'status'=>true,
    'data'=>$data
]);

