<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



	Route::get('', 'IndexController@index')->name('index')->middleware(['redirect.to.home']);
	Route::get('index/login', 'IndexController@login')->name('login');
	
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::any('auth/logout', 'AuthController@logout')->name('logout')->middleware(['auth']);

	Route::get('auth/accountcreated', 'AuthController@accountcreated')->name('accountcreated');
	Route::get('auth/accountpending', 'AuthController@accountpending')->name('accountpending');
	Route::get('auth/accountblocked', 'AuthController@accountblocked')->name('accountblocked');
	Route::get('auth/accountinactive', 'AuthController@accountinactive')->name('accountinactive');


	
	Route::get('index/register', 'AuthController@register')->name('auth.register')->middleware(['redirect.to.home']);
	Route::post('index/register', 'AuthController@register_store')->name('auth.register_store');
		
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::get('auth/password/forgotpassword', 'AuthController@showForgotPassword')->name('password.forgotpassword');
	Route::post('auth/password/sendemail', 'AuthController@sendPasswordResetLink')->name('password.email');
	Route::get('auth/password/reset', 'AuthController@showResetPassword')->name('password.reset.token');
	Route::post('auth/password/resetpassword', 'AuthController@resetPassword')->name('password.resetpassword');
	Route::get('auth/password/resetcompleted', 'AuthController@passwordResetCompleted')->name('password.resetcompleted');
	Route::get('auth/password/linksent', 'AuthController@passwordResetLinkSent')->name('password.resetlinksent');
	

/**
 * All routes which requires auth
 */
