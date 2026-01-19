
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Caixa Details</h1></div>
<table class="table table-sm table-striped">
    <tbody>
        <tr>
            <th>Id</th>
            <td>{{ $record->id }}</td>
        </tr>
        <tr>
            <th>Movimentacao Id</th>
            <td>{{ $record->movimentacao_id }}</td>
        </tr>
        <tr>
            <th>Tipo</th>
            <td>{{ $record->tipo }}</td>
        </tr>
        <tr>
            <th>Valor</th>
            <td>{{ $record->valor }}</td>
        </tr>
        <tr>
            <th>Descricao</th>
            <td>{{ $record->descricao }}</td>
        </tr>
        <tr>
            <th>Data Movimento</th>
            <td>{{ $record->data_movimento }}</td>
        </tr>
    </tbody>
</table>
@endsection
