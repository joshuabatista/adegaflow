<?php

session_start();

require __DIR__ . '../../../../../public_html/config/conection.php';
require __DIR__ . '../../../../../app/functions.php';

$email = mb_strtolower(trim($_POST['email'])) ?? null;
$password = $_POST['password'];

if(empty($email)){
    response([
        'status'=>false,
        'message'=>'Preencha o email!'
    ]);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    response([
        'status' => false,
        'message' => 'Preencha os campos corretamente!'
    ]);
}

if(empty($password)){
    response([
        'status'=>false,
        'message'=>'Por favor, preencha sua senha!'
    ]);
}

$sql = "SELECT * FROM adega";

$query = prepareAll($sql, []);

$info = $query->data;

$adega = New stdClass;

foreach($info as $k => $value){
    $decryptEmail = decryptData($value->email, $key);

    // die(var_dump($decryptEmail));

    // Compara o e-mail descriptografado com o e-mail fornecido
    if ($decryptEmail == $email) {
        $userEncontrado = true;
        
        // Preenche os dados do usuário
        $adega->id = $value->adega_id;
        $adega->email = $decryptEmail; // Ou use $email se quiser o valor original
        $adega->nome = decryptData($value->nome, $key);
        $adega->senha = $value->senha;
        $adega->cnpj = $value->cnpj;
        $adega->cep = $value->cep;
        $adega->logradouro = $value->logradouro;
        $adega->numero = $value->numero;
        $adega->bairro = $value->bairro;
        $adega->cidade = $value->cidade;
        $adega->telefone = $value->telefone;

        break; // Sai do loop após encontrar o usuário
    }
}

if (!isset($userEncontrado)) {
    response([
        'status' => false,
        'message' => "Adega não encontrada!"
    ]);
}

$password = base64_decode($password);

if(!password_verify($password, $adega->senha)){
    response([
        'status'=>false,
        'message'=>'Senha inválida!'
    ]);
}

// echo '<pre>';
// die(var_dump($adega));
// echo '</pre>';

$_SESSION['adega_id'] = $adega->id;
$_SESSION['adega_nome'] = $adega->nome;
$_SESSION['adega_email'] = $adega->email;
$_SESSION['adega_cnpj'] = $adega->cnpj;
$_SESSION['adega_cep'] = $adega->cep;
$_SESSION['adega_logradouro'] = $adega->logradouro;
$_SESSION['adega_numero'] = $adega->numero;
$_SESSION['adega_bairro'] = $adega->bairro;
$_SESSION['adega_cidade'] = $adega->cidade;
$_SESSION['adega_telefone'] = $adega->telefone;

response([
    'status'=>true
]);