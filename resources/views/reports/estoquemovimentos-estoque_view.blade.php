
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Estoque Movimentos</h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Produto Id</th>
            <th>Tipo</th>
            <th>Quantidade</th>
            <th>Data Movimento</th>
            <th>Usuario Id</th>
            <th>Loja Origem Id</th>
            <th>Loja Destino Id</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->produto_id }}</td>
            <td>{{ $record->tipo }}</td>
            <td>{{ $record->quantidade }}</td>
            <td>{{ $record->data_movimento }}</td>
            <td>{{ $record->usuario_id }}</td>
            <td>{{ $record->loja_origem_id }}</td>
            <td>{{ $record->loja_destino_id }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
