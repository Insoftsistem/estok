<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">

<style>
body {
    font-family: DejaVu Sans;
    font-size: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 6px;
}

th, td {
    border: 1px solid #000;
    padding: 4px;
}

th {
    background: #f2f2f2;
}

.sem-borda td {
    border: none;
}

.titulo {
    text-align: center;
    font-size: 12px;
    font-weight: bold;
    margin: 8px 0;
}

hr {
    margin: 5px 0;
}
</style>
</head>

<body>

<!-- CABEÇALHO -->
<table class="sem-borda">
    <tr>
        <td width="30%">
            @if(!empty($config->logo))
                <img src="{{ url($config->logo) }}" style="max-width:80px;">
            @endif
        </td>
        <td width="70%" style="font-size:9px;">
            <strong>{{ $config->nome_site }}</strong><br>
            CNPJ: {{ $config->cnpj }}<br>
            {!! strip_tags($config->endereco) !!}<br>
            Fone: {{ $config->telefone }}
        </td>
    </tr>
</table>

<hr>

<div class="titulo">
    MOVIMENTAÇÕES DE ESTOQUE
</div>

<p style="font-size:9px;">
    <strong>Período:</strong>
    {{ \Carbon\Carbon::parse($dataInicio)->format('d/m/Y') }}
    até
    {{ \Carbon\Carbon::parse($dataFim)->format('d/m/Y') }}
</p>

<table>
    <tr>
        <th>Data</th>
        <th>Produto</th>
        <th>Tipo</th>
        <th>Quantidade</th>
    </tr>

    @forelse($movimentos as $mov)
        <tr>
            <td style="text-align:center;">
                {{ \Carbon\Carbon::parse($mov->data_movimento)->format('d/m/Y H:i') }}
            </td>
            <td>{{ $mov->produto }}</td>
            <td style="text-align:center;">
                {{ strtoupper($mov->tipo) }}
            </td>
            <td style="text-align:center;">
                {{ $mov->quantidade }}
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" style="text-align:center;">
                Nenhuma movimentação no período informado
            </td>
        </tr>
    @endforelse
</table>

</body>
</html>
