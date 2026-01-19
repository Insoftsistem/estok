
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Estoque Saida Details</h1></div>
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
            <th>Quantidade</th>
            <td>{{ $record->quantidade }}</td>
        </tr>
        <tr>
            <th>Motivo</th>
            <td>{{ $record->motivo }}</td>
        </tr>
        <tr>
            <th>Data Saida</th>
            <td>{{ $record->data_saida }}</td>
        </tr>
        <tr>
            <th>Usuario Id</th>
            <td>{{ $record->usuario_id }}</td>
        </tr>
        <tr>
            <th>Recebido</th>
            <td>{{ $record->recebido }}</td>
        </tr>
        <tr>
            <th>Loja Origem Id</th>
            <td>{{ $record->loja_origem_id }}</td>
        </tr>
        <tr>
            <th>Loja Destino Id</th>
            <td>{{ $record->loja_destino_id }}</td>
        </tr>
    </tbody>
</table>
@endsection
