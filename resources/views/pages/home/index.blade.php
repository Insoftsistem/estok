<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php 
    $pageTitle = __('home'); // set dynamic page title
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
                        <hr>
                        Home
                        <hr>
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">
                            <span style="font-size:14px;">
                            👋 Olá, <strong>{{ auth()->user()->username }}</strong>
                            </span>
                        </div>
                        <hr>
                        <button id="btnMovimentosPeriodo" class="btn btn-primary">
                        Imprimir Movimentações de Estoque
                        </button>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            $('#btnMovimentosPeriodo').on('click', function () {
                            Swal.fire({
                            title: 'Movimentações de Estoque',
                            html: `
                            <label>Data inicial</label>
                            <input type="date" id="dataInicio" class="swal2-input">
                            <label>Data final</label>
                            <input type="date" id="dataFim" class="swal2-input">
                            `,
                            confirmButtonText: 'Gerar PDF',
                            showCancelButton: true,
                            preConfirm: () => {
                            const inicio = document.getElementById('dataInicio').value;
                            const fim = document.getElementById('dataFim').value;
                            if (!inicio || !fim) {
                            Swal.showValidationMessage('Informe as duas datas');
                            }
                            return { inicio, fim };
                            }
                            }).then((result) => {
                            if (result.isConfirmed) {
                            const url =
                        "<?= url('pdf/estoque-movimentos-periodo') ?>" +
                        "?inicio=" + result.value.inicio +
                        "&fim=" + result.value.fim;
                        window.open(url, '_blank');
                        }
                        });
                        });
                    </script>
                </div>
            </div>
            <div class="col-md-4 comp-grid " >
            </div>
            <div class="col-md-4 comp-grid " >
            </div>
        </div>
    </div>
</div>
<div  class="mb-3" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-4 comp-grid " >
                <!--Include chart component-->
                @include("pages.home-lojas-atuais")
            </div>
            <div class="col-md-4 comp-grid " >
                <!--Include chart component-->
                @include("pages.home-produtos-das-lojas")
            </div>
            <div class="col-md-4 comp-grid " >
                <?php $rec_count = $comp_model->getcount_produtos();  ?>
                <a class="animated zoomIn record-count alert alert-success"  href='<?php print_link("produtos") ?>' >
                <div class="row gutter-sm align-items-center">
                    <div class="col-auto" style="opacity: 1;">
                        <i class="material-icons">extension</i>
                    </div>
                    <div class="col">
                        <div class="flex-column justify-content align-center">
                            <div class="title">Produtos</div>
                            <small class="">Total Produtos</small>
                        </div>
                        <h2 class="value"><?php echo $rec_count; ?></h2>
                    </div>
                </div>
                <div class="progress mt-2">
                    <?php 
                        $perc = ($rec_count / 100) * 100 ;
                    ?>
                    <div class="progress-bar bg-primary text-white" role="progressbar" aria-valuenow="<?php echo $rec_count; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $perc ?>%">
                    <span class="progress-label"><?php echo round($perc,2); ?>%</span>
                </div>
            </div>
        </a>
        <?php $rec_count = $comp_model->getcount_estoquemovimentos();  ?>
        <a class="animated zoomIn record-count alert alert-danger"  href='<?php print_link("estoquemovimentos") ?>' >
        <div class="row gutter-sm align-items-center">
            <div class="col-auto" style="opacity: 1;">
                <i class="material-icons">extension</i>
            </div>
            <div class="col">
                <div class="flex-column justify-content align-center">
                    <div class="title">Estoque Movimentos</div>
                    <small class="">Total Estoque Movimentos</small>
                </div>
                <h2 class="value"><?php echo $rec_count; ?></h2>
            </div>
        </div>
        <div class="progress mt-2">
            <?php 
                $perc = ($rec_count / 100) * 100 ;
            ?>
            <div class="progress-bar bg-primary text-white" role="progressbar" aria-valuenow="<?php echo $rec_count; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $perc ?>%">
            <span class="progress-label"><?php echo round($perc,2); ?>%</span>
        </div>
    </div>
</a>
<?php $rec_count = $comp_model->getcount_estoqueentradas();  ?>
<a class="animated zoomIn record-count alert alert-info"  href='<?php print_link("estoqueentradas") ?>' >
<div class="row gutter-sm align-items-center">
    <div class="col-auto" style="opacity: 1;">
        <i class="material-icons">extension</i>
    </div>
    <div class="col">
        <div class="flex-column justify-content align-center">
            <div class="title">Estoque Entradas</div>
            <small class="">Total Estoque Entradas</small>
        </div>
        <h2 class="value"><?php echo $rec_count; ?></h2>
    </div>
</div>
<div class="progress mt-2">
    <?php 
        $perc = ($rec_count / 100) * 100 ;
    ?>
    <div class="progress-bar bg-primary text-white" role="progressbar" aria-valuenow="<?php echo $rec_count; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $perc ?>%">
    <span class="progress-label"><?php echo round($perc,2); ?>%</span>
</div>
</div>
</a>
<?php $rec_count = $comp_model->getcount_estoquesaidas();  ?>
<a class="animated zoomIn record-count alert alert-warning"  href='<?php print_link("estoquesaidas") ?>' >
<div class="row gutter-sm align-items-center">
    <div class="col-auto" style="opacity: 1;">
        <i class="material-icons">extension</i>
    </div>
    <div class="col">
        <div class="flex-column justify-content align-center">
            <div class="title">Estoque Saidas</div>
            <small class="">Total Estoque Saidas</small>
        </div>
        <h2 class="value"><?php echo $rec_count; ?></h2>
    </div>
</div>
<div class="progress mt-2">
    <?php 
        $perc = ($rec_count / 100) * 100 ;
    ?>
    <div class="progress-bar bg-primary text-white" role="progressbar" aria-valuenow="<?php echo $rec_count; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $perc ?>%">
    <span class="progress-label"><?php echo round($perc,2); ?>%</span>
</div>
</div>
</a>
</div>
</div>
</div>
</div>
<div  class="mb-3" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-4 comp-grid " >
                <!--Include chart component-->
                @include("pages.home-movimentos-de-produtos")
            </div>
            <div class="col-md-4 comp-grid " >
                <!--Include chart component-->
                @include("pages.home-entrada-de-produtos")
            </div>
            <div class="col-md-4 comp-grid " >
                <!--Include chart component-->
                @include("pages.home-sa-da-produtos")
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
