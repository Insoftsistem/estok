<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('editVenda'); //set dynamic page title
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
                        {{ __('editVenda') }}
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
                        <div class="row gutter-lg ">
                            <div class="col">
                                <!--[form-start]-->
                                <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("vendas/edit/$rec_id"); ?>" method="post">
                                <!--[form-content-start]-->
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
                                                        $selected = ( $value == $data['loja_id'] ? 'selected' : null );
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
                                                    <input id="ctrl-cliente_nome" data-field="cliente_nome"  value="<?php  echo $data['cliente_nome']; ?>" type="text" placeholder="{{ __('enterClienteNome') }}"  name="cliente_nome"  class="form-control " />
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
                                                    <input id="ctrl-valor_total" data-field="valor_total"  value="<?php  echo $data['valor_total']; ?>" type="number" placeholder="{{ __('enterValorTotal') }}" step="0.1"  name="valor_total"  class="form-control " />
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
                                                        $field_value = $data['forma_pagamento'];
                                                        if(!empty($options)){
                                                        foreach($options as $option){
                                                        $value = $option['value'];
                                                        $label = $option['label'];
                                                        $selected = Html::get_record_selected($field_value, $value);
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
                        <!-- Detail Page Column -->
                        <?php if(!request()->has('subpage')){ ?>
                        <div class="col-12">
                            <div class="my-3 ">
                                @include("pages.vendas.detail-pages", ["masterRecordId" => $rec_id])
                            </div>
                        </div>
                        <?php } ?>
                    </div>
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
