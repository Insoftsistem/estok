<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class MovimentacaoFinanceira extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'movimentacao_financeira';
	

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
		'produto_id','tipo_movimentacao','quantidade','valor_unitario','valor_total','usuario_id','loja_origem_id','loja_destino_id','observacao'
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
				observacao LIKE ? 
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
			"produto_id",
			"tipo_movimentacao",
			"quantidade",
			"valor_unitario",
			"valor_total",
			"data_movimentacao",
			"usuario_id",
			"loja_origem_id",
			"loja_destino_id",
			"observacao" 
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
			"tipo_movimentacao",
			"quantidade",
			"valor_unitario",
			"valor_total",
			"data_movimentacao",
			"usuario_id",
			"loja_origem_id",
			"loja_destino_id",
			"observacao" 
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
			"tipo_movimentacao",
			"quantidade",
			"valor_unitario",
			"valor_total",
			"data_movimentacao",
			"usuario_id",
			"loja_origem_id",
			"loja_destino_id",
			"observacao" 
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
			"tipo_movimentacao",
			"quantidade",
			"valor_unitario",
			"valor_total",
			"data_movimentacao",
			"usuario_id",
			"loja_origem_id",
			"loja_destino_id",
			"observacao" 
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
			"tipo_movimentacao",
			"quantidade",
			"valor_unitario",
			"valor_total",
			"usuario_id",
			"loja_origem_id",
			"loja_destino_id",
			"observacao",
			"id" 
		];
	}
	

	/**
     * return financaView page fields of the model.
     * 
     * @return array
     */
	public static function financaViewFields(){
		return [ 
			"id",
			"produto_id",
			"tipo_movimentacao",
			"quantidade",
			"valor_unitario",
			"valor_total",
			"data_movimentacao",
			"usuario_id",
			"loja_origem_id",
			"loja_destino_id",
			"observacao" 
		];
	}
	

	/**
     * return exportFinancaView page fields of the model.
     * 
     * @return array
     */
	public static function exportFinancaViewFields(){
		return [ 
			"id",
			"produto_id",
			"tipo_movimentacao",
			"quantidade",
			"valor_unitario",
			"valor_total",
			"data_movimentacao",
			"usuario_id",
			"loja_origem_id",
			"loja_destino_id",
			"observacao" 
		];
	}
}
