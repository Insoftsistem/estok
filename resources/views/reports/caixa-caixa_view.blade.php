
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Caixa</h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Movimentacao Id</th>
            <th>Tipo</th>
            <th>Valor</th>
            <th>Descricao</th>
            <th>Data Movimento</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->movimentacao_id }}</td>
            <td>{{ $record->tipo }}</td>
            <td>{{ $record->valor }}</td>
            <td>{{ $record->descricao }}</td>
            <td>{{ $record->data_movimento }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
