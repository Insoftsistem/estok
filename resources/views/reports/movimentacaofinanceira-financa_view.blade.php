
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Movimentacao Financeira</h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Produto Id</th>
            <th>Tipo Movimentacao</th>
            <th>Quantidade</th>
            <th>Valor Unitario</th>
            <th>Valor Total</th>
            <th>Data Movimentacao</th>
            <th>Usuario Id</th>
            <th>Loja Origem Id</th>
            <th>Loja Destino Id</th>
            <th>Observacao</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->produto_id }}</td>
            <td>{{ $record->tipo_movimentacao }}</td>
            <td>{{ $record->quantidade }}</td>
            <td>{{ $record->valor_unitario }}</td>
            <td>{{ $record->valor_total }}</td>
            <td>{{ $record->data_movimentacao }}</td>
            <td>{{ $record->usuario_id }}</td>
            <td>{{ $record->loja_origem_id }}</td>
            <td>{{ $record->loja_destino_id }}</td>
            <td>{{ $record->observacao }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
