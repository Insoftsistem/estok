<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php 
    $pageTitle = __('resumo'); // set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<div>
    <div  class="bg-light p-3 mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col comp-grid " >
                    <div class=" h5 font-weight-bold" >
                        {{ __('resumo') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col comp-grid " >
                </div>
            </div>
        </div>
    </div>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col comp-grid " >
                    <div class="card ">
                        <div >
                            <div class="card-header p-0 pt-2 px-2">
                                <ul class="nav  nav-tabs   ">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#TabPage330Page1" role="tab" aria-selected="true">
                                            <i class="material-icons ">widgets</i> 
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " data-bs-toggle="tab" href="#TabPage330Page2" role="tab" aria-selected="true">
                                            <i class="material-icons ">store</i> Lojas
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " data-bs-toggle="tab" href="#TabPage330Page3" role="tab" aria-selected="true">
                                            <i class="material-icons ">add_shopping_cart</i> Entradas
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " data-bs-toggle="tab" href="#TabPage330Page4" role="tab" aria-selected="true">
                                            <i class="material-icons ">remove_shopping_cart</i> Saídas
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " data-bs-toggle="tab" href="#TabPage330Page5" role="tab" aria-selected="true">
                                            <i class="material-icons ">local_shipping</i> Estoque
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " data-bs-toggle="tab" href="#TabPage330Page6" role="tab" aria-selected="true">
                                            <i class="material-icons ">monetization_on</i> Finança
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " data-bs-toggle="tab" href="#TabPage330Page7" role="tab" aria-selected="true">
                                            <i class="material-icons ">add_shopping_cart</i> Produtos
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " data-bs-toggle="tab" href="#TabPage330Page8" role="tab" aria-selected="true">
                                            <i class="material-icons ">monetization_on</i> Caixa
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " data-bs-toggle="tab" href="#TabPage330Page9" role="tab" aria-selected="true">
                                            <i class="material-icons ">insert_chart</i> Vendas
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " data-bs-toggle="tab" href="#TabPage330Page10" role="tab" aria-selected="true">
                                            <i class="material-icons ">people</i> User
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane show active fade" id="TabPage330Page1" role="tabpanel" >
                                    </div>
                                    <div class="tab-pane  fade" id="TabPage330Page2" role="tabpanel" >
                                        <div class=" ">
                                            <?php
                                                $params = [ 'limit' => 10]; //new query param
                                                $query = array_merge(request()->query(), $params);
                                                $queryParams = http_build_query($query);
                                                $url = url("lojas/lojas_view_list?$queryParams");
                                            ?>
                                            <div class="ajax-inline-page" data-url="{{ $url }}" >
                                                <div class="ajax-page-load-indicator">
                                                    <div class="text-center d-flex justify-content-center load-indicator">
                                                        <span class="loader mr-3"></span>
                                                        <span class="fw-bold">{{ __('loading') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane  fade" id="TabPage330Page3" role="tabpanel" >
                                        <div class=" ">
                                            <?php
                                                $params = [ 'limit' => 10]; //new query param
                                                $query = array_merge(request()->query(), $params);
                                                $queryParams = http_build_query($query);
                                                $url = url("estoqueentradas/entrada_view_list?$queryParams");
                                            ?>
                                            <div class="ajax-inline-page" data-url="{{ $url }}" >
                                                <div class="ajax-page-load-indicator">
                                                    <div class="text-center d-flex justify-content-center load-indicator">
                                                        <span class="loader mr-3"></span>
                                                        <span class="fw-bold">{{ __('loading') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane  fade" id="TabPage330Page4" role="tabpanel" >
                                        <div class=" ">
                                            <?php
                                                $params = [ 'limit' => 10]; //new query param
                                                $query = array_merge(request()->query(), $params);
                                                $queryParams = http_build_query($query);
                                                $url = url("estoquesaidas/saida_view?$queryParams");
                                            ?>
                                            <div class="ajax-inline-page" data-url="{{ $url }}" >
                                                <div class="ajax-page-load-indicator">
                                                    <div class="text-center d-flex justify-content-center load-indicator">
                                                        <span class="loader mr-3"></span>
                                                        <span class="fw-bold">{{ __('loading') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane  fade" id="TabPage330Page5" role="tabpanel" >
                                        <div class=" ">
                                            <?php
                                                $params = [ 'limit' => 10]; //new query param
                                                $query = array_merge(request()->query(), $params);
                                                $queryParams = http_build_query($query);
                                                $url = url("estoquemovimentos/estoque_view?$queryParams");
                                            ?>
                                            <div class="ajax-inline-page" data-url="{{ $url }}" >
                                                <div class="ajax-page-load-indicator">
                                                    <div class="text-center d-flex justify-content-center load-indicator">
                                                        <span class="loader mr-3"></span>
                                                        <span class="fw-bold">{{ __('loading') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane  fade" id="TabPage330Page6" role="tabpanel" >
                                        <div class=" ">
                                            <?php
                                                $params = [ 'limit' => 10]; //new query param
                                                $query = array_merge(request()->query(), $params);
                                                $queryParams = http_build_query($query);
                                                $url = url("movimentacaofinanceira/financa_view?$queryParams");
                                            ?>
                                            <div class="ajax-inline-page" data-url="{{ $url }}" >
                                                <div class="ajax-page-load-indicator">
                                                    <div class="text-center d-flex justify-content-center load-indicator">
                                                        <span class="loader mr-3"></span>
                                                        <span class="fw-bold">{{ __('loading') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane  fade" id="TabPage330Page7" role="tabpanel" >
                                        <div class=" ">
                                            <?php
                                                $params = [ 'limit' => 10]; //new query param
                                                $query = array_merge(request()->query(), $params);
                                                $queryParams = http_build_query($query);
                                                $url = url("produtos/produtos_view?$queryParams");
                                            ?>
                                            <div class="ajax-inline-page" data-url="{{ $url }}" >
                                                <div class="ajax-page-load-indicator">
                                                    <div class="text-center d-flex justify-content-center load-indicator">
                                                        <span class="loader mr-3"></span>
                                                        <span class="fw-bold">{{ __('loading') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane  fade" id="TabPage330Page8" role="tabpanel" >
                                        <div class=" ">
                                            <?php
                                                $params = [ 'limit' => 10]; //new query param
                                                $query = array_merge(request()->query(), $params);
                                                $queryParams = http_build_query($query);
                                                $url = url("caixa/caixa_view?$queryParams");
                                            ?>
                                            <div class="ajax-inline-page" data-url="{{ $url }}" >
                                                <div class="ajax-page-load-indicator">
                                                    <div class="text-center d-flex justify-content-center load-indicator">
                                                        <span class="loader mr-3"></span>
                                                        <span class="fw-bold">{{ __('loading') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane  fade" id="TabPage330Page9" role="tabpanel" >
                                        <div class=" ">
                                            <?php
                                                $params = [ 'limit' => 10]; //new query param
                                                $query = array_merge(request()->query(), $params);
                                                $queryParams = http_build_query($query);
                                                $url = url("vendas/vendas_view?$queryParams");
                                            ?>
                                            <div class="ajax-inline-page" data-url="{{ $url }}" >
                                                <div class="ajax-page-load-indicator">
                                                    <div class="text-center d-flex justify-content-center load-indicator">
                                                        <span class="loader mr-3"></span>
                                                        <span class="fw-bold">{{ __('loading') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane  fade" id="TabPage330Page10" role="tabpanel" >
                                        <div class=" ">
                                            <?php
                                                $params = [ 'limit' => 10]; //new query param
                                                $query = array_merge(request()->query(), $params);
                                                $queryParams = http_build_query($query);
                                                $url = url("users/users_view?$queryParams");
                                            ?>
                                            <div class="ajax-inline-page" data-url="{{ $url }}" >
                                                <div class="ajax-page-load-indicator">
                                                    <div class="text-center d-flex justify-content-center load-indicator">
                                                        <span class="loader mr-3"></span>
                                                        <span class="fw-bold">{{ __('loading') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
