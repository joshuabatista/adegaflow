<?php   
$host = 'atenasis.com.br';
$db = 'atenas65_adegaflow';
$username = 'atenas65';
$password = 'rootAdmin@@2024';

// $db = 'adegaflow';
// $username = 'root';
// $password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $pe) {
    if (!function_exists('response')) {
        function response($data, $status = 200) {
            http_response_code($status);
            header('Content-Type: application/json');
            echo json_encode($data);
            exit;
        }
    }
    response([
        'status' => false,
        'message' => 'Erro de conexão: ' . $pe->getMessage()
    ], 500);
}