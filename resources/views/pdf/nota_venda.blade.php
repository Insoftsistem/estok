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
    text-align: center;
  }

  .sem-borda td {
    border: none;
    padding: 2px;
  }

  .titulo {
    text-align: center;
    font-size: 12px;
    font-weight: bold;
    margin: 6px 0;
  }

  hr {
    margin: 5px 0;
  }
</style>
</head>

<body>

<!-- CABEÇALHO TIPO CUPOM -->
<table class="sem-borda">
  <tr>
    <td width="30%">
      @if(!empty($config->logo))
    <img src="{{ url($config->logo) }}" style="max-width:80px;">
@endif
    </td>

    <td width="70%" style="font-size:9px;">
      <strong>{{ $config->nome_site ?? '' }}</strong><br>
      CNPJ: {{ $config->cnpj ?? '—' }}<br>
      {!! strip_tags($config->endereco ?? '') !!}<br>
      Fone: {{ $config->telefone ?? '' }}
      @if(!empty($config->whatsapp))
        | WhatsApp: {{ $config->whatsapp }}
      @endif
    </td>
  </tr>
</table>

<hr>

<div class="titulo">
  NOTA DE VENDA Nº {{ $venda->id ?? '' }}
</div>

<p style="font-size:9px; margin:4px 0;">
  <strong>Data:</strong>
  {{
    isset($venda->created_at)
      ? \Carbon\Carbon::parse($venda->created_at)->format('d/m/Y H:i')
      : 'Não informada'
  }}
  <br>

  <strong>Cliente:</strong>
  {{ $venda->cliente_nome ?? 'Consumidor Final' }}
</p>

<!-- ITENS DA VENDA -->
<table>
  <tr>
    <th>Produto</th>
    <th>Qtd</th>
    <th>Valor Unit.</th>
    <th>Total</th>
  </tr>

  @php $totalGeral = 0; @endphp

  @foreach($itens as $item)
    @php
      $quantidade = $item->quantidade ?? 0;
      $valorUnitario = $item->valor ?? $item->valor_unitario ?? 0;
      $totalItem = $quantidade * $valorUnitario;
      $totalGeral += $totalItem;
    @endphp

    <tr>
      <td>{{ $item->produto ?? 'Não informado' }}</td>
      <td style="text-align:center;">{{ $quantidade }}</td>
      <td style="text-align:right;">
        R$ {{ number_format($valorUnitario, 2, ',', '.') }}
      </td>
      <td style="text-align:right;">
        R$ {{ number_format($totalItem, 2, ',', '.') }}
      </td>
    </tr>
  @endforeach

  <tr>
    <th colspan="3" style="text-align:right;">TOTAL GERAL</th>
    <th style="text-align:right;">
      R$ {{ number_format($totalGeral, 2, ',', '.') }}
    </th>
  </tr>
</table>

</body>
</html>
