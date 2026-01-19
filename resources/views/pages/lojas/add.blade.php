<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('addNewLoja'); //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="add" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto  back-btn-col" >
                    <a class="back-btn btn " href="{{ url()->previous() }}" >
                        <i class="material-icons">arrow_back</i>                                
                         
                    </a>
                </div>
                <div class="col  " >
                    <div class=" h5 font-weight-bold text-primary" >
                        {{ __('addNewLoja') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <div  class="" >
        <div class="container">
            <div class="row ">
                <div class="col-md-9 comp-grid " >
                    <div  class="card card-1 border rounded page-content" >
                        <!--[form-start]-->
                        <form id="lojas-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('lojas.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="nome">{{ __('nome') }} <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-nome-holder" class=" ">
                                                <input id="ctrl-nome" data-field="nome"  value="<?php echo get_value('nome') ?>" type="text" placeholder="{{ __('enterNome') }}"  required="" name="nome"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="cnpj">{{ __('cnpj') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-cnpj-holder" class=" ">
                                                <input id="ctrl-cnpj" data-field="cnpj"  value="<?php echo get_value('cnpj', "NULL") ?>" type="text" placeholder="{{ __('enterCnpj') }}"  name="cnpj"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="email">{{ __('email') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-email-holder" class=" ">
                                                <input id="ctrl-email" data-field="email"  value="<?php echo get_value('email', "NULL") ?>" type="email" placeholder="{{ __('enterEmail') }}"  name="email"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="telefone">{{ __('telefone') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-telefone-holder" class=" ">
                                                <input id="ctrl-telefone" data-field="telefone"  value="<?php echo get_value('telefone', "NULL") ?>" type="text" placeholder="{{ __('enterTelefone') }}"  name="telefone"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="endereco">{{ __('endereco') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-endereco-holder" class=" ">
                                                <input id="ctrl-endereco" data-field="endereco"  value="<?php echo get_value('endereco', "NULL") ?>" type="text" placeholder="{{ __('enterEndereco') }}"  name="endereco"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-ajax-status"></div>
                            <!--[form-button-start]-->
                            <div class="form-group form-submit-btn-holder text-center mt-3">
                                <button class="btn btn-primary" type="submit">
                                {{ __('submit') }}
                                <i class="material-icons">send</i>
                                </button>
                            </div>
                            <!--[form-button-end]-->
                        </form>
                        <!--[form-end]-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<!-- Page custom css -->
@section('pagecss')
<style>

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
