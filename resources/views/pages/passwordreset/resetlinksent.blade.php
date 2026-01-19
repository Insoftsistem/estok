@extends('layouts.info')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-body my-5">
                    <h4><i class="material-icons">email</i> {{ __('passwordReset') }}</h4>
                    <hr />
                    <div class="">
                        <h5 class="text-info">
                            {{ __('passwordResetMsg') }}
                        </h5>
                        <hr />
                        <div class="text-center">
                            <a href="<?php print_link('/'); ?>" class="btn btn-info">{{ __('clickHereToLogin') }}</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
