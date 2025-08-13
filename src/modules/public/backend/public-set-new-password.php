<?php

require __DIR__ . '../../../../../public_html/config/conection.php';
require __DIR__ . '../../../../../app/functions.php';

$pdo->beginTransaction();

$senha1 = $_POST['senha1'] ?? null;
$senha2 = $_POST['senha2'] ?? null;
$adega_id = $_POST['adega_id'] ?? null;

if(empty($senha1) || empty($senha2)){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Preencha os campos corretamente'
    ]);
}

if(empty($adega_id)){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Erro ao redefinir senha, contate o suporte tecnico'
    ]);
}

if($senha1 != $senha2){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'As senhas se diferem'
    ]);
}

if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/', $senha1)) {
    $pdo->rollback();
    response([
        'status' => false,
        'message' => 'A senha deve ter no mínimo 8 caracteres, incluindo uma letra maiúscula, uma minúscula, um número e um caractere especial.'
    ]);
}

$hashedPassword = password_hash($senha1, PASSWORD_DEFAULT);

$sql = "UPDATE adega 
        SET senha = ? 
        WHERE adega_id = ?";

$query = prepare($sql, [$hashedPassword, $adega_id]);
 
if(!empty($query->exception)){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Erro ao alterar senha, contate o suporte tecnico'
    ]);
}

$pdo->commit();

response([
    'status'=>true,
    'message'=>'Senha alterada com sucesso!',
    'redirect'=>'inicio'
]);

