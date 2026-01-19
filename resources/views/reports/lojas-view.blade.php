
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Loja Details</h1></div>
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
            <th>Cnpj</th>
            <td>{{ $record->cnpj }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $record->email }}</td>
        </tr>
        <tr>
            <th>Telefone</th>
            <td>{{ $record->telefone }}</td>
        </tr>
        <tr>
            <th>Endereco</th>
            <td>{{ $record->endereco }}</td>
        </tr>
        <tr>
            <th>Data Cadastro</th>
            <td>{{ $record->data_cadastro }}</td>
        </tr>
    </tbody>
</table>
@endsection
