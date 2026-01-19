@extends('layouts.info')
@section('content')
<div class="container mt-4">
	<div class="row justify-content-center">
		<div class="col-sm-6">
			<div class="card card-body">
				<h4><i class="material-icons">check_circle</i> {{ __('passwordReset') }}</h4>
				<hr />	
				<h5 class="animated bounce text-success">
					{{ __('passwordChangedMsg') }}
				</h5>
				<hr />
				<div class="text-center">
					<a href="<?php print_link("/"); ?>" class="btn btn-info">{{ __('clickHereToLogin') }}</a>
				</div>
			</div>
	
			
		</div>
	</div>
</div>
@endsection