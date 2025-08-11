<?php

require __DIR__ . '../../../../../public_html/config/bootstrap-backend.php';

$de = $_GET['de'] ?? null;
$ate = $_GET['ate'] ?? null;


$and = "";
$and_compra = "";

if(!empty($de) && !empty($ate)){
    $and .= " AND data_venda BETWEEN '$de' AND '$ate'";
}

if(!empty($de) && !empty($ate)){
    $and_compra .= " AND data_entrada BETWEEN '$de' AND '$ate'";
}

$sql = "SELECT COUNT(id) qtd_vendas
        FROM vendas
        WHERE adega_id = ?
        $and";

$query = prepare($sql, [$adega_id]);

if(!empty($query->exception)){
    response([
        'status'=>false,
        'message'=>'Erro ao buscar total de vendas, contate o suporte tecnico'
    ]);
}

$qtd_vendas = $query->data->qtd_vendas;

$sql = "SELECT sum(valor_total) receita
        FROM vendas
        WHERE adega_id = ?
        $and";

$query = prepare($sql, [$adega_id]);

if(!empty($query->exception)){
    response([
        'status'=>false,
        'message'=>'Erro ao buscar total de receita, contate o suporte tecnico'
    ]);
}

$receita = (float) $query->data->receita;

$ticket_medio = round($receita / $qtd_vendas, 2);

$sql = "SELECT sum(valor_total_compra) total_compra
        FROM produtos
        WHERE adega_id = ?
        $and_compra";

$query = prepare($sql, [$adega_id]);

if(!empty($query->exception)){
    response([
        'status'=>false,
        'message'=>'Erro ao buscar total de compras, contate o suporte tecnico'
    ]);
}

$compras = (float) $query->data->total_compra;

$lucro_total = (float) $receita - $compras;

$margem_media = round(($lucro_total / $receita) * 100, 2);

$sql = "SELECT SUM(valor_total) total_vendas_mes_anterior
        FROM vendas
        WHERE adega_id = ?
        AND data_venda BETWEEN 
        DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 1 MONTH), '%Y-%m-01')
        AND LAST_DAY(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))";

$query = prepare($sql, [$adega_id]);

if(!empty($query->exception)){
    response([
        'status'=>false,
        'message'=>'Erro ao buscar total de vendas do mes anterior, contate o suporte tecnico'
    ]);
}

$vendas_mes_anterior = (float) $query->data->total_vendas_mes_anterior;

$sql = "SELECT SUM(valor_total) total_vendas_mes_atual
        FROM vendas
        WHERE adega_id = ?
        AND data_venda >= DATE_FORMAT(CURDATE(), '%Y-%m-01')
        AND data_venda <= LAST_DAY(CURDATE())";

$query = prepare($sql, [$adega_id]);

if(!empty($query->exception)){
    response([
        'status'=>false,
        'message'=>'Erro ao buscar total de vendas do mes atual, contate o suporte tecnico'
    ]);
}

$vendas_mes_atual = (float) $query->data->total_vendas_mes_atual;

if ($vendas_mes_anterior == 0) {
    if ($vendas_mes_atual > 0) {
        $crescimento = 100;
    } else {
        $crescimento = 0;
    }
} else {
    $crescimento = round((($vendas_mes_atual - $vendas_mes_anterior) / $vendas_mes_anterior) * 100, 2);
}

response([
    'status'=>true,
    'vendas'=>$qtd_vendas,
    'ticket_medio'=>$ticket_medio,
    'margem_media'=>$margem_media,
    'crescimento'=>$crescimento
]);