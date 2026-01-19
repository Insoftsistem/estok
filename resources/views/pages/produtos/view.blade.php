<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("produtos/add");
    $can_edit = $user->canAccess("produtos/edit");
    $can_view = $user->canAccess("produtos/view");
    $can_delete = $user->canAccess("produtos/delete");
    $pageTitle = __('produtoDetails'); //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="view" data-page-url="{{ url()->full() }}">
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
                        {{ __('produtoDetails') }}
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
                <div class="col comp-grid " >
                    <div  class=" page-content" >
                        <?php
                            if($data){
                            $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                        ?>
                        <div id="page-main-content" class=" px-3 mb-3">
                            <div class="row gutter-lg ">
                                <div class="col">
                                    <div class="page-data">
                                        <!--PageComponentStart-->
                                        <div class="mb-3 row row justify-content-start g-0">
                                            <div class="col-12">
                                                <div class="bg-light mb-1 card-1 p-2 border rounded">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <small class="text-muted">{{ __('id') }}</small>
                                                            <div class="fw-bold">
                                                                <?php echo  $data['id'] ; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="bg-light mb-1 card-1 p-2 border rounded">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <small class="text-muted">{{ __('nome') }}</small>
                                                            <div class="fw-bold">
                                                                <?php echo  $data['nome'] ; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="bg-light mb-1 card-1 p-2 border rounded">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <small class="text-muted">{{ __('descricao') }}</small>
                                                            <div class="fw-bold">
                                                                <?php echo  $data['descricao'] ; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="bg-light mb-1 card-1 p-2 border rounded">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <small class="text-muted">{{ __('preco') }}</small>
                                                            <div class="fw-bold">
                                                                <?php echo  $data['preco'] ; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="bg-light mb-1 card-1 p-2 border rounded">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <small class="text-muted">{{ __('quantidade') }}</small>
                                                            <div class="fw-bold">
                                                                <?php echo  $data['quantidade'] ; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="bg-light mb-1 card-1 p-2 border rounded">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <small class="text-muted">{{ __('foto') }}</small>
                                                            <div class="fw-bold">
                                                                <?php 
                                                                    Html :: page_img($data['foto'], 'auto', 'auto', "", 1); 
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="bg-light mb-1 card-1 p-2 border rounded">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <small class="text-muted">{{ __('dataAtualizacao') }}</small>
                                                            <div class="fw-bold">
                                                                <?php echo  $data['data_atualizacao'] ; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--PageComponentEnd-->
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="dropup export-btn-holder">
                                                <button  class="btn  btn-sm btn-outline-primary dropdown-toggle" title="Export" type="button" data-bs-toggle="dropdown">
                                                <i class="material-icons">save</i> {{ __('export') }}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <?php Html :: export_menus(['pdf', 'print', 'excel', 'csv']); ?>
                                                </div>
                                            </div>
                                            <?php if($can_edit){ ?>
                                            <a class="btn btn-sm btn-success has-tooltip "   title="{{ __('edit') }}" href="<?php print_link("produtos/edit/$rec_id"); ?>" >
                                            <i class="material-icons">edit</i> {{ __('edit') }}
                                        </a>
                                        <?php } ?>
                                        <?php if($can_delete){ ?>
                                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="{{ __('promptDeleteRecord') }}" data-display-style="modal" title="{{ __('delete') }}" href="<?php print_link("produtos/delete/$rec_id?redirect=produtos"); ?>" >
                                        <i class="material-icons">delete_sweep</i> {{ __('delete') }}
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- Detail Page Column -->
                        <?php if(!request()->has('subpage')){ ?>
                        <div class="col-12">
                            <div class="my-3 p-1 ">
                                @include("pages.produtos.detail-pages", ["masterRecordId" => $rec_id])
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php
                    }
                    else{
                ?>
                <!-- Empty Record Message -->
                <div class="text-muted p-3">
                    <i class="material-icons">block</i> {{ __('noRecordFound') }}
                </div>
                <?php
                    }
                ?>
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
