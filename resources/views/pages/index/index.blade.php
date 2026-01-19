        <!-- 
        expose component model to current view
        e.g $arrDataFromDb = $comp_model->fetchData(); //function name
        -->
        @inject('comp_model', 'App\Models\ComponentsData')
        <?php 
            $pageTitle = __('estok'); // set page title
        ?>
        @extends($layout)
        @section('title', $pageTitle)
        @section('content')
        <div>
            <div  class="mb-3" >
                <div class="container-fluid">
                    <div class="row justify-content-start">
                        <div class="col col-sm-6 col-md-3 col-lg-3 comp-grid " >
                            <div class=" card-7 mt-5 bg-light"><div class="h4 fw-bold text-primary text-center">
                                <img src="{{ asset('images/logo.png') }}" width="50px" height="50px" class="img-fluid rounded-circle" /> 
                                {{ __('userLogin') }}
                            </div>
                        </div>
                        <div  class="card card-7 page-content" >
                            
                            <div>
                                @if($errors->any())
                                <div class="alert alert-danger animated bounce">{{ $errors->first() }}</div>
                                @endif
                                <form name="loginForm" action="{{ route('auth.login') }}" class="needs-validation form page-form" method="post">
                                    @csrf
                                    <div class="input-group form-group">
                                        <input placeholder="{{ __('usernameOrEmail') }}" name="username"  required="required" class="form-control" type="text"  />
                                        <span class="input-group-text"><i class="form-control-feedback material-icons">account_circle</i></span>
                                    </div>
                                    <div class="input-group form-group">
                                        
                                        <input  placeholder="{{ __('password') }}" required="required" name="password" class="form-control " type="password" />
                                        <span class="input-group-text"><i class="form-control-feedback material-icons">lock</i></span>
                                    </div>
                                    <div class="row clearfix mt-3 mb-3">
                                        <div class="col-6">
                                            <label class="">
                                            <input value="true" type="checkbox" name="rememberme" />
                                            {{ __('rememberMe') }}
                                            </label>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('password.forgotpassword') }}" class="text-danger"> {{ __('resetPassword') }}</a>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary btn-block btn-md" type="submit"> 
                                        <i class="load-indicator">
                                        <clip-loader :loading="loading" color="#fff" size="20px"></clip-loader> 
                                        </i>
                                        {{ __('login') }} <i class="material-icons">lock_open</i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                        <div class=" card-7">                                   <div class="text-center">
                            {{ __('dontHaveAnAccount') }} <a href="{{ route('auth.register') }}" class="btn btn-success">{{ __('register') }}
                            <i class="material-icons">account_box</i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 comp-grid " >
                    <div class=" "><div>
                        @php
                        $config = DB::table('config_site')->first(); // pega a primeira configuração
                        @endphp
                        <!DOCTYPE html>
                        <html lang="pt-BR">
                        <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>{!! $config->nome_site ?? 'Meu Site' !!}</title> {{-- evita erro se $config for null --}}
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
                            <style>
                            body { font-family: Arial, sans-serif; background: #f4f4f4; margin:0; padding:0; }
                            .site-config { max-width: 800px; margin:50px auto; background:#fff; padding:30px; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.1); }
                            .logo img { max-width:150px; margin-bottom:20px; }
                            h1 { margin:0 0 10px; font-size:28px; color:#333; }
                            p { margin:5px 0; color:#555; }
                            .redes-sociais { margin-top:20px; }
                            .redes-sociais a { display:inline-block; margin-right:15px; font-size:24px; color:#555; transition: color 0.3s; text-decoration:none; }
                            .redes-sociais a:hover { color:#007BFF; }
                            .info { margin-top:15px; }
                            </style>
                            </head>
                            <body>
                            @if($config)
                            <div class="site-config">
                                <div class="logo">
                                    @if($config->logo)
                                    <img src="{{ asset($config->logo) }}" alt="Logo do Site">
                                    @endif
                                </div>
                                <h1>{!! $config->nome_site !!}</h1>
                                <div class="info">
                                    @if($config->cnpj)<p><strong>CNPJ:</strong> {{ $config->cnpj }}</p>@endif
                                    @if($config->endereco)<p><strong>Endereço:</strong> {!! $config->endereco !!}</p>@endif
                                    @if($config->telefone)<p><strong>Telefone:</strong> {{ $config->telefone }}</p>@endif
                                    @if($config->whatsapp)<p><strong>WhatsApp:</strong> {{ $config->whatsapp }}</p>@endif
                                    @if($config->email)<p><strong>Email:</strong> {{ $config->email }}</p>@endif
                                    @if($config->horario_funcionamento)<p><strong>Horário de Funcionamento:</strong> {!! $config->horario_funcionamento !!}</p>@endif
                                </div>
                                <div class="redes-sociais">
                                    @if($config->facebook)
                                    <a href="https://facebook.com/{{ $config->facebook }}" target="_blank">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                    @endif
                                    @if($config->instagram)
                                    <a href="https://instagram.com/{{ $config->instagram }}" target="_blank">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    @endif
                                    @if($config->twitter)
                                    <a href="https://twitter.com/{{ $config->twitter }}" target="_blank">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    @endif
                                    @if($config->linkedin)
                                    <a href="https://linkedin.com/in/{{ $config->linkedin }}" target="_blank">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                    @endif
                                    @if($config->youtube)
                                    <a href="https://youtube.com/{{ $config->youtube }}" target="_blank">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @else
                            <p>Nenhuma configuração cadastrada.</p>
                            @endif
                            </body>
                            </html>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col comp-grid " >
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- Page custom css -->
@section('pagecss')
<style>
<style></style>
</style>
@endsection
<!-- Page custom js -->
@section('pagejs')
<script>
    $(document).ready(function(){
    // custom javascript | jquery codes
    });
</script>
@endsection