Route::middleware(['auth', 'rbac'])->group(function () {
		
	Route::get('home', 'HomeController@index')->name('home');

	

/* routes for Caixa Controller */
	Route::get('caixa', 'CaixaController@index')->name('caixa.index');
	Route::get('caixa/index/{filter?}/{filtervalue?}', 'CaixaController@index')->name('caixa.index');	
	Route::post('caixa/importdata', 'CaixaController@importdata');	
	Route::get('caixa/view/{rec_id}', 'CaixaController@view')->name('caixa.view');	
	Route::get('caixa/add', 'CaixaController@add')->name('caixa.add');
	Route::post('caixa/add', 'CaixaController@store')->name('caixa.store');
		
	Route::any('caixa/edit/{rec_id}', 'CaixaController@edit')->name('caixa.edit');Route::any('caixa/editfield/{rec_id}', 'CaixaController@editfield');	
	Route::get('caixa/delete/{rec_id}', 'CaixaController@delete');	
	Route::get('caixa/caixa_view', 'CaixaController@caixa_view');
	Route::get('caixa/caixa_view/{filter?}/{filtervalue?}', 'CaixaController@caixa_view');

/* routes for ConfigSite Controller */
	Route::get('configsite', 'ConfigSiteController@index')->name('configsite.index');
	Route::get('configsite/index/{filter?}/{filtervalue?}', 'ConfigSiteController@index')->name('configsite.index');	
	Route::post('configsite/importdata', 'ConfigSiteController@importdata');	
	Route::get('configsite/view/{rec_id}', 'ConfigSiteController@view')->name('configsite.view');	
	Route::get('configsite/add', 'ConfigSiteController@add')->name('configsite.add');
	Route::post('configsite/add', 'ConfigSiteController@store')->name('configsite.store');
		
	Route::any('configsite/edit/{rec_id}', 'ConfigSiteController@edit')->name('configsite.edit');Route::any('configsite/editfield/{rec_id}', 'ConfigSiteController@editfield');	
	Route::get('configsite/delete/{rec_id}', 'ConfigSiteController@delete');

/* routes for EstoqueEntradas Controller */
	Route::get('estoqueentradas', 'EstoqueEntradasController@index')->name('estoqueentradas.index');
	Route::get('estoqueentradas/index/{filter?}/{filtervalue?}', 'EstoqueEntradasController@index')->name('estoqueentradas.index');	
	Route::post('estoqueentradas/importdata', 'EstoqueEntradasController@importdata');	
	Route::get('estoqueentradas/view/{rec_id}', 'EstoqueEntradasController@view')->name('estoqueentradas.view');	
	Route::get('estoqueentradas/add', 'EstoqueEntradasController@add')->name('estoqueentradas.add');
	Route::post('estoqueentradas/add', 'EstoqueEntradasController@store')->name('estoqueentradas.store');
		
	Route::any('estoqueentradas/edit/{rec_id}', 'EstoqueEntradasController@edit')->name('estoqueentradas.edit');Route::any('estoqueentradas/editfield/{rec_id}', 'EstoqueEntradasController@editfield');	
	Route::get('estoqueentradas/delete/{rec_id}', 'EstoqueEntradasController@delete');	
	Route::get('estoqueentradas/entrada_view_list', 'EstoqueEntradasController@entrada_view_list');
	Route::get('estoqueentradas/entrada_view_list/{filter?}/{filtervalue?}', 'EstoqueEntradasController@entrada_view_list');

/* routes for EstoqueMovimentos Controller */
	Route::get('estoquemovimentos', 'EstoqueMovimentosController@index')->name('estoquemovimentos.index');
	Route::get('estoquemovimentos/index/{filter?}/{filtervalue?}', 'EstoqueMovimentosController@index')->name('estoquemovimentos.index');	
	Route::post('estoquemovimentos/importdata', 'EstoqueMovimentosController@importdata');	
	Route::get('estoquemovimentos/view/{rec_id}', 'EstoqueMovimentosController@view')->name('estoquemovimentos.view');	
	Route::get('estoquemovimentos/add', 'EstoqueMovimentosController@add')->name('estoquemovimentos.add');
	Route::post('estoquemovimentos/add', 'EstoqueMovimentosController@store')->name('estoquemovimentos.store');
		
	Route::any('estoquemovimentos/edit/{rec_id}', 'EstoqueMovimentosController@edit')->name('estoquemovimentos.edit');Route::any('estoquemovimentos/editfield/{rec_id}', 'EstoqueMovimentosController@editfield');	
	Route::get('estoquemovimentos/delete/{rec_id}', 'EstoqueMovimentosController@delete');	
	Route::get('estoquemovimentos/estoque_view', 'EstoqueMovimentosController@estoque_view');
	Route::get('estoquemovimentos/estoque_view/{filter?}/{filtervalue?}', 'EstoqueMovimentosController@estoque_view');

/* routes for EstoqueSaidas Controller */
	Route::get('estoquesaidas', 'EstoqueSaidasController@index')->name('estoquesaidas.index');
	Route::get('estoquesaidas/index/{filter?}/{filtervalue?}', 'EstoqueSaidasController@index')->name('estoquesaidas.index');	
	Route::post('estoquesaidas/importdata', 'EstoqueSaidasController@importdata');	
	Route::get('estoquesaidas/view/{rec_id}', 'EstoqueSaidasController@view')->name('estoquesaidas.view');	
	Route::get('estoquesaidas/add', 'EstoqueSaidasController@add')->name('estoquesaidas.add');
	Route::post('estoquesaidas/add', 'EstoqueSaidasController@store')->name('estoquesaidas.store');
		
	Route::any('estoquesaidas/edit/{rec_id}', 'EstoqueSaidasController@edit')->name('estoquesaidas.edit');Route::any('estoquesaidas/editfield/{rec_id}', 'EstoqueSaidasController@editfield');	
	Route::get('estoquesaidas/delete/{rec_id}', 'EstoqueSaidasController@delete');	
	Route::get('estoquesaidas/saida_view', 'EstoqueSaidasController@saida_view');
	Route::get('estoquesaidas/saida_view/{filter?}/{filtervalue?}', 'EstoqueSaidasController@saida_view');

/* routes for Info Controller */
	Route::get('info', 'InfoController@index')->name('info.index');
	Route::get('info/index/{filter?}/{filtervalue?}', 'InfoController@index')->name('info.index');	
	Route::get('info/view/{rec_id}', 'InfoController@view')->name('info.view');	
	Route::get('info/add', 'InfoController@add')->name('info.add');
	Route::post('info/add', 'InfoController@store')->name('info.store');
		
	Route::any('info/edit/{rec_id}', 'InfoController@edit')->name('info.edit');	
	Route::get('info/delete/{rec_id}', 'InfoController@delete');

/* routes for Lojas Controller */
	Route::get('lojas', 'LojasController@index')->name('lojas.index');
	Route::get('lojas/index/{filter?}/{filtervalue?}', 'LojasController@index')->name('lojas.index');	
	Route::post('lojas/importdata', 'LojasController@importdata');	
	Route::get('lojas/view/{rec_id}', 'LojasController@view')->name('lojas.view');
	Route::get('lojas/masterdetail/{rec_id}', 'LojasController@masterDetail')->name('lojas.masterdetail');	
	Route::get('lojas/add', 'LojasController@add')->name('lojas.add');
	Route::post('lojas/add', 'LojasController@store')->name('lojas.store');
		
	Route::any('lojas/edit/{rec_id}', 'LojasController@edit')->name('lojas.edit');Route::any('lojas/editfield/{rec_id}', 'LojasController@editfield');	
	Route::get('lojas/delete/{rec_id}', 'LojasController@delete');	
	Route::get('lojas/lojas_view_list', 'LojasController@lojas_view_list');
	Route::get('lojas/lojas_view_list/{filter?}/{filtervalue?}', 'LojasController@lojas_view_list');

/* routes for MovimentacaoFinanceira Controller */
	Route::get('movimentacaofinanceira', 'MovimentacaoFinanceiraController@index')->name('movimentacaofinanceira.index');
	Route::get('movimentacaofinanceira/index/{filter?}/{filtervalue?}', 'MovimentacaoFinanceiraController@index')->name('movimentacaofinanceira.index');	
	Route::post('movimentacaofinanceira/importdata', 'MovimentacaoFinanceiraController@importdata');	
	Route::get('movimentacaofinanceira/view/{rec_id}', 'MovimentacaoFinanceiraController@view')->name('movimentacaofinanceira.view');
	Route::get('movimentacaofinanceira/masterdetail/{rec_id}', 'MovimentacaoFinanceiraController@masterDetail')->name('movimentacaofinanceira.masterdetail');	
	Route::get('movimentacaofinanceira/add', 'MovimentacaoFinanceiraController@add')->name('movimentacaofinanceira.add');
	Route::post('movimentacaofinanceira/add', 'MovimentacaoFinanceiraController@store')->name('movimentacaofinanceira.store');
		
	Route::any('movimentacaofinanceira/edit/{rec_id}', 'MovimentacaoFinanceiraController@edit')->name('movimentacaofinanceira.edit');Route::any('movimentacaofinanceira/editfield/{rec_id}', 'MovimentacaoFinanceiraController@editfield');	
	Route::get('movimentacaofinanceira/delete/{rec_id}', 'MovimentacaoFinanceiraController@delete');	
	Route::get('movimentacaofinanceira/financa_view', 'MovimentacaoFinanceiraController@financa_view');
	Route::get('movimentacaofinanceira/financa_view/{filter?}/{filtervalue?}', 'MovimentacaoFinanceiraController@financa_view');

/* routes for Permissions Controller */
	Route::get('permissions', 'PermissionsController@index')->name('permissions.index');
	Route::get('permissions/index/{filter?}/{filtervalue?}', 'PermissionsController@index')->name('permissions.index');	
	Route::get('permissions/view/{rec_id}', 'PermissionsController@view')->name('permissions.view');	
	Route::get('permissions/add', 'PermissionsController@add')->name('permissions.add');
	Route::post('permissions/add', 'PermissionsController@store')->name('permissions.store');
		
	Route::any('permissions/edit/{rec_id}', 'PermissionsController@edit')->name('permissions.edit');Route::any('permissions/editfield/{rec_id}', 'PermissionsController@editfield');	
	Route::get('permissions/delete/{rec_id}', 'PermissionsController@delete');

/* routes for Produtos Controller */
	Route::get('produtos', 'ProdutosController@index')->name('produtos.index');
	Route::get('produtos/index/{filter?}/{filtervalue?}', 'ProdutosController@index')->name('produtos.index');	
	Route::post('produtos/importdata', 'ProdutosController@importdata');	
	Route::get('produtos/view/{rec_id}', 'ProdutosController@view')->name('produtos.view');
	Route::get('produtos/masterdetail/{rec_id}', 'ProdutosController@masterDetail')->name('produtos.masterdetail');	
	Route::get('produtos/add', 'ProdutosController@add')->name('produtos.add');
	Route::post('produtos/add', 'ProdutosController@store')->name('produtos.store');
		
	Route::any('produtos/edit/{rec_id}', 'ProdutosController@edit')->name('produtos.edit');Route::any('produtos/editfield/{rec_id}', 'ProdutosController@editfield');	
	Route::get('produtos/delete/{rec_id}', 'ProdutosController@delete');	
	Route::get('produtos/produtos_view', 'ProdutosController@produtos_view');
	Route::get('produtos/produtos_view/{filter?}/{filtervalue?}', 'ProdutosController@produtos_view');

/* routes for Roles Controller */
	Route::get('roles', 'RolesController@index')->name('roles.index');
	Route::get('roles/index/{filter?}/{filtervalue?}', 'RolesController@index')->name('roles.index');	
	Route::get('roles/view/{rec_id}', 'RolesController@view')->name('roles.view');
	Route::get('roles/masterdetail/{rec_id}', 'RolesController@masterDetail')->name('roles.masterdetail');	
	Route::get('roles/add', 'RolesController@add')->name('roles.add');
	Route::post('roles/add', 'RolesController@store')->name('roles.store');
		
	Route::any('roles/edit/{rec_id}', 'RolesController@edit')->name('roles.edit');Route::any('roles/editfield/{rec_id}', 'RolesController@editfield');	
	Route::get('roles/delete/{rec_id}', 'RolesController@delete');

/* routes for Users Controller */
	Route::get('users', 'UsersController@index')->name('users.index');
	Route::get('users/index/{filter?}/{filtervalue?}', 'UsersController@index')->name('users.index');	
	Route::get('users/view/{rec_id}', 'UsersController@view')->name('users.view');
	Route::get('users/masterdetail/{rec_id}', 'UsersController@masterDetail')->name('users.masterdetail');	
	Route::any('account/edit', 'AccountController@edit')->name('account.edit');	
	Route::get('account', 'AccountController@index');	
	Route::post('account/changepassword', 'AccountController@changepassword')->name('account.changepassword');	
	Route::get('users/add', 'UsersController@add')->name('users.add');
	Route::post('users/add', 'UsersController@store')->name('users.store');
		
	Route::any('users/edit/{rec_id}', 'UsersController@edit')->name('users.edit');	
	Route::get('users/delete/{rec_id}', 'UsersController@delete');	
	Route::get('users/users_view', 'UsersController@users_view');
	Route::get('users/users_view/{filter?}/{filtervalue?}', 'UsersController@users_view');

/* routes for Vendas Controller */
	Route::get('vendas', 'VendasController@index')->name('vendas.index');
	Route::get('vendas/index/{filter?}/{filtervalue?}', 'VendasController@index')->name('vendas.index');	
	Route::get('vendas/view/{rec_id}', 'VendasController@view')->name('vendas.view');
	Route::get('vendas/masterdetail/{rec_id}', 'VendasController@masterDetail')->name('vendas.masterdetail');	
	Route::get('vendas/add', 'VendasController@add')->name('vendas.add');
	Route::post('vendas/add', 'VendasController@store')->name('vendas.store');
		
	Route::any('vendas/edit/{rec_id}', 'VendasController@edit')->name('vendas.edit');	
	Route::get('vendas/delete/{rec_id}', 'VendasController@delete');	
	Route::get('vendas/vendas_view', 'VendasController@vendas_view');
	Route::get('vendas/vendas_view/{filter?}/{filtervalue?}', 'VendasController@vendas_view');

/* routes for VendasItens Controller */
	Route::get('vendasitens', 'VendasItensController@index')->name('vendasitens.index');
	Route::get('vendasitens/index/{filter?}/{filtervalue?}', 'VendasItensController@index')->name('vendasitens.index');	
	Route::get('vendasitens/view/{rec_id}', 'VendasItensController@view')->name('vendasitens.view');	
	Route::get('vendasitens/add', 'VendasItensController@add')->name('vendasitens.add');
	Route::post('vendasitens/add', 'VendasItensController@store')->name('vendasitens.store');
		
	Route::any('vendasitens/edit/{rec_id}', 'VendasItensController@edit')->name('vendasitens.edit');Route::any('vendasitens/editfield/{rec_id}', 'VendasItensController@editfield');	
	Route::get('vendasitens/delete/{rec_id}', 'VendasItensController@delete');	
Route::get('caixa_ativo',  function(Request $request){
		return view("pages.custom.caixa_ativo");
	}
);
	
Route::get('resumo',  function(Request $request){
		return view("pages.custom.resumo");
	}
);

});


	
Route::get('componentsdata/valor_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->valor_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/movimentacao_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->movimentacao_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/produto_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->produto_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/loja_origem_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->loja_origem_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/estoquemovimentos_produto_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->estoquemovimentos_produto_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/usuario_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->usuario_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/estoquemovimentos_loja_origem_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->estoquemovimentos_loja_origem_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/role_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->role_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/users_username_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->users_username_value_exist($request);
	}
);
	
