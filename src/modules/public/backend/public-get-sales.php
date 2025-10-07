<?php

require __DIR__ . '../../../../../public_html/config/bootstrap-backend.php';

$data_de = $_GET['data_de'] ?? null;
$data_ate = $_GET['data_ate'] ?? null;
$produto = $_GET['produto'] ?? null;
$plano_contas = $_GET['plano_contas'] ?? null;
$venda_id = $_GET['venda_id'] ?? null;

$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

$limit = 11;

$start = max(0, ($page - 1) * $limit);

$and = '';

if(!empty($data_de) && !empty($data_ate)){
    $and .= " AND v.data_venda BETWEEN '$data_de' AND '$data_ate'";
}

if(!empty($produto)){
    $and .= " AND p.produto LIKE '%$produto%'";
}

if(!empty($plano_contas)) {
    $and .= " AND p.plano_contas = $plano_contas";
}

if(!empty($venda_id)){
    $and .= " AND venda_id LIKE '%$venda_id%'";
}

$sql = "SELECT SQL_CALC_FOUND_ROWS v.venda_id, v.qtd qtd_venda, v.valor_total, v.data_venda, p.produto, pc.descricao, DATE_FORMAT(v.data_venda, '%d/%m/%Y') data_venda_formatada
        FROM vendas v
        LEFT JOIN produtos p ON p.produto_id = v.produto_id
        LEFT JOIN plano_contas_analitico pc ON pc.codigo = p.plano_contas
        WHERE v.adega_id = ?
        $and
        ORDER BY v.created_at desc
        LIMIT $start, $limit";

$query = prepareAll($sql, [$adega_id]);

if(!empty($query->exception)){
    response([
        'status'=>false,
        'message'=>'Erro ao buscar vendas, contate o suporte tecnico.'
    ]);
}

$data = $query->data;

$query = $pdo->query("SELECT FOUND_ROWS()");

$total = $query->fetch(PDO::FETCH_COLUMN);

$pages = ceil($total / $limit);

response([
    'status'=>true,
    'data'=>$data,
    'page' => $page,
    'pages' => $pages,
    'limit' => $limit,
    'total' => number_format($total, 0, ',', '.'),
]);