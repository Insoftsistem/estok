<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php 
    $pageTitle = __('caixaAtivo'); // set dynamic page title
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
                        {{ __('caixa') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col comp-grid " >
                    <div class=" "><div class="alerta-passo">
                        Click em ATUALIZAR VALORES e depois EM TOTAL
                        para então -> FINALIZAR   
                    </div>
                    <style>
                    .alerta-passo {
                    background-color: #d4edda;      /* Verde claro */
                    color: #155724;                 /* Verde escuro para texto */
                    padding: 12px 16px;
                    border: 1px solid #c3e6cb;
                    border-radius: 4px;
                    font-family: Arial, sans-serif;
                    margin-bottom: 15px;
                    font-size: 14px;
                    }
                    </style>
                </div>
            </div>
        </div>
    </div>
</div>
<div  class="mb-3" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col comp-grid " >
                <div class=" reset-grids">
                    <?php
                        $params = []; //new query param
                        $query = array_merge(request()->query(), $params);
                        $queryParams = http_build_query($query);
                        $url = url("vendas/add?$queryParams");
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
                <div class=" "><div>
                    <!-- Div centralizada com os dois botões lado a lado -->
                    <!-- Botão Atualizar Totais -->
                    <div class="row my-3">
                        <div class="col text-center">
                            <button type="button" id="btnAtualizar" class="btn btn-warning">
                            <i class="fas fa-calculator"></i> TOTAL
                            </button>
                        </div>
                    </div>
                    <!-- ---Atualizar Valores -- Div centralizada com os dois botões lado a lado -->
                    <script>
                        $(document).ready(function(){
                        function calcularTotalGeral() {
                        let total = 0;
                        $('[id^="ctrl-subtotal-row"]').each(function(){
                        total += parseFloat($(this).val()) || 0;
                        });
                        $('#ctrl-valor_total').val(total.toFixed(2));
                        }
                        function atualizarLinha(rowIndex, produtoId) {
                        return new Promise((resolve) => {
                        if (!produtoId) {
                        resolve();
                        return;
                        }
                        let qtdInput = $(`#ctrl-quantidade-row${rowIndex}`);
                        let valorInput = $(`#ctrl-valor_unitario-row${rowIndex}`);
                        let subtotalInput = $(`#ctrl-subtotal-row${rowIndex}`);
                        $.getJSON(`{{ url('/produto/preco') }}/${produtoId}`)
                        .done(function(data){
                        let preco = parseFloat(data.preco) || 0;
                        let qtd   = parseFloat(qtdInput.val()) || 0;
                        valorInput.val(preco.toFixed(2));
                        subtotalInput.val((preco * qtd).toFixed(2));
                        })
                        .fail(function(){
                        alert('Erro ao buscar preço do produto');
                        })
                        .always(function(){
                        resolve();
                        });
                        });
                        }
                        function atualizarTodasLinhas() {
                        let promises = [];
                        $('.selectize-ajax').each(function(){
                        let rowIndex = $(this).closest('tr').data('row');
                        let produtoId = this.selectize
                        ? this.selectize.getValue()
                        : $(this).val();
                        promises.push(atualizarLinha(rowIndex, produtoId));
                        });
                        Promise.all(promises).then(() => {
                        calcularTotalGeral();
                        });
                        }
                        // BOTÕES
                        $('#btnAtualizar').on('click', atualizarTodasLinhas);
                        $('#btnAtualizarTotais').on('click', atualizarTodasLinhas);
                        // ATUALIZA AUTOMATICAMENTE AO MUDAR QUANTIDADE
                        $(document).on('input', '[id^="ctrl-quantidade-row"]', function(){
                        let rowIndex = $(this).closest('tr').data('row');
                        let select   = $(`#ctrl-produto_id-row${rowIndex}`);
                        let produtoId = select[0].selectize
                        ? select[0].selectize.getValue()
                        : select.val();
                        atualizarLinha(rowIndex, produtoId).then(calcularTotalGeral);
                        });
                        // 🔥 ATUALIZA AUTOMATICAMENTE AO SELECIONAR O PRODUTO
                        $(document).on('change', '[id^="ctrl-produto_id-row"]', function(){
                        let rowIndex = $(this).closest('tr').data('row');
                        let produtoId = this.selectize
                        ? this.selectize.getValue()
                        : $(this).val();
                        atualizarLinha(rowIndex, produtoId).then(calcularTotalGeral);
                        });
                        });
                    </script>
                    <!-- Botão Atualizar Totais FIM -->
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
