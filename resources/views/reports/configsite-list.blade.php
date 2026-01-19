
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Config Site</h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nome Site</th>
            <th>Logo</th>
            <th>Cnpj</th>
            <th>Endereco</th>
            <th>Telefone</th>
            <th>Whatsapp</th>
            <th>Email</th>
            <th>Facebook</th>
            <th>Instagram</th>
            <th>Twitter</th>
            <th>Linkedin</th>
            <th>Youtube</th>
            <th>Horario Funcionamento</th>
            <th>Sobre</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->nome_site }}</td>
            <td>{{ $record->logo }}</td>
            <td>{{ $record->cnpj }}</td>
            <td>{{ $record->endereco }}</td>
            <td>{{ $record->telefone }}</td>
            <td>{{ $record->whatsapp }}</td>
            <td>{{ $record->email }}</td>
            <td>{{ $record->facebook }}</td>
            <td>{{ $record->instagram }}</td>
            <td>{{ $record->twitter }}</td>
            <td>{{ $record->linkedin }}</td>
            <td>{{ $record->youtube }}</td>
            <td>{{ $record->horario_funcionamento }}</td>
            <td>{{ $record->sobre }}</td>
            <td>{{ $record->created_at }}</td>
            <td>{{ $record->updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
