<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Caixa extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'caixa';
	

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
		'movimentacao_id','tipo','valor','descricao'
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
				descricao LIKE ? 
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
			"movimentacao_id",
			"tipo",
			"valor",
			"descricao",
			"data_movimento" 
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
			"movimentacao_id",
			"tipo",
			"valor",
			"descricao",
			"data_movimento" 
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
			"movimentacao_id",
			"tipo",
			"valor",
			"descricao",
			"data_movimento" 
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
			"movimentacao_id",
			"tipo",
			"valor",
			"descricao",
			"data_movimento" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id",
			"movimentacao_id",
			"tipo",
			"valor",
			"descricao" 
		];
	}
	

	/**
     * return caixaView page fields of the model.
     * 
     * @return array
     */
	public static function caixaViewFields(){
		return [ 
			"id",
			"movimentacao_id",
			"tipo",
			"valor",
			"descricao",
			"data_movimento" 
		];
	}
	

	/**
     * return exportCaixaView page fields of the model.
     * 
     * @return array
     */
	public static function exportCaixaViewFields(){
		return [ 
			"id",
			"movimentacao_id",
			"tipo",
			"valor",
			"descricao",
			"data_movimento" 
		];
	}
}
