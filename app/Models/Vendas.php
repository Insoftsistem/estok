<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Vendas extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'vendas';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'usuario_id','loja_id','cliente_nome','valor_total','forma_pagamento'
	];
	public $timestamps = false;
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				id LIKE ?  OR 
				cliente_nome LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"id",
			"usuario_id",
			"loja_id",
			"cliente_nome",
			"valor_total",
			"forma_pagamento",
			"data_venda" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"id",
			"usuario_id",
			"loja_id",
			"cliente_nome",
			"valor_total",
			"forma_pagamento",
			"data_venda" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id",
			"usuario_id",
			"loja_id",
			"cliente_nome",
			"valor_total",
			"forma_pagamento",
			"data_venda" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id",
			"usuario_id",
			"loja_id",
			"cliente_nome",
			"valor_total",
			"forma_pagamento",
			"data_venda" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"usuario_id",
			"loja_id",
			"cliente_nome",
			"valor_total",
			"forma_pagamento",
			"id" 
		];
	}
	

	/**
     * return vendasView page fields of the model.
     * 
     * @return array
     */
	public static function vendasViewFields(){
		return [ 
			"id",
			"usuario_id",
			"loja_id",
			"cliente_nome",
			"valor_total",
			"forma_pagamento",
			"data_venda" 
		];
	}
	

	/**
     * return exportVendasView page fields of the model.
     * 
     * @return array
     */
	public static function exportVendasViewFields(){
		return [ 
			"id",
			"usuario_id",
			"loja_id",
			"cliente_nome",
			"valor_total",
			"forma_pagamento",
			"data_venda" 
		];
	}
}
