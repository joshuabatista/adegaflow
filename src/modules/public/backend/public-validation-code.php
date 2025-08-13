<?php

require __DIR__ . '../../../../../public_html/config/conection.php';
require __DIR__ . '../../../../../app/functions.php';
require __DIR__ . '/public-send-email.php';

$pdo->beginTransaction();

$code = $_POST['codigo'] ?? null;

if(empty($code)){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Preencha o codigo enviado por email'
    ]);
}

$sql = "SELECT * 
        FROM password_reset_codes
        WHERE code = ?";

$columns = [
    $code
];

$query = prepare($sql, $columns);

if(!empty($query->exception)){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Erro ao buscar codigo, contate suporte tecnico'
    ]);
}

$code = $query->data;

if(empty($code)){
    response([
        'status'=>false,
        'message'=>'Código inválido!'
    ]);
}

$created_at = $code->created_at;

$expires_at = $code->expires_at;

$agora = date('Y-m-d H:i:s');

if($agora <= $created_at || $agora >= $expires_at){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'O código expirou, reinicie o processo novamente.'
    ]);
}

$adega_id = $code->adega_id;
$expiry = strtotime('+5 minutes');
$tokenData = json_encode(['adega_id' => $adega_id, 'expiry' => $expiry]);
$encryptedToken = base64_encode(openssl_encrypt($tokenData, 'AES-128-CTR', $key, 0, '1234567891011121'));

$pdo->commit();

response([
    'status' => true,
    'message' => 'Redirecionando para alteração de senha',
    'redirect_url' => "/new-password?token=$encryptedToken",
    'adega_id'=>$adega_id
]);
