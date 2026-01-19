
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Estoque Movimento Details</h1></div>
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
            <th>Tipo</th>
            <td>{{ $record->tipo }}</td>
        </tr>
        <tr>
            <th>Quantidade</th>
            <td>{{ $record->quantidade }}</td>
        </tr>
        <tr>
            <th>Data Movimento</th>
            <td>{{ $record->data_movimento }}</td>
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
    </tbody>
</table>
@endsection
