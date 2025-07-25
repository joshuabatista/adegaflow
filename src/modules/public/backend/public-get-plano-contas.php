<?php

require __DIR__ . '../../../../../public_html/config/bootstrap-backend.php';

$pdo->beginTransaction();

//sinteticos
$sql = "SELECT * FROM plano_contas_sintetico";
$query = prepareAll($sql);
$sinteticos = $query->data;

//analiticos
$sql = "SELECT codigo, descricao, sint_id 
        FROM plano_contas_analitico
        WHERE status = 1
        ORDER BY CAST(SUBSTRING_INDEX(codigo, '.',1) AS UNSIGNED), CAST(SUBSTRING_INDEX(codigo, '.',-1) AS UNSIGNED)";
$query = prepareAll($sql);
$analiticos = $query->data;

$grupos = [];

foreach($sinteticos as $s){
    $grupos[$s->id] = [
        'label'   => strtoupper($s->descricao),
        'options' => []
    ];
}

foreach ($analiticos as $a) {
    $grupos[$a->sint_id]['options'][] = [
        'value' => $a->codigo,
        'text'  => "{$a->codigo} – {$a->descricao}"
    ];
}


response([
    'status' => true,
    'data'   => array_values($grupos) 
]);