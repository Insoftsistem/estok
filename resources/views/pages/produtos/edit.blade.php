<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('editProduto'); //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="edit" data-page-url="{{ url()->full() }}">
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
                        {{ __('editProduto') }}
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("produtos/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="foto">{{ __('foto') }} </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-foto-holder" class=" ">
                                            <div class="dropzone " input="#ctrl-foto" fieldname="foto" uploadurl="{{ url('fileuploader/upload/foto') }}"    data-multiple="false" dropmsg="{{ __('chooseFilesOrDropFilesHere') }}"    btntext="{{ __('browse') }}" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                                <input name="foto" id="ctrl-foto" data-field="foto" class="dropzone-input form-control" value="<?php  echo $data['foto']; ?>" type="text"  />
                                                <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseAChooseFile') }}</div>-->
                                                <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                            </div>
                                        </div>
                                        <?php Html :: uploaded_files_list($data['foto'], '#ctrl-foto'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="nome">{{ __('nome') }} <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-nome-holder" class=" ">
                                            <input id="ctrl-nome" data-field="nome"  value="<?php  echo $data['nome']; ?>" type="text" placeholder="{{ __('enterNome') }}"  required="" name="nome"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="descricao">{{ __('descricao') }} </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-descricao-holder" class=" ">
                                            <textarea placeholder="{{ __('enterDescricao') }}" id="ctrl-descricao" data-field="descricao"  rows="5" name="descricao" class=" form-control"><?php  echo $data['descricao']; ?></textarea>
                                            <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseEnterText') }}</div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="preco">{{ __('preco') }} <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-preco-holder" class=" ">
                                            <input id="ctrl-preco" data-field="preco"  value="<?php  echo $data['preco']; ?>" type="number" placeholder="{{ __('enterPreco') }}" step="0.1"  required="" name="preco"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="quantidade">{{ __('quantidade') }} </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-quantidade-holder" class=" ">
                                            <input id="ctrl-quantidade" data-field="quantidade"  value="<?php  echo $data['quantidade']; ?>" type="number" placeholder="{{ __('enterQuantidade') }}" step="any"  name="quantidade"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-ajax-status"></div>
                        <!--[form-content-end]-->
                        <!--[form-button-start]-->
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">
                            {{ __('update') }}
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
    <!--pageautofill-->$(document).ready(function(){
	// custom javascript | jquery codes
});
</script>
@endsection
