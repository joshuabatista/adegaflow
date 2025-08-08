<?php
require __DIR__ . '../../../../../public_html/config/bootstrap-backend.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=relatorio_estoque.xls");

$produto = $_GET['produto'] ?? null;
$data_entrada_de = $_GET['data_entrada_de'] ?? null;
$data_entrada_ate = $_GET['data_entrada_ate'] ?? null;
$plano_contas = $_GET['plano_contas'] ?? null;

$and = '';

if (!empty($produto)) {
    $and .= " AND p.produto LIKE '%{$produto}%'";
}

if (!empty($data_entrada_de) && !empty($data_entrada_ate)) {
    $and .= " AND p.data_entrada BETWEEN '{$data_entrada_de}' AND '{$data_entrada_ate}'";
}

if (!empty($plano_contas)) {
    $and .= " AND p.plano_contas = {$plano_contas}";
}

$sql = "SELECT p.produto, pc.descricao AS plano_contas, p.quantidade, p.valor_total_compra,
        p.valor_compra, p.valor_venda, DATE_FORMAT(p.data_entrada, '%d/%m/%Y') AS data_entrada
        FROM produtos p
        LEFT JOIN plano_contas_analitico pc ON pc.codigo = p.plano_contas
        WHERE p.adega_id = ?
        AND p.quantidade > 0
        $and";

$query = prepareAll($sql, [$adega_id]);

if (!empty($query->exception)) {
    response([
        'status'=>false,
        'message'=>'Erro ao gerar relatorio, contate o suporte tecnico'
    ]);
}

$data = $query->data;

echo "<table border='1'>";
echo "<tr>
        <th>Data de Entrada</th>
        <th>Produto</th>
        <th>Plano de Contas</th>
        <th>Quantidade</th>
        <th>Valor de Compra</th>
        <th>Valor total de Compra</th>
        <th>Valor de Venda</th>
      </tr>";

foreach ($data as $item) {
    echo "<tr>
            <td>{$item->data_entrada}</td>
            <td>{$item->produto}</td>
            <td>{$item->plano_contas}</td>
            <td>{$item->quantidade}</td>
            <td>R$ " . number_format($item->valor_compra, 2, ',', '.') . "</td>
            <td>R$ " . number_format($item->valor_total_compra, 2, ',', '.') . "</td>
            <td>R$ " . number_format($item->valor_venda, 2, ',', '.') . "</td>
          </tr>";
}


echo "</table>";
