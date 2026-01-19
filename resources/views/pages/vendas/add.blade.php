<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('novaVenda'); //set dynamic page title
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
                        {{ __('novaVenda') }}
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
                        <form id="vendas-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('vendas.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="loja_id">{{ __('lojaId') }} <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-loja_id-holder" class=" ">
                                                <select required=""  id="ctrl-loja_id" data-field="loja_id" name="loja_id"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                                <option value="">{{ __('selectAValue') }}</option>
                                                <?php 
                                                    $options = $comp_model->loja_origem_id_option_list() ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $selected = Html::get_field_selected('loja_id', $value, "");
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
                                            <label class="control-label" for="cliente_nome">{{ __('clienteNome') }} </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-cliente_nome-holder" class=" ">
                                                <input id="ctrl-cliente_nome" data-field="cliente_nome"  value="<?php echo get_value('cliente_nome', "'CONSUMIDOR FINAL'") ?>" type="text" placeholder="{{ __('enterClienteNome') }}"  name="cliente_nome"  class="form-control " />
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
                                                <input id="ctrl-valor_total" data-field="valor_total"  value="<?php echo get_value('valor_total', "0.00") ?>" type="number" placeholder="{{ __('enterValorTotal') }}" step="0.1"  name="valor_total"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="forma_pagamento">{{ __('formaPagamento') }} <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-forma_pagamento-holder" class=" ">
                                                <select required=""  id="ctrl-forma_pagamento" data-field="forma_pagamento" name="forma_pagamento"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                                <option value="">{{ __('selectAValue') }}</option>
                                                <?php
                                                    $options = Menu::formaPagamento();
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    $selected = Html::get_field_selected('forma_pagamento', $value, "");
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
                            </div>
                            <div class="form-ajax-status"></div>
                            <div class="bg-light p-2 subform">
                                <h4 class="record-title">Novo Item </h4>
                                <hr />
                                @csrf
                                <div>
                                    <table class="table table-striped table-sm" data-maxrow="10" data-minrow="1">
                                        <thead>
                                            <tr>
                                                <th class="bg-light"><label for="produto_id">{{ __('produtoId') }}</label></th>
                                                <th class="bg-light"><label for="quantidade">{{ __('quantidade') }}</label></th>
                                                <th class="bg-light"><label for="valor_unitario">{{ __('valorUnitario') }}</label></th>
                                                <th class="bg-light"><label for="subtotal">{{ __('subtotal') }}</label></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th colspan="100" class="text-right">
                                            <?php $template_id = "table-row-" . random_str(); ?>
                                            <button type="button" data-template="#<?php echo $template_id ?>" class="btn btn-sm btn-success btn-add-table-row"><i class="material-icons">add</i></button>
                                            </th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <!--[table row template]-->
                                    <template id="<?php echo $template_id ?>">
                                    <?php $row = "CURRENTROW"; // will be replaced with current row index. ?>
                                    <tr data-row="<?php echo $row ?>" class="input-row">
                                    <td>
                                        <div id="ctrl-produto_id-row<?php echo $row; ?>-holder" class=" ">
                                        <select required="" data-endpoint="<?php print_link('componentsdata/produto_id_option_list') ?>" id="ctrl-produto_id-row<?php echo $row; ?>" data-field="produto_id" name="vendasitens[<?php echo $row ?>][produto_id]"  placeholder="{{ __('selectAValue') }}"    class="selectize-ajax" >
                                        <option value="">{{ __('selectAValue') }}</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div id="ctrl-quantidade-row<?php echo $row; ?>-holder" class=" ">
                                    <input id="ctrl-quantidade-row<?php echo $row; ?>" data-field="quantidade"  value="<?php echo get_value('quantidade') ?>" type="number" placeholder="{{ __('enterQuantidade') }}" step="any"  required="" name="vendasitens[<?php echo $row ?>][quantidade]"  class="form-control " />
                                </div>
                            </td>
                            <td>
                                <div id="ctrl-valor_unitario-row<?php echo $row; ?>-holder" class=" ">
                                <input id="ctrl-valor_unitario-row<?php echo $row; ?>" data-field="valor_unitario"  value="<?php echo get_value('valor_unitario') ?>" type="number" placeholder="{{ __('enterValorUnitario') }}" step="0.1"  required="" name="vendasitens[<?php echo $row ?>][valor_unitario]"  class="form-control " />
                            </div>
                        </td>
                        <td>
                            <div id="ctrl-subtotal-row<?php echo $row; ?>-holder" class=" ">
                            <input id="ctrl-subtotal-row<?php echo $row; ?>" data-field="subtotal"  value="<?php echo get_value('subtotal', "NULL") ?>" type="number" placeholder="{{ __('enterSubtotal') }}" step="0.1"  name="vendasitens[<?php echo $row ?>][subtotal]"  class="form-control " />
                        </div>
                    </td>
                    <th class="text-center">
                    <button type="button" class="btn-close btn-remove-table-row"></button>
                    </th>
                </tr>
            </template>
            <!--[/table row template]-->
        </div>
        <div class="form-ajax-status"></div>
    </div>
    <!--[form-button-start]-->
    <div class="form-group form-submit-btn-holder text-center mt-3">
        <button class="btn btn-primary" type="submit">
        {{ __('submitFinalizar') }}
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
