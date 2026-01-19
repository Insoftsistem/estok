<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProdutoController;

/*
|--------------------------------------------------------------------------
| ROTAS DE PDF (ESTÁTICAS / NÃO RENDERIZÁVEIS)
|--------------------------------------------------------------------------
*/

Route::get('pdf/nota-venda/{id}', 'CriarTodosPdfsController@notaVenda');
Route::get('pdf/movimentacao-financeira/{id}', 'CriarTodosPdfsController@movimentacaoFinanceira');
Route::get('pdf/entrada-estoque/{id}', 'CriarTodosPdfsController@entradaEstoque');
Route::get('pdf/saida-estoque/{id}', 'CriarTodosPdfsController@saidaEstoque');
Route::get(  'pdf/estoque-movimentos-periodo',  'CriarTodosPdfsController@estoqueMovimentosPeriodo')->name('pdf.estoque_movimentos_periodo');
//Atualizar valor
Route::get('/produto/preco/{id}', [ProdutoController::class, 'preco']) ->name('produto.preco');
