<?php

require __DIR__ . '../../../../../public_html/config/bootstrap-backend.php';

//custo
$sql = "SELECT meses.mes AS mes, COALESCE(SUM(p.valor_total_compra), 0) AS total
        FROM 
            (
                SELECT 1 AS mes UNION ALL
                SELECT 2 UNION ALL
                SELECT 3 UNION ALL
                SELECT 4 UNION ALL
                SELECT 5 UNION ALL
                SELECT 6 UNION ALL
                SELECT 7 UNION ALL
                SELECT 8 UNION ALL
                SELECT 9 UNION ALL
                SELECT 10 UNION ALL
                SELECT 11 UNION ALL
                SELECT 12
            ) AS meses
        LEFT JOIN produtos p ON MONTH(p.data_entrada) = meses.mes
            AND YEAR(p.data_entrada) = YEAR(CURDATE())
            AND p.adega_id = ?
        GROUP BY meses.mes
        ORDER BY meses.mes;";

$query = prepareAll($sql, [$adega_id]);

if(!empty($query->exception)){
    response([
        'status'=>false,
        'message'=>'Erro ao buscar produtos, contate o suporte tecnico.'
    ]);
}

$custos = $query->data;

//receita
$sql = "SELECT 
            meses.mes AS mes,
            COALESCE(SUM(v.valor_total), 0) AS total
        FROM 
            (
                SELECT 1 AS mes UNION ALL
                SELECT 2 UNION ALL
                SELECT 3 UNION ALL
                SELECT 4 UNION ALL
                SELECT 5 UNION ALL
                SELECT 6 UNION ALL
                SELECT 7 UNION ALL
                SELECT 8 UNION ALL
                SELECT 9 UNION ALL
                SELECT 10 UNION ALL
                SELECT 11 UNION ALL
                SELECT 12
            ) AS meses
        LEFT JOIN vendas v ON MONTH(v.data_venda) = meses.mes
            AND YEAR(v.data_venda) = YEAR(CURDATE())
            AND v.adega_id = ?
        GROUP BY meses.mes
        ORDER BY meses.mes";

$query = prepareAll($sql, [$adega_id]);

if(!empty($query->exception)){
    response([
        'status'=>false,
        'message'=>'Erro ao buscar receitas, contate o suporte tecnico.'
    ]);
}

$receitas = $query->data;

$lucros = [];

for ($i = 0; $i < 12; $i++) {
    $mes = $receitas[$i]->mes; // ou $custos[$i]->mes, é o mesmo

    // Convertendo os totais para float antes de subtrair
    $receita = (float)$receitas[$i]->total;
    $custo = (float)$custos[$i]->total;
    $lucro = $receita - $custo;

    $lucros[] = (object)[
        'mes' => $mes,
        'total' => number_format($lucro, 2, '.', '')
    ];
}

response([
    'status' => true,
    'receitas' => $receitas,
    'custos' => $custos,
    'lucros' => $lucros
]);
