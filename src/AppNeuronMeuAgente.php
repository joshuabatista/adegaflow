<?php

declare(strict_types=1);

namespace Joshu\Adegaflow;

use NeuronAI\Agent;
use NeuronAI\SystemPrompt;
use NeuronAI\Providers\AIProviderInterface;
use NeuronAI\Providers\OpenAI\Responses\OpenAIResponses;
use NeuronAI\Providers\OpenAI\HttpClientOptions;
use NeuronAI\Tools\Toolkits\MySQL\MySQLToolkit;

session_start();
require '../public_html/config/conection.php';
require '../app/functions.php';
$adega_id = $_SESSION['adega_id'];

class AppNeuronMeuAgente extends Agent
{
    protected function provider(): AIProviderInterface
    {
        return new OpenAIResponses(
            key: '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',
            model: 'gpt-4o', 
            parameters: [
                'temperature' => 0.3, 
            ],
            strict_response: false,
        );
    }

    public function instructions(): string
    {
        return (string) new SystemPrompt(
            background: [
                "Você é um assistente especializado em análise de estoque e vendas da AdegaFlow.",
                "Analise tendências de saída de produtos, gargalos e previsões de demanda com base nos dados do banco de dados.",
                "Responda de forma direta e em português do Brasil.",
                "Todas as consultas devem ser relizadas com base na adega_id, isso é muito importe para que não ocorra vazamento de dados de outras adegas e nem divergencia do mesmo. AdegaFlow é um sistema que vai comportar inumeras adegas",
                "Vou te ensinar mais sobre o banco de dados e suas tabelas.
                A tabela Adega lista as adegas que adquiriam o sistema. Através dela, temos a adega_id, od unico de cada adega que faz toda a logica do sistema funcionar.
                A tabela password_reset_codes é resposavel por resetar o password, essa voce pode ignorar.
                A tabela plano_contas_analitico me retorna os planos de contas na qual o usuario irá atrelar aos produtos.
                a tabela plano_contas_sintetico serve como um plano de contas acima que agrega os planos de conta analitico.
                a tabela produtos lista todos os produtos da adega pela adega_id. temos o produto_id que referencia cada produto. a coluna produto retorna o nome do produto. a coluna plano de contas retorna o plano de contas cadstrado. a coluna quantidade_antes_venda é a quantidade do produto no estoque antes da venda, basicamente oque entrou antes mesmo de eu começar a vender. a coluna quanrtidade é a quantidade atual do produto no estoque. a coluna valor_compra é o valor que foi pagado em cada produto. a coluna valor_total_compra é o valor total da compra do produto (quantidade_antes_venda x valor_compra) a coluna valor_venda é por quanto eu vou vender o produto. a coluna data_entrada é a data que o produto entrou no estoque. created_at é a data e hora do lançamento.
                a tabela vendas tem o id auto increment, mas o que importa mesmo é a coluna venda_id, que é o id unico de cada venda, esse id pode comportar uma ou mais vendas. adega_id referencia a adega. produto_id referencia o produto. qtd referencia a quantidade vendida do produto. valor_total é o valor total da venda do produto em si. created_at data da venda.
                "
            ],
        );
    }

    protected function tools(): array
    {
        return [
            MySQLToolkit::make(
                new \PDO(
                    "mysql:host=atenasis.com.br;dbname=atenas65_adegaflow;charset=utf8mb4",
                    "atenas65", 
                    "rootAdmin@@2024"      
                )
            ),
        ];
    }
}
