@extends('layouts.info')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-body my-5">
                    <h4>{{ __('emailVerificationCompleted') }}</h4>
                    <hr />
                    <div class="">
                        <a href="{{ route('home') }}" class="btn btn-primary">{{ __('continue') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
