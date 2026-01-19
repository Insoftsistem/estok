
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Vendas Iten Details</h1></div>
<table class="table table-sm table-striped">
    <tbody>
        <tr>
            <th>Id</th>
            <td>{{ $record->id }}</td>
        </tr>
        <tr>
            <th>Venda Id</th>
            <td>{{ $record->venda_id }}</td>
        </tr>
        <tr>
            <th>Produto Id</th>
            <td>{{ $record->produto_id }}</td>
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
            <th>Subtotal</th>
            <td>{{ $record->subtotal }}</td>
        </tr>
    </tbody>
</table>
@endsection
