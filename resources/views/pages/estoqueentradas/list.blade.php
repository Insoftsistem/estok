<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("estoqueentradas/add");
    $can_edit = $user->canAccess("estoqueentradas/edit");
    $can_view = $user->canAccess("estoqueentradas/view");
    $can_delete = $user->canAccess("estoqueentradas/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = __('estoqueEntradas'); //set dynamic page title
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
                        {{ __('estoqueEntradas') }}
                    </div>
                </div>
                <div class="col-auto  " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary btn-block" href="<?php print_link("estoqueentradas/add", true) ?>" >
                    <i class="material-icons">add</i>                               
                    {{ __('addNewEstoqueEntrada') }} 
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
                    <div id="estoqueentradas-list-records">
                        <div id="page-main-content" class="table-responsive">
                            <?php Html::page_bread_crumb("/estoqueentradas/", $field_name, $field_value); ?>
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
                                        <th class="td-produto_id" > {{ __('produtoId') }}</th>
                                        <th class="td-quantidade" > {{ __('quantidade') }}</th>
                                        <th class="td-valor_unitario" > {{ __('valorUnitario') }}</th>
                                        <th class="td-data_entrada" > {{ __('dataEntrada') }}</th>
                                        <th class="td-recebido" > {{ __('recebido') }}</th>
                                        <th class="td-usuario_id" > {{ __('usuarioId') }}</th>
                                        <th class="td-loja_origem_id" > {{ __('lojaOrigemId') }}</th>
                                        <th class="td-loja_destino_id" > {{ __('lojaDestinoId') }}</th>
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
                                            <a href="<?php print_link("/estoqueentradas/view/$data[id]") ?>"><?php echo $data['id']; ?></a>
                                        </td>
                                        <td class="td-produto_id">
                                            <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("produtos/view/$data[produto_id]?subpage=1") ?>">
                                            <i class="material-icons">visibility</i> <?php echo "Produtos" ?>
                                        </a>
                                    </td>
                                    <td class="td-quantidade">
                                        <span <?php if($can_edit){ ?> data-step="any" 
                                        data-source='<?php print_link('componentsdata/valor_option_list'); ?>' 
                                        data-value="<?php echo $data['quantidade']; ?>" 
                                        data-pk="<?php echo $data['id'] ?>" 
                                        data-url="<?php print_link("estoqueentradas/edit/" . urlencode($data['id'])); ?>" 
                                        data-name="quantidade" 
                                        data-title="Enter Quantidade" 
                                        data-placement="left" 
                                        data-toggle="click" 
                                        data-type="number" 
                                        data-mode="popover" 
                                        data-showbuttons="left" 
                                        class="is-editable" <?php } ?>>
                                        <?php echo  $data['quantidade'] ; ?>
                                        </span>
                                    </td>
                                    <td class="td-valor_unitario">
                                        <span <?php if($can_edit){ ?> data-step="0.1" 
                                        data-source='<?php print_link('componentsdata/valor_option_list'); ?>' 
                                        data-value="<?php echo $data['valor_unitario']; ?>" 
                                        data-pk="<?php echo $data['id'] ?>" 
                                        data-url="<?php print_link("estoqueentradas/edit/" . urlencode($data['id'])); ?>" 
                                        data-name="valor_unitario" 
                                        data-title="Enter Valor Unitario" 
                                        data-placement="left" 
                                        data-toggle="click" 
                                        data-type="number" 
                                        data-mode="popover" 
                                        data-showbuttons="left" 
                                        class="is-editable" <?php } ?>>
                                        <?php echo  $data['valor_unitario'] ; ?>
                                        </span>
                                    </td>
                                    <td class="td-data_entrada"><strong><?php echo $data['data_entrada']; ?></strong>
                                <button class="btn-emitir-entrada" data-id="<?= $data['id'] ?>">
                                Emitir Nota de Entrada
                                </button>
                                <!-- SweetAlert2 -->
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script>
                                    $(function () {
                                    $('.btn-emitir-entrada').on('click', function () {
                                    const entradaId = $(this).data('id');
                                    Swal.fire({
                                    title: 'Emitir Nota de Entrada',
                                    text: 'Deseja gerar a nota dessa entrada de estoque?',
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonText: 'Sim, gerar!',
                                    cancelButtonText: 'Cancelar'
                                    }).then((result) => {
                                    if (result.isConfirmed) {
                                const url = "<?= url('pdf/entrada-estoque') ?>/" + entradaId;
                                window.open(url, '_blank');
                                Swal.fire({
                                icon: 'success',
                                title: 'Nota gerada!',
                                timer: 1500,
                                showConfirmButton: false
                                });
                                }
                                });
                                });
                                });
                            </script>
                        </td>
                        <td class="td-recebido">
                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu::recebido()); ?>' 
                            data-value="<?php echo $data['recebido']; ?>" 
                            data-pk="<?php echo $data['id'] ?>" 
                            data-url="<?php print_link("estoqueentradas/edit/" . urlencode($data['id'])); ?>" 
                            data-name="recebido" 
                            data-title="Enter Recebido" 
                            data-placement="left" 
                            data-toggle="click" 
                            data-type="checklist" 
                            data-mode="popover" 
                            data-showbuttons="left" 
                            class="is-editable" <?php } ?>>
                            <?php echo  $data['recebido'] ; ?>
                            </span>
                        </td>
                        <td class="td-usuario_id">
                            <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("users/view/$data[usuario_id]?subpage=1") ?>">
                            <i class="material-icons">visibility</i> <?php echo "Users" ?>
                        </a>
                    </td>
                    <td class="td-loja_origem_id">
                        <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("lojas/view/$data[loja_origem_id]?subpage=1") ?>">
                        <i class="material-icons">visibility</i> <?php echo "Lojas" ?>
                    </a>
                </td>
                <td class="td-loja_destino_id">
                    <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("lojas/view/$data[loja_destino_id]?subpage=1") ?>">
                    <i class="material-icons">visibility</i> <?php echo "Lojas" ?>
                </a>
            </td>
            <!--PageComponentEnd-->
            <td class="td-btn">
                <div class="dropdown" >
                    <button data-bs-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                    <i class="material-icons">menu</i> 
                    </button>
                    <ul class="dropdown-menu">
                        <?php if($can_view){ ?>
                        <a class="dropdown-item "   href="<?php print_link("estoqueentradas/view/$rec_id"); ?>" >
                        <i class="material-icons">visibility</i> {{ __('view') }}
                    </a>
                    <?php } ?>
                    <?php if($can_edit){ ?>
                    <a class="dropdown-item "   href="<?php print_link("estoqueentradas/edit/$rec_id"); ?>" >
                    <i class="material-icons">edit</i> {{ __('edit') }}
                </a>
                <?php } ?>
                <?php if($can_delete){ ?>
                <a class="dropdown-item record-delete-btn" data-prompt-msg="{{ __('promptDeleteRecord') }}" data-display-style="modal" href="<?php print_link("estoqueentradas/delete/$rec_id"); ?>" >
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
            <button data-prompt-msg="{{ __('promptDeleteRecords') }}" data-display-style="modal" data-url="<?php print_link("estoqueentradas/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
            <?php Html :: import_form('estoqueentradas/importdata' , __('importData')); ?>
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
