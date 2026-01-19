
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Produto Details</h1></div>
<table class="table table-sm table-striped">
    <tbody>
        <tr>
            <th>Id</th>
            <td>{{ $record->id }}</td>
        </tr>
        <tr>
            <th>Nome</th>
            <td>{{ $record->nome }}</td>
        </tr>
        <tr>
            <th>Descricao</th>
            <td>{{ $record->descricao }}</td>
        </tr>
        <tr>
            <th>Preco</th>
            <td>{{ $record->preco }}</td>
        </tr>
        <tr>
            <th>Quantidade</th>
            <td>{{ $record->quantidade }}</td>
        </tr>
        <tr>
            <th>Foto</th>
            <td>{{ $record->foto }}</td>
        </tr>
        <tr>
            <th>Data Atualizacao</th>
            <td>{{ $record->data_atualizacao }}</td>
        </tr>
    </tbody>
</table>
@endsection
