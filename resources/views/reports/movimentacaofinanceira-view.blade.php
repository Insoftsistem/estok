
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Movimentacao Financeira Details</h1></div>
<table class="table table-sm table-striped">
    <tbody>
        <tr>
            <th>Id</th>
            <td>{{ $record->id }}</td>
        </tr>
        <tr>
            <th>Produto Id</th>
            <td>{{ $record->produto_id }}</td>
        </tr>
        <tr>
            <th>Tipo Movimentacao</th>
            <td>{{ $record->tipo_movimentacao }}</td>
        </tr>
        <tr>
            <th>Quantidade</th>
            <td>{{ $record->quantidade }}</td>
        </tr>
        <tr>
            <th>Valor Unitario</th>
            <td>{{ $record->valor_unitario }}</td>
        </tr>
        <tr>
            <th>Valor Total</th>
            <td>{{ $record->valor_total }}</td>
        </tr>
        <tr>
            <th>Data Movimentacao</th>
            <td>{{ $record->data_movimentacao }}</td>
        </tr>
        <tr>
            <th>Usuario Id</th>
            <td>{{ $record->usuario_id }}</td>
        </tr>
        <tr>
            <th>Loja Origem Id</th>
            <td>{{ $record->loja_origem_id }}</td>
        </tr>
        <tr>
            <th>Loja Destino Id</th>
            <td>{{ $record->loja_destino_id }}</td>
        </tr>
        <tr>
            <th>Observacao</th>
            <td>{{ $record->observacao }}</td>
        </tr>
    </tbody>
</table>
@endsection