Route::get('componentsdata/users_email_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->users_email_value_exist($request);
	}
);
	
Route::get('componentsdata/vendasitens_produto_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->vendasitens_produto_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/linechart_lojasatuais',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->linechart_lojasatuais($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/barchart_produtosdaslojas',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->barchart_produtosdaslojas($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_produtos',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_produtos($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_estoquemovimentos',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_estoquemovimentos($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_estoqueentradas',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_estoqueentradas($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_estoquesaidas',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_estoquesaidas($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/barchart_movimentosdeprodutos',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->barchart_movimentosdeprodutos($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/piechart_entradadeprodutos',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->piechart_entradadeprodutos($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/linechart_sadaprodutos',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->linechart_sadaprodutos($request);
	}
)->middleware(['auth']);


Route::post('fileuploader/upload/{fieldname}', 'FileUploaderController@upload');
Route::post('fileuploader/s3upload/{fieldname}', 'FileUploaderController@s3upload');
Route::post('fileuploader/remove_temp_file', 'FileUploaderController@remove_temp_file');


/**
 * All static content routes
 */
Route::get('info/about',  function(){
		return view("pages.info.about");
	}
);
Route::get('info/faq',  function(){
		return view("pages.info.faq");
	}
);

Route::get('info/contact',  function(){
	return view("pages.info.contact");
}
);
Route::get('info/contactsent',  function(){
	return view("pages.info.contactsent");
}
);

Route::post('info/contact',  function(Request $request){
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required'
		]);

		$senderName = $request->name;
		$senderEmail = $request->email;
		$message = $request->message;

		$receiverEmail = config("mail.from.address");

		Mail::send(
			'pages.info.contactemail', [
				'name' => $senderName,
				'email' => $senderEmail,
				'comment' => $message
			],
			function ($mail) use ($senderEmail, $receiverEmail) {
				$mail->from($senderEmail);
				$mail->to($receiverEmail)
					->subject('Contact Form');
			}
		);
		return redirect("info/contactsent");
	}
);


Route::get('info/features',  function(){
		return view("pages.info.features");
	}
);
Route::get('info/privacypolicy',  function(){
		return view("pages.info.privacypolicy");
	}
);
Route::get('info/termsandconditions',  function(){
		return view("pages.info.termsandconditions");
	}
);

Route::get('info/changelocale/{locale}', function ($locale) {
	app()->setlocale($locale);
	session()->put('locale', $locale);
    return redirect()->back();
})->name('info.changelocale');