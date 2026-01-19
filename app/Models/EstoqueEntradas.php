<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class EstoqueEntradas extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'estoque_entradas';
	

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
		'produto_id','quantidade','valor_unitario','recebido','usuario_id','loja_origem_id','loja_destino_id'
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
				id LIKE ? 
		)';
		$search_params = [
			"%$text%"
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
			"produto_id",
			"quantidade",
			"valor_unitario",
			"data_entrada",
			"recebido",
			"usuario_id",
			"loja_origem_id",
			"loja_destino_id" 
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
			"produto_id",
			"quantidade",
			"valor_unitario",
			"data_entrada",
			"recebido",
			"usuario_id",
			"loja_origem_id",
			"loja_destino_id" 
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
			"produto_id",
			"quantidade",
			"valor_unitario",
			"data_entrada",
			"recebido",
			"usuario_id",
			"loja_origem_id",
			"loja_destino_id" 
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
			"produto_id",
			"quantidade",
			"valor_unitario",
			"data_entrada",
			"recebido",
			"usuario_id",
			"loja_origem_id",
			"loja_destino_id" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"produto_id",
			"quantidade",
			"valor_unitario",
			"recebido",
			"usuario_id",
			"loja_origem_id",
			"loja_destino_id",
			"id" 
		];
	}
	

	/**
     * return entradaViewList page fields of the model.
     * 
     * @return array
     */
	public static function entradaViewListFields(){
		return [ 
			"id",
			"produto_id",
			"quantidade",
			"valor_unitario",
			"data_entrada",
			"recebido",
			"usuario_id",
			"loja_origem_id",
			"loja_destino_id" 
		];
	}
	

	/**
     * return exportEntradaViewList page fields of the model.
     * 
     * @return array
     */
	public static function exportEntradaViewListFields(){
		return [ 
			"id",
			"produto_id",
			"quantidade",
			"valor_unitario",
			"data_entrada",
			"recebido",
			"usuario_id",
			"loja_origem_id",
			"loja_destino_id" 
		];
	}
}
