@extends('layouts.info')
@section('content')
<div class="container my-4">
	<h4>Terms And Conditons</h4>
	<hr />
	<div>
		<p>Put page content here.</p>
		
		@php
    $records = DB::table('info')->get();
@endphp

@foreach($records as $data)

    
        <h2>Sobre Nós</h2>
        {!!$data->termos_condicoes!!}
    

   
@endforeach
	</div>
</div>
@endsection