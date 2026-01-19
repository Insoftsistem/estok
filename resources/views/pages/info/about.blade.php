@extends('layouts.info')
@section('content')
<div class="container my-4">
	<h4>About</h4>
	<hr />
	<div>
		<p>Put page content here.</p>
		
		
		
		@php
    $records = DB::table('info')->get();
@endphp

@foreach($records as $data)

    
        <h2>Sobre Nós</h2>
        {!!$data->sobre_nos!!}
    

   
@endforeach

	</div>
</div>
@endsection