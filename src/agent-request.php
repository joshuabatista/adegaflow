<?php
require 'AppNeuronMeuAgente.php';

use Joshu\Adegaflow\AppNeuronMeuAgente;
use NeuronAI\Chat\Messages\UserMessage;

header('Content-Type: application/json');

try {
    $agent = AppNeuronMeuAgente::make();

    $adega_id = $_SESSION['adega_id'];
    $question = $_POST['question'] ?? '';

    if(!$question){
        response([
            'status'=>false,
            'message'=>'Pergunta não enviada'
        ]);
        exit;
    }

    $finalQuestion = "Com base na adega_id $adega_id (não retorne o id da adega nem informações sensíveis, retorne um texto formatado e bem bonito para o usuário) {$question}";

    $response = $agent->chat(new UserMessage($finalQuestion));

    $content = $response->getContent();

    $sql = "INSERT INTO ia_respostas (adega_id, pergunta, resposta, created_at) VALUES (?, ?, ?, NOW())";

    $query = prepare($sql, [$adega_id, $question, $content]);

    if(!empty($query->exption)){
        response([
            'status'=>false,
            'message'=>'Erro ao responder pergunta'
        ]);
    }

    response([
        'status'=>true,
        'response'=>$content
    ]);

} catch (Throwable $e) {
     response([
        'status'=>false,
        'response'=>$e->getMessage()
     ]);
}
