<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('addNewConfigSite'); //set dynamic page title
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
                        {{ __('addNewConfigSite') }}
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
                        <form id="configsite-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('configsite.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="nome_site">{{ __('nomeSite') }} <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-nome_site-holder" class=" ">
                                                <textarea placeholder="{{ __('enterNomeSite') }}" id="ctrl-nome_site" data-field="nome_site"  required="" rows="5" name="nome_site" class="htmleditor form-control"><?php echo get_value('nome_site') ?></textarea>
                                                <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseEnterText') }}</div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="logo">{{ __('logo') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-logo-holder" class=" ">
                                                <div class="dropzone " input="#ctrl-logo" fieldname="logo" uploadurl="{{ url('fileuploader/upload/logo') }}"    data-multiple="false" dropmsg="{{ __('chooseFilesOrDropFilesHere') }}"    btntext="{{ __('browse') }}" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                                    <input name="logo" id="ctrl-logo" data-field="logo" class="dropzone-input form-control" value="<?php echo get_value('logo') ?>" type="text"  />
                                                    <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseAChooseFile') }}</div>-->
                                                    <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                </div>
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
                                            <label class="control-label" for="endereco">{{ __('endereco') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-endereco-holder" class=" ">
                                                <textarea placeholder="{{ __('enterEndereco') }}" id="ctrl-endereco" data-field="endereco"  rows="5" name="endereco" class="htmleditor form-control"><?php echo get_value('endereco') ?></textarea>
                                                <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseEnterText') }}</div>-->
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
                                                <input id="ctrl-telefone" data-field="telefone"  value="<?php echo get_value('telefone') ?>" type="tel" placeholder="{{ __('enterTelefone') }}"  name="telefone"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="whatsapp">{{ __('whatsapp') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-whatsapp-holder" class=" ">
                                                <input id="ctrl-whatsapp" data-field="whatsapp"  value="<?php echo get_value('whatsapp', "NULL") ?>" type="text" placeholder="{{ __('enterWhatsapp') }}"  name="whatsapp"  class="form-control " />
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
                                            <label class="control-label" for="facebook">{{ __('facebook') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-facebook-holder" class=" ">
                                                <input id="ctrl-facebook" data-field="facebook"  value="<?php echo get_value('facebook', "NULL") ?>" type="text" placeholder="{{ __('enterFacebook') }}"  name="facebook"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="instagram">{{ __('instagram') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-instagram-holder" class=" ">
                                                <input id="ctrl-instagram" data-field="instagram"  value="<?php echo get_value('instagram', "NULL") ?>" type="text" placeholder="{{ __('enterInstagram') }}"  name="instagram"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="twitter">{{ __('twitter') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-twitter-holder" class=" ">
                                                <input id="ctrl-twitter" data-field="twitter"  value="<?php echo get_value('twitter', "NULL") ?>" type="text" placeholder="{{ __('enterTwitter') }}"  name="twitter"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="linkedin">{{ __('linkedin') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-linkedin-holder" class=" ">
                                                <input id="ctrl-linkedin" data-field="linkedin"  value="<?php echo get_value('linkedin', "NULL") ?>" type="text" placeholder="{{ __('enterLinkedin') }}"  name="linkedin"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="youtube">{{ __('youtube') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-youtube-holder" class=" ">
                                                <input id="ctrl-youtube" data-field="youtube"  value="<?php echo get_value('youtube', "NULL") ?>" type="text" placeholder="{{ __('enterYoutube') }}"  name="youtube"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="horario_funcionamento">{{ __('horarioFuncionamento') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-horario_funcionamento-holder" class=" ">
                                                <input id="ctrl-horario_funcionamento" data-field="horario_funcionamento"  value="<?php echo get_value('horario_funcionamento', "NULL") ?>" type="text" placeholder="{{ __('enterHorarioFuncionamento') }}"  name="horario_funcionamento"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="sobre">{{ __('sobre') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-sobre-holder" class=" ">
                                                <textarea placeholder="{{ __('enterSobre') }}" id="ctrl-sobre" data-field="sobre"  rows="5" name="sobre" class="htmleditor form-control"><?php echo get_value('sobre') ?></textarea>
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
