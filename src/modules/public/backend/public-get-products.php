<?php
require __DIR__ . '../../../../../public_html/config/bootstrap-backend.php';

$produto = $_GET['produto'] ?? null;
$data_entrada_de = $_GET['data_entrada_de'] ?? null;
$data_entrada_ate = $_GET['data_entrada_ate'] ?? null;
$plano_contas = $_GET['plano_contas'] ?? null;

$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

$limit = 7;

$start = max(0, ($page - 1) * $limit);

$and = '';

if(!empty($produto)){
    $and .= " AND p.produto LIKE '%{$produto}%'";
}

if(!empty($data_entrada_de) && !empty($data_entrada_ate)){
    $and .= " AND p.data_entrada BETWEEN '{$data_entrada_de}' AND '{$data_entrada_ate}'";
}

if(!empty($plano_contas)){
    $and .= " AND p.plano_contas = {$plano_contas}";
}

$pdo->beginTransaction();

$sql = "SELECT SQL_CALC_FOUND_ROWS p.produto_id, p.produto, pc.descricao plano_contas, p.quantidade, p.valor_compra, p.valor_total_compra, p.valor_venda, DATE_FORMAT(p.data_entrada, '%d/%m/%Y') data_entrada
        FROM produtos p
        LEFT JOIN plano_contas_analitico pc ON pc.codigo = p.plano_contas
        WHERE p.adega_id = ?
        AND p.quantidade > 0
        $and
        LIMIT $start, $limit";

$query = prepareAll($sql, [$adega_id]);


if(!empty($query->exception)){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Erro ao buscar produtos, contate o suporte tecnico'
    ]);
}

$data = $query->data;

$query = $pdo->query("SELECT FOUND_ROWS()");

$total = $query->fetch(PDO::FETCH_COLUMN);

$pages = ceil($total / $limit);

$pdo->commit();

response([
    'status'=>true,
    'data'=>$data,
    'page' => $page,
    'pages' => $pages,
    'limit' => $limit,
    'total' => number_format($total, 0, ',', '.'),
]);