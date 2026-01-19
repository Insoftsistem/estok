<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">

<style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 10px;
    }

    .cabecalho {
        text-align: center;
        border-bottom: 1px dashed #000;
        padding-bottom: 5px;
        margin-bottom: 10px;
    }

    .cabecalho img {
        max-width: 80px;
        margin-bottom: 3px;
    }

    .empresa-nome {
        font-weight: bold;
        font-size: 11px;
    }

    .empresa-dados {
        font-size: 9px;
        line-height: 1.3;
    }

    h2 {
        text-align: center;
        font-size: 11px;
        margin: 8px 0;
    }

    .info {
        margin-bottom: 8px;
        font-size: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px;
    }

    th, td {
        border: 1px solid #000;
        padding: 4px;
        font-size: 9px;
    }

    th {
        background-color: #f0f0f0;
        text-align: center;
    }

    .total {
        text-align: right;
        font-weight: bold;
    }
</style>
</head>

<body>

<!-- CABEÇALHO -->
<div class="cabecalho">
    @if(!empty($config->logo))
    <img src="{{ url($config->logo) }}" style="max-width:80px;">
@endif

    <div class="empresa-nome">
        {{ $config->nome_site ?? 'Empresa não informada' }}
    </div>

    <div class="empresa-dados">
        {!! strip_tags($config->endereco ?? '') !!}<br>
        Fone: {{ $config->telefone ?? '' }}<br>
        CNPJ: {{ $config->cnpj ?? '' }}
    </div>
</div>

<!-- TÍTULO -->
<h2>NOTA DE SAÍDA / VENDA Nº {{ $saida->id ?? '' }}</h2>

<!-- DADOS -->
<div class="info">
    <strong>Data:</strong>
    {{
        isset($saida->created_at)
            ? \Carbon\Carbon::parse($saida->created_at)->format('d/m/Y H:i')
            : 'Não informada'
    }}
    <br>

    <strong>Destino:</strong>
    {{ $saida->destino ?? 'Não informado' }}
</div>

<!-- TABELA -->
<table>
    <tr>
        <th>Produto</th>
        <th>Qtd</th>
        <th>V. Unit</th>
        <th>Total</th>
    </tr>

    @php
        $quantidade = $saida->quantidade ?? 1;
        $valorUnitario = $saida->valor_unitario ?? 0;
        $total = $quantidade * $valorUnitario;
    @endphp

    <tr>
        <td>{{ $saida->produto_nome ?? 'Não informado' }}</td>
        <td style="text-align:center;">{{ $quantidade }}</td>
        <td style="text-align:right;">
            R$ {{ number_format($valorUnitario, 2, ',', '.') }}
        </td>
        <td style="text-align:right;">
            R$ {{ number_format($total, 2, ',', '.') }}
        </td>
    </tr>

    <tr>
        <td colspan="3" class="total">TOTAL GERAL</td>
        <td class="total">
            R$ {{ number_format($total, 2, ',', '.') }}
        </td>
    </tr>
</table>

</body>
</html>
