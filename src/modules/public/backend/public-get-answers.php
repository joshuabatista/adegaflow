<?php

require __DIR__ . '../../../../../public_html/config/bootstrap-backend.php';

$pdo->beginTransaction();

$sql = "SELECT * FROM ia_respostas WHERE adega_id = ?";
$query = prepareAll($sql, [$adega_id]);

if(!empty($query->exeption)){
    response([
        'status'=>false,
        'message'=>'erro ao buscar respostas da IA (contate o suporte tecnico)'
    ]);
}

$data = $query->data;

response([
    'status'=>true,
    'data'=>$data
]);