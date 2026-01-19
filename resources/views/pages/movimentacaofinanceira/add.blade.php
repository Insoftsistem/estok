<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('addNewMovimentacaoFinanceira'); //set dynamic page title
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
                        {{ __('addNewMovimentacaoFinanceira') }}
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
                        <form id="movimentacaofinanceira-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('movimentacaofinanceira.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="produto_id">{{ __('produtoId') }} <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-produto_id-holder" class=" ">
                                                <select required=""  id="ctrl-produto_id" data-field="produto_id" name="produto_id"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                                <option value="">{{ __('selectAValue') }}</option>
                                                <?php 
                                                    $options = $comp_model->estoquemovimentos_produto_id_option_list() ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $selected = Html::get_field_selected('produto_id', $value, "");
                                                ?>
                                                <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                <?php echo $label; ?>
                                                </option>
                                                <?php
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="tipo_movimentacao">{{ __('tipoMovimentacao') }} <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-tipo_movimentacao-holder" class=" ">
                                                <select required=""  id="ctrl-tipo_movimentacao" data-field="tipo_movimentacao" name="tipo_movimentacao"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                                <option value="">{{ __('selectAValue') }}</option>
                                                <?php
                                                    $options = Menu::tipoMovimentacao();
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    $selected = Html::get_field_selected('tipo_movimentacao', $value, "");
                                                ?>
                                                <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                <?php echo $label ?>
                                                </option>                                   
                                                <?php
                                                    }
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="quantidade">{{ __('quantidade') }} <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-quantidade-holder" class=" ">
                                                <input id="ctrl-quantidade" data-field="quantidade"  value="<?php echo get_value('quantidade') ?>" type="number" placeholder="{{ __('enterQuantidade') }}" step="any"  required="" name="quantidade"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="valor_unitario">{{ __('valorUnitario') }} <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-valor_unitario-holder" class=" ">
                                                <input id="ctrl-valor_unitario" data-field="valor_unitario"  value="<?php echo get_value('valor_unitario') ?>" type="number" placeholder="{{ __('enterValorUnitario') }}" step="0.1"  required="" name="valor_unitario"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="valor_total">{{ __('valorTotal') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-valor_total-holder" class=" ">
                                                <input id="ctrl-valor_total" data-field="valor_total"  value="<?php echo get_value('valor_total', "NULL") ?>" type="number" placeholder="{{ __('enterValorTotal') }}" step="0.1"  name="valor_total"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="loja_origem_id">{{ __('lojaOrigemId') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-loja_origem_id-holder" class=" ">
                                                <select  id="ctrl-loja_origem_id" data-field="loja_origem_id" name="loja_origem_id"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                                <option value="">{{ __('selectAValue') }}</option>
                                                <?php 
                                                    $options = $comp_model->loja_origem_id_option_list() ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $selected = Html::get_field_selected('loja_origem_id', $value, "");
                                                ?>
                                                <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                <?php echo $label; ?>
                                                </option>
                                                <?php
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="loja_destino_id">{{ __('lojaDestinoId') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-loja_destino_id-holder" class=" ">
                                                <select  id="ctrl-loja_destino_id" data-field="loja_destino_id" name="loja_destino_id"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                                <option value="">{{ __('selectAValue') }}</option>
                                                <?php 
                                                    $options = $comp_model->loja_origem_id_option_list() ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $selected = Html::get_field_selected('loja_destino_id', $value, "");
                                                ?>
                                                <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                <?php echo $label; ?>
                                                </option>
                                                <?php
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="observacao">{{ __('observacao') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-observacao-holder" class=" ">
                                                <textarea placeholder="{{ __('enterObservacao') }}" id="ctrl-observacao" data-field="observacao"  rows="5" name="observacao" class="htmleditor form-control"><?php echo get_value('observacao') ?></textarea>
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
