
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Lojas</h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Cnpj</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Endereco</th>
            <th>Data Cadastro</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->nome }}</td>
            <td>{{ $record->cnpj }}</td>
            <td>{{ $record->email }}</td>
            <td>{{ $record->telefone }}</td>
            <td>{{ $record->endereco }}</td>
            <td>{{ $record->data_cadastro }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
