<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("caixa/add");
    $can_edit = $user->canAccess("caixa/edit");
    $can_view = $user->canAccess("caixa/view");
    $can_delete = $user->canAccess("caixa/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = __('caixa'); //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="list" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center gap-3">
                <div class="col  " >
                    <div class=" h5 font-weight-bold text-primary" >
                        {{ __('caixa') }}
                    </div>
                </div>
                <div class="col-auto  " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary btn-block" href="<?php print_link("caixa/add", true) ?>" >
                    <i class="material-icons">add</i>                               
                    {{ __('addNewCaixa') }} 
                </a>
                <?php } ?>
            </div>
            <div class="col-md-3  " >
                <!-- Page drop down search component -->
                <form  class="search" action="{{ url()->current() }}" method="get">
                    <input type="hidden" name="page" value="1" />
                    <div class="input-group">
                        <input value="<?php echo get_value('search'); ?>" class="form-control page-search" type="text" name="search"  placeholder="{{ __('search') }}" />
                        <button class="btn btn-primary"><i class="material-icons">search</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>
<div  class="" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col comp-grid " >
                <div  class=" page-content" >
                    <div id="caixa-list-records">
                        <div id="page-main-content" class="table-responsive">
                            <?php Html::page_bread_crumb("/caixa/", $field_name, $field_value); ?>
                            <?php Html::display_page_errors($errors); ?>
                            <div class="filter-tags mb-2">
                                <?php Html::filter_tag('search', __('Search')); ?>
                            </div>
                            <table class="table table-hover table-striped table-sm text-left">
                                <thead class="table-header ">
                                    <tr>
                                        <?php if($can_delete){ ?>
                                        <th class="td-checkbox">
                                        <label class="form-check-label">
                                        <input class="toggle-check-all form-check-input" type="checkbox" />
                                        </label>
                                        </th>
                                        <?php } ?>
                                        <th class="td-id" > {{ __('id') }}</th>
                                        <th class="td-movimentacao_id" > {{ __('movimentacaoId') }}</th>
                                        <th class="td-tipo" > {{ __('tipo') }}</th>
                                        <th class="td-valor" > {{ __('valor') }}</th>
                                        <th class="td-descricao" > {{ __('descricao') }}</th>
                                        <th class="td-data_movimento" > {{ __('dataMovimento') }}</th>
                                        <th class="td-btn"></th>
                                    </tr>
                                </thead>
                                <?php
                                    if($total_records){
                                ?>
                                <tbody class="page-data">
                                    <!--record-->
                                    <?php
                                        $counter = 0;
                                        foreach($records as $data){
                                        $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                        $counter++;
                                    ?>
                                    <tr>
                                        <?php if($can_delete){ ?>
                                        <td class=" td-checkbox">
                                            <label class="form-check-label">
                                            <input class="optioncheck form-check-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                                            </label>
                                        </td>
                                        <?php } ?>
                                        <!--PageComponentStart-->
                                        <td class="td-id">
                                            <a href="<?php print_link("/caixa/view/$data[id]") ?>"><?php echo $data['id']; ?></a>
                                        </td>
                                        <td class="td-movimentacao_id">
                                            <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("movimentacaofinanceira/view/$data[movimentacao_id]?subpage=1") ?>">
                                            <i class="material-icons">visibility</i> <?php echo "Movimentacao Financeira" ?>
                                        </a>
                                    </td>
                                    <td class="td-tipo">
                                        <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu::tipo()); ?>' 
                                        data-value="<?php echo $data['tipo']; ?>" 
                                        data-pk="<?php echo $data['id'] ?>" 
                                        data-url="<?php print_link("caixa/edit/" . urlencode($data['id'])); ?>" 
                                        data-name="tipo" 
                                        data-title="Select a value ..." 
                                        data-placement="left" 
                                        data-toggle="click" 
                                        data-type="select" 
                                        data-mode="popover" 
                                        data-showbuttons="left" 
                                        class="is-editable" <?php } ?>>
                                        <?php echo  $data['tipo'] ; ?>
                                        </span>
                                    </td>
                                    <td class="td-valor">
                                        <span <?php if($can_edit){ ?> data-step="0.1" 
                                        data-source='<?php print_link('componentsdata/valor_option_list'); ?>' 
                                        data-value="<?php echo $data['valor']; ?>" 
                                        data-pk="<?php echo $data['id'] ?>" 
                                        data-url="<?php print_link("caixa/edit/" . urlencode($data['id'])); ?>" 
                                        data-name="valor" 
                                        data-title="Enter Valor" 
                                        data-placement="left" 
                                        data-toggle="click" 
                                        data-type="number" 
                                        data-mode="popover" 
                                        data-showbuttons="left" 
                                        class="is-editable" <?php } ?>>
                                        <?php echo  $data['valor'] ; ?>
                                        </span>
                                    </td>
                                    <td class="td-descricao">
                                        <span <?php if($can_edit){ ?> data-source='<?php print_link('componentsdata/valor_option_list'); ?>' 
                                        data-value="<?php echo $data['descricao']; ?>" 
                                        data-pk="<?php echo $data['id'] ?>" 
                                        data-url="<?php print_link("caixa/edit/" . urlencode($data['id'])); ?>" 
                                        data-name="descricao" 
                                        data-title="Enter Descricao" 
                                        data-placement="left" 
                                        data-toggle="click" 
                                        data-type="text" 
                                        data-mode="popover" 
                                        data-showbuttons="left" 
                                        class="is-editable" <?php } ?>>
                                        <?php echo  $data['descricao'] ; ?>
                                        </span>
                                    </td>
                                    <td class="td-data_movimento">
                                        <?php echo  $data['data_movimento'] ; ?>
                                    </td>
                                    <!--PageComponentEnd-->
                                    <td class="td-btn">
                                        <div class="dropdown" >
                                            <button data-bs-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                            <i class="material-icons">menu</i> 
                                            </button>
                                            <ul class="dropdown-menu">
                                                <?php if($can_view){ ?>
                                                <a class="dropdown-item "   href="<?php print_link("caixa/view/$rec_id"); ?>" >
                                                <i class="material-icons">visibility</i> {{ __('view') }}
                                            </a>
                                            <?php } ?>
                                            <?php if($can_edit){ ?>
                                            <a class="dropdown-item "   href="<?php print_link("caixa/edit/$rec_id"); ?>" >
                                            <i class="material-icons">edit</i> {{ __('edit') }}
                                        </a>
                                        <?php } ?>
                                        <?php if($can_delete){ ?>
                                        <a class="dropdown-item record-delete-btn" data-prompt-msg="{{ __('promptDeleteRecord') }}" data-display-style="modal" href="<?php print_link("caixa/delete/$rec_id"); ?>" >
                                        <i class="material-icons">delete_sweep</i> {{ __('delete') }}
                                    </a>
                                    <?php } ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        }
                    ?>
                    <!--endrecord-->
                </tbody>
                <tbody class="search-data"></tbody>
                <?php
                    }
                    else{
                ?>
                <tbody class="page-data">
                    <tr>
                        <td class="bg-light text-center text-muted animated bounce p-3" colspan="1000">
                            <i class="material-icons">block</i> {{ __('noRecordFound') }}
                        </td>
                    </tr>
                </tbody>
                <?php
                    }
                ?>
            </table>
        </div>
        <?php
            if($show_footer){
        ?>
        <div class=" mt-3">
            <div class="row align-items-center justify-content-between">    
                <div class="col-md-auto d-flex">    
                    <?php if($can_delete){ ?>
                    <button data-prompt-msg="{{ __('promptDeleteRecords') }}" data-display-style="modal" data-url="<?php print_link("caixa/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                    <i class="material-icons">delete_sweep</i> {{ __('deleteSelected') }}
                    </button>
                    <?php } ?>
                    <div class="dropup export-btn-holder">
                        <button  class="btn  btn-sm btn-outline-primary dropdown-toggle" title="Export" type="button" data-bs-toggle="dropdown">
                        <i class="material-icons">save</i> {{ __('export') }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php Html :: export_menus(['pdf', 'print', 'excel', 'csv']); ?>
                        </div>
                    </div>
                    <?php Html :: import_form('caixa/importdata' , __('importData')); ?>
                </div>
                <div class="col">   
                    <?php
                        if($show_pagination == true){
                        $pager = new Pagination($total_records, $record_count);
                        $pager->show_page_count = false;
                        $pager->show_record_count = true;
                        $pager->show_page_limit =false;
                        $pager->limit = $limit;
                        $pager->show_page_number_list = true;
                        $pager->pager_link_range=5;
                        $pager->render();
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
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
