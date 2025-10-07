<?php

require __DIR__ . '../../../../../public_html/config/bootstrap-backend.php';

$pdo->beginTransaction();

$nome = $_POST['nome'] ?? null;
$telefone = $_POST['telefone'] ?? null;

if(empty($nome) || empty($telefone)){
    $pdo->rollback;
    response([
        'status'=>false,
        'message'=>'Preencha as informações corretamente'
    ]);
}

$sql = "UPDATE adega SET 
        nome = ?,
        telefone = ?
        WHERE adega_id = ?";

$columns = [
    $nome,
    $telefone,
    $adega_id
];

$query = prepare($sql, $columns);

if(!empty($query->exception)){
    $pdo->rollback();
    response([
        'status'=>false,
        'message'=>'Erro ao editar dados da Adega, contate o suporte tecnico'
    ]);
}

$pdo->commit();

response([
    'status'=>true,
    'message'=>'Perfil editado com sucesso!'
]);