<?php

require __DIR__ . '../../../../../public_html/config/bootstrap-backend.php';

$pdo->beginTransaction();

$data_entrada = $_POST['data_entrada'];
$quantidade = $_POST['quantidade'];
$produto = $_POST['produto'];
$plano_contas = $_POST['plano_contas'];
$valor_compra = $_POST['valor_compra'];
$valor_venda = $_POST['valor_venda'];
$valor_total_compra = $valor_compra * $quantidade;

$erro = '';

$erro .= empty($data_entrada) ? '<br/> informe a <strong>data de entrada</strong>' : '';
$erro .= empty($quantidade) ? '<br/> informe a <strong>quantidade</strong>' : '';
$erro .= empty($produto) ? '<br/> informe o <strong>produto</strong>' : '';
$erro .= empty($valor_compra) ? '<br/> informe o <strong>valor da compra</strong>' : '';
$erro .= empty($plano_contas) ? '<br/> informe o <strong>plano de contas</strong>' : '';
$erro .= empty($valor_venda) ? '<br/> informe o <strong>valor de venda</strong>' : '';

if(!empty($erro)){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=> $erro
    ]);
}


$sql = "INSERT INTO produtos SET
        adega_id = ?,
        produto = ?,
        plano_contas = ?,
        quantidade = ?,
        valor_compra = ?,
        valor_total_compra = ?,
        valor_venda = ?,
        data_entrada = ?";

$columns = [
    $adega_id,
    $produto,
    $plano_contas,
    $quantidade,
    $valor_compra,
    $valor_total_compra,
    $valor_venda,
    $data_entrada
];

$query = prepare($sql, $columns);

if(!empty($query->exception)){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Erro ao adicionar produto, contate o suporte tecnico'
    ]);
}

$pdo->commit();

response([
    'status'=>true
]);



