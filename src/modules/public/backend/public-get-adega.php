<?php
require __DIR__ . '../../../../../public_html/config/bootstrap-backend.php';

$pdo->beginTransaction();

$sql = "SELECT bairro, cep, cidade, cnpj, email, logradouro, nome, numero, telefone
        FROM adega 
        WHERE adega_id = ?";

$query = prepareAll($sql, [$adega_id]);

if(!empty($query->exception)){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Erro ao buscar dados da Ageda, contate o suporte tecnico.'
    ]);
}

$data = $query->data;

$data = $data[0];

$email = decryptData($data->email, $key);

$pdo->commit();

response([
    'status'=>true,
    'data'=>$data,
    'email'=>$email
]);

