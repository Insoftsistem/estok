<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('addNewInfo'); //set dynamic page title
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
                        {{ __('addNewInfo') }}
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
                        <form id="info-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('info.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="sobre_nos">{{ __('sobreNos') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-sobre_nos-holder" class=" ">
                                                <textarea placeholder="{{ __('enterSobreNos') }}" id="ctrl-sobre_nos" data-field="sobre_nos"  rows="5" name="sobre_nos" class="htmleditor form-control"><?php echo get_value('sobre_nos') ?></textarea>
                                                <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseEnterText') }}</div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="faq">{{ __('faq') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-faq-holder" class=" ">
                                                <textarea placeholder="{{ __('enterFaq') }}" id="ctrl-faq" data-field="faq"  rows="5" name="faq" class="htmleditor form-control"><?php echo get_value('faq') ?></textarea>
                                                <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseEnterText') }}</div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="politica_privacidade">{{ __('politicaPrivacidade') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-politica_privacidade-holder" class=" ">
                                                <textarea placeholder="{{ __('enterPoliticaPrivacidade') }}" id="ctrl-politica_privacidade" data-field="politica_privacidade"  rows="5" name="politica_privacidade" class="htmleditor form-control"><?php echo get_value('politica_privacidade') ?></textarea>
                                                <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseEnterText') }}</div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="termos_condicoes">{{ __('termosCondicoes') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-termos_condicoes-holder" class=" ">
                                                <textarea placeholder="{{ __('enterTermosCondicoes') }}" id="ctrl-termos_condicoes" data-field="termos_condicoes"  rows="5" name="termos_condicoes" class="htmleditor form-control"><?php echo get_value('termos_condicoes') ?></textarea>
                                                <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseEnterText') }}</div>-->
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
