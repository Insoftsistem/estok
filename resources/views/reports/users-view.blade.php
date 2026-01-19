
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>User Details</h1></div>
<table class="table table-sm table-striped">
    <tbody>
        <tr>
            <th>Id</th>
            <td>{{ $record->id }}</td>
        </tr>
        <tr>
            <th>Foto</th>
            <td>{{ $record->foto }}</td>
        </tr>
        <tr>
            <th>Username</th>
            <td>{{ $record->username }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $record->email }}</td>
        </tr>
        <tr>
            <th>Tel</th>
            <td>{{ $record->tel }}</td>
        </tr>
        <tr>
            <th>Roles</th>
            <td>{{ $record->roles }}</td>
        </tr>
        <tr>
            <th>Endereco</th>
            <td>{{ $record->endereco }}</td>
        </tr>
        <tr>
            <th>Data Cadastro</th>
            <td>{{ $record->data_cadastro }}</td>
        </tr>
        <tr>
            <th>User Role Id</th>
            <td>{{ $record->user_role_id }}</td>
        </tr>
    </tbody>
</table>
@endsection
