<?php
date_default_timezone_set('America/Sao_Paulo');
require_once 'vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$stylesheet = file_get_contents('style.css');

$produtos = [
    [
        'nome' => 'Caderno Universitário',
        'categoria' => 'Papelaria',
        'preco' => 19.90,
        'descricao' => 'Caderno universitário com 200 folhas pautadas.'
    ],
    [
        'nome' => 'Caneta Azul',
        'categoria' => 'Papelaria',
        'preco' => 2.50,
        'descricao' => 'Caneta esferográfica azul de ponta fina.'
    ],
    [
        'nome' => 'Garrafa Térmica',
        'categoria' => 'Utilidades Domésticas',
        'preco' => 45.00,
        'descricao' => 'Garrafa térmica de aço inoxidável com capacidade de 1L.'
    ],
    [
        'nome' => 'Fone de Ouvido',
        'categoria' => 'Eletrônicos',
        'preco' => 79.90,
        'descricao' => 'Fone de ouvido estéreo da padaria.'
    ]
];

$dataHora = date('d/m/Y H:i:s');
$html = '
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <div class="cabecalho">
        <img src="imagens/MeuGato.webp" alt="Logo" style="width: 150px; height: auto;">
        <div class="titulo">Produtos</div>
        <div class="data">PDF Gerado em: ' . $dataHora . '</div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço (R$)</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody>';

foreach ($produtos as $produto) {
    $html .= '
        <tr>
            <td>' . $produto['nome'] . '</td>
            <td>' . $produto['categoria'] . '</td>
            <td>' . number_format($produto['preco'], 2, ',', '.') . '</td>
            <td>' . $produto['descricao'] . '</td>
        </tr>';
}
$html .= '
        </tbody>
    </table>
</body>
</html>';

$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output();
