<?php
require __DIR__ . '../../../../../public_html/config/bootstrap-backend.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=relatorio_vendas.xls");

$produto = $_GET['produto'] ?? null;
$data_entrada_de = $_GET['data_entrada_de'] ?? null;
$data_entrada_ate = $_GET['data_entrada_ate'] ?? null;
$plano_contas = $_GET['plano_contas'] ?? null;
$venda_id = $_GET['venda_id'];

$and = '';

if(!empty($data_entrada_de) && !empty($data_entrada_ate)){
    $and .= " AND v.data_venda BETWEEN '$data_entrada_de' AND '$data_entrada_ate'";
}

if(!empty($produto)){
    $and .= " AND p.produto LIKE '%$produto%'";
}

if(!empty($plano_contas)) {
    $and .= " AND p.plano_contas = $plano_contas";
}

if(!empty($venda_id)){
    $and .= " AND venda_id LIKE '%$venda_id%'";
}

$sql = "SELECT v.venda_id, v.qtd qtd_venda, v.valor_total, v.data_venda, p.produto, pc.descricao, DATE_FORMAT(v.data_venda, '%d/%m/%Y') data_venda_formatada
        FROM vendas v
        LEFT JOIN produtos p ON p.produto_id = v.produto_id
        LEFT JOIN plano_contas_analitico pc ON pc.codigo = p.plano_contas
        WHERE v.adega_id = ?
        $and
        ORDER BY v.created_at desc";

$query = prepareAll($sql, [$adega_id]);


if (!empty($query->exception)) {
    response([
        'status'=>false,
        'message'=>'Erro ao gerar excel de vendas, contate o suporte tecnico'
    ]);
}

$data = $query->data;

echo "<table border='1'>";
echo "<tr>
        <th>Venda ID #</th>
        <th>Data Venda</th>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Valor $</th>
      </tr>";

foreach ($data as $item) {
    echo "<tr>
            <td>#{$item->venda_id}</td>
            <td>{$item->data_venda}</td>
            <td>{$item->produto}</td>
            <td>{$item->qtd_venda}</td>
            <td>R$ " . number_format($item->valor_total, 2, ',', '.') . "</td>
          </tr>";
}


echo "</table>";
