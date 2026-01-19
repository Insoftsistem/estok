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

<!-- CABEÇALHO EMPRESA -->
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
  NOTA DE MOVIMENTAÇÃO FINANCEIRA Nº {{ $mov->id ?? '' }}
</div>

<p style="font-size:9px; margin:4px 0;">
  <strong>Data:</strong>
{{
  !empty($mov->data_movimentacao)
    ? \Carbon\Carbon::parse($mov->data_movimentacao)->format('d/m/Y H:i')
    : 'Não informada'
}}
<br>

<strong>Tipo:</strong>
{{ !empty($mov->tipo_movimentacao) ? ucfirst($mov->tipo_movimentacao) : '—' }}
<br>

<strong>Descrição:</strong>
{{ $mov->observacao ?? 'Não informada' }}

</p>

<!-- VALOR -->
<table>
  <tr>
    <th>Valor</th>
  </tr>
  <tr>
    <td style="text-align:center; font-size:11px; font-weight:bold;">
      R$ {{ number_format($mov->valor ?? 0, 2, ',', '.') }}
    </td>
  </tr>
</table>

</body>
</html>
