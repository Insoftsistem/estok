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
    margin-bottom: 5px;
  }

  .cabecalho img {
    max-height: 55px;
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

  hr {
    margin: 6px 0;
  }

  .titulo {
    text-align: center;
    font-size: 12px;
    font-weight: bold;
    margin: 6px 0;
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
    text-align: center;
  }
</style>
</head>

<body>

<!-- CABEÇALHO -->
<div class="cabecalho">

 @if(!empty($config->logo))
    <img src="{{ url($config->logo) }}" style="max-width:80px;">
@endif

  @if(!empty($config->nome_site))
    <div class="empresa-nome">
      {{ $config->nome_site }}
    </div>
  @endif

  <div class="empresa-dados">
    @if(!empty($config->cnpj))
      CNPJ: {{ $config->cnpj }} <br>
    @endif

    @if(!empty($config->endereco))
      {!! strip_tags($config->endereco) !!} <br>
    @endif

    @if(!empty($config->telefone))
      Fone: {{ $config->telefone }}
    @endif

    @if(!empty($config->whatsapp))
      | WhatsApp: {{ $config->whatsapp }}
    @endif
  </div>

</div>

<hr>

<!-- TÍTULO -->
<div class="titulo">
  NOTA DE ENTRADA DE ESTOQUE Nº {{ $entrada->id ?? '' }}
</div>

<p style="font-size:9px; margin:4px 0;">
  <strong>Data:</strong>
  {{
    isset($entrada->data)
      ? \Carbon\Carbon::parse($entrada->data)->format('d/m/Y')
      : (isset($entrada->data_entrada)
          ? \Carbon\Carbon::parse($entrada->data_entrada)->format('d/m/Y')
          : 'Não informada')
  }}
  <br>

  <strong>Fornecedor:</strong>
  {{ $entrada->fornecedor ?? 'Não informado' }}
</p>

<!-- PRODUTO -->
<table>
  <tr>
    <th>Produto</th>
    <th>Qtd</th>
    <th>Valor Unit.</th>
    <th>Total</th>
  </tr>

  @php
    $quantidade = $entrada->quantidade ?? 1;
    $valorUnitario = $entrada->valor_unitario ?? 0;
    $total = $quantidade * $valorUnitario;
  @endphp

  <tr>
    <td>{{ $entrada->produto_nome ?? 'Não informado' }}</td>
    <td style="text-align:center;">{{ $quantidade }}</td>
    <td style="text-align:right;">
      R$ {{ number_format($valorUnitario, 2, ',', '.') }}
    </td>
    <td style="text-align:right;">
      R$ {{ number_format($total, 2, ',', '.') }}
    </td>
  </tr>

  <tr>
    <th colspan="3" style="text-align:right;">TOTAL GERAL</th>
    <th style="text-align:right;">
      R$ {{ number_format($total, 2, ',', '.') }}
    </th>
  </tr>
</table>

</body>
</html>
