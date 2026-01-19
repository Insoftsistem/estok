
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Produtos</h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Foto</th>
            <th>Nome</th>
            <th>Descricao</th>
            <th>Preco</th>
            <th>Quantidade</th>
            <th>Data Atualizacao</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->foto }}</td>
            <td>{{ $record->nome }}</td>
            <td>{{ $record->descricao }}</td>
            <td>{{ $record->preco }}</td>
            <td>{{ $record->quantidade }}</td>
            <td>{{ $record->data_atualizacao }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
