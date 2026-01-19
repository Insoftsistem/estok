
<?php
	class Menu{
		
	public static function navbarsideleft(){
		return [
		[
			'path' => 'home',
			'label' => __('home'), 
			'icon' => '<i class="material-icons ">local_convenience_store</i>'
		],
		
		[
			'path' => 'users',
			'label' => __('users'), 
			'icon' => '<i class="material-icons ">account_circle</i>'
		],
		
		[
			'path' => 'produtos',
			'label' => __('produtos'), 
			'icon' => '<i class="material-icons ">add_shopping_cart</i>'
		],
		
		[
			'path' => 'lojas',
			'label' => __('lojas'), 
			'icon' => '<i class="material-icons ">store_mall_directory</i>'
		],
		
		[
			'path' => 'estoquemovimentos',
			'label' => __('estoqueMovimentos'), 
			'icon' => '<i class="material-icons ">swap_vert</i>'
		],
		
		[
			'path' => 'estoqueentradas',
			'label' => __('estoqueEntradas'), 
			'icon' => '<i class="material-icons ">add_shopping_cart</i>'
		],
		
		[
			'path' => 'estoquesaidas',
			'label' => __('estoqueSaidas'), 
			'icon' => '<i class="material-icons ">remove_shopping_cart</i>'
		],
		
		[
			'path' => 'configsite',
			'label' => __('configSite'), 
			'icon' => '<i class="material-icons ">rotate_90_degrees_ccw</i>'
		],
		
		[
			'path' => 'roles',
			'label' => __('roles'), 
			'icon' => '<i class="material-icons ">memory</i>'
		],
		
		[
			'path' => 'permissions',
			'label' => __('permissions'), 
			'icon' => '<i class="material-icons ">remove_shopping_cart</i>'
		],
		
		[
			'path' => 'movimentacaofinanceira',
			'label' => __('financeira'), 
			'icon' => '<i class="material-icons ">attach_money</i>'
		],
		
		[
			'path' => 'caixa',
			'label' => __('caixa'), 
			'icon' => '<i class="material-icons ">monetization_on</i>'
		],
		
		[
			'path' => 'vendas',
			'label' => __('vendas'), 
			'icon' => '<i class="material-icons ">assessment</i>'
		],
		
		[
			'path' => 'vendasitens',
			'label' => __('vendasItens'), 
			'icon' => '<i class="material-icons ">add_shopping_cart</i>'
		]
	] ;
	}
	
	public static function navbartopleft(){
		return [
		[
			'path' => 'configsite',
			'label' => __('configSite'), 
			'icon' => '<i class="material-icons ">rotate_90_degrees_ccw</i>'
		],
		
		[
			'path' => 'roles',
			'label' => __('roles'), 
			'icon' => '<i class="material-icons ">memory</i>'
		],
		
		[
			'path' => 'permissions',
			'label' => __('permissions'), 
			'icon' => '<i class="material-icons ">remove_shopping_cart</i>'
		],
		
		[
			'path' => 'caixa_ativo',
			'label' => __('caixaAberto'), 
			'icon' => '<i class="material-icons ">attach_money</i>'
		]
	] ;
	}
	
	public static function navbartopright(){
		return [
		[
			'path' => 'resumo',
			'label' => __('resumo'), 
			'icon' => '<i class="material-icons ">art_track</i>'
		],
		
		[
			'path' => 'info',
			'label' => __('info'), 
			'icon' => '<i class="material-icons ">edit_location</i>'
		]
	] ;
	}
	
		
	public static function tipo(){
		return [
		[
			'value' => 'entrada', 
			'label' => __('entrada'), 
		],
		[
			'value' => 'saida', 
			'label' => __('saida'), 
		],] ;
	}
	
	public static function recebido(){
		return [
		[
			'value' => '1', 
			'label' => __('sim'), 
		],] ;
	}
	
	public static function tipoMovimentacao(){
		return [
		[
			'value' => 'compra', 
			'label' => __('compra'), 
		],
		[
			'value' => 'venda', 
			'label' => __('venda'), 
		],] ;
	}
	
	public static function roles(){
		return [
		[
			'value' => 'admin', 
			'label' => __('admin'), 
		],
		[
			'value' => 'estoquista', 
			'label' => __('estoquista'), 
		],
		[
			'value' => 'usuario', 
			'label' => __('usuario'), 
		],] ;
	}
	
	public static function formaPagamento(){
		return [
		[
			'value' => 'dinheiro', 
			'label' => __('dinheiro'), 
		],
		[
			'value' => 'cartao', 
			'label' => __('cartao'), 
		],
		[
			'value' => 'pix', 
			'label' => __('pix'), 
		],
		[
			'value' => 'boleto', 
			'label' => __('boleto'), 
		],] ;
	}
	
	}
