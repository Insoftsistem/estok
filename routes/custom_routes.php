<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CriarIndexController;
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
Route::get('/', [CriarIndexController::class, 'index'])->name('index');

Route::get('/produto/preco/{id}', function ($id) { $produto = DB::table('produtos')->where('id', $id)->first(); if (!$produto) {  return response()->json(['preco' => 0], 404); } return response()->json([ 'preco' => $produto->preco]);});