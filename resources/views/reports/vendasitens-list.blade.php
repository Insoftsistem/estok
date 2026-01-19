
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Vendas Itens</h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Venda Id</th>
            <th>Produto Id</th>
            <th>Quantidade</th>
            <th>Valor Unitario</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->venda_id }}</td>
            <td>{{ $record->produto_id }}</td>
            <td>{{ $record->quantidade }}</td>
            <td>{{ $record->valor_unitario }}</td>
            <td>{{ $record->subtotal }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
