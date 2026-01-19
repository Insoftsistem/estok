
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Venda Details</h1></div>
<table class="table table-sm table-striped">
    <tbody>
        <tr>
            <th>Id</th>
            <td>{{ $record->id }}</td>
        </tr>
        <tr>
            <th>Usuario Id</th>
            <td>{{ $record->usuario_id }}</td>
        </tr>
        <tr>
            <th>Loja Id</th>
            <td>{{ $record->loja_id }}</td>
        </tr>
        <tr>
            <th>Cliente Nome</th>
            <td>{{ $record->cliente_nome }}</td>
        </tr>
        <tr>
            <th>Valor Total</th>
            <td>{{ $record->valor_total }}</td>
        </tr>
        <tr>
            <th>Forma Pagamento</th>
            <td>{{ $record->forma_pagamento }}</td>
        </tr>
        <tr>
            <th>Data Venda</th>
            <td>{{ $record->data_venda }}</td>
        </tr>
    </tbody>
</table>
@endsection
