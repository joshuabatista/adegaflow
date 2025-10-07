<?php

require __DIR__ . '../../../../../public_html/config/bootstrap-backend.php';

//custo
$sql = "SELECT DAY(data_entrada) dia, SUM(valor_total_compra) total
        FROM produtos
        WHERE YEAR(data_entrada) = YEAR(CURDATE())
        AND MONTH(data_entrada) = MONTH(CURDATE())
        AND adega_id = ?
        GROUP BY DAY(data_entrada)
        ORDER BY dia";

$query = prepareAll($sql, [$adega_id]);

if(!empty($query->exception)){
    response([
        'status'=>false,
        'message'=>'Erro ao buscar produtos, contate o suporte tecnico.'
    ]);
}

$custos = $query->data;

//receita
$sql = "SELECT DAY(data_venda) dia, SUM(valor_total) total
        FROM vendas
        WHERE YEAR(data_venda)  = YEAR(CURDATE())
        AND MONTH(data_venda) = MONTH(CURDATE())
        AND adega_id = ?
        GROUP BY DAY(data_venda)
        ORDER BY dia";

$query = prepareAll($sql, [$adega_id]);

if(!empty($query->exception)){
    response([
        'status'=>false,
        'message'=>'Erro ao buscar receitas, contate o suporte tecnico.'
    ]);
}

$receitas = $query->data;

$daysInMonth = (int) date('t');

$custosArr = array_fill(1, $daysInMonth, 0.0);
$receitasArr = array_fill(1, $daysInMonth, 0.0);
$lucroArr = array_fill(1, $daysInMonth, 0.0);

foreach ($custos as $linha) {
    $dia = (int) $linha->dia;
    $custosArr[$dia] = (float) $linha->total;
}

foreach ($receitas as $linha) {
    $dia = (int) $linha->dia;
    $receitasArr[$dia] = (float) $linha->total;
}

for ($d = 1; $d <= $daysInMonth; $d++) {
    $lucroArr[$d] = $receitasArr[$d] - $custosArr[$d];
}

response([
    'status'=>true,
    'receitas'=>$receitasArr,
    'custos'=>$custosArr,
    'lucros'=>$lucroArr
]);


