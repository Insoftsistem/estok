<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class EstoqueSaidas extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'estoque_saidas';
	

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
		'produto_id','quantidade','motivo','usuario_id','recebido','loja_origem_id','loja_destino_id'
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
				motivo LIKE ? 
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
			"quantidade",
			"motivo",
			"data_saida",
			"usuario_id",
			"recebido",
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
			"motivo",
			"data_saida",
			"usuario_id",
			"recebido",
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
			"motivo",
			"data_saida",
			"usuario_id",
			"recebido",
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
			"motivo",
			"data_saida",
			"usuario_id",
			"recebido",
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
			"motivo",
			"usuario_id",
			"recebido",
			"loja_origem_id",
			"loja_destino_id",
			"id" 
		];
	}
	

	/**
     * return saidaView page fields of the model.
     * 
     * @return array
     */
	public static function saidaViewFields(){
		return [ 
			"id",
			"produto_id",
			"quantidade",
			"motivo",
			"data_saida",
			"usuario_id",
			"recebido",
			"loja_origem_id",
			"loja_destino_id" 
		];
	}
	

	/**
     * return exportSaidaView page fields of the model.
     * 
     * @return array
     */
	public static function exportSaidaViewFields(){
		return [ 
			"id",
			"produto_id",
			"quantidade",
			"motivo",
			"data_saida",
			"usuario_id",
			"recebido",
			"loja_origem_id",
			"loja_destino_id" 
		];
	}
}
