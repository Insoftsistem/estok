<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Produtos extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'produtos';
	

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
		'foto','nome','descricao','preco','quantidade'
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
				foto LIKE ?  OR 
				nome LIKE ?  OR 
				descricao LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%"
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
			"foto",
			"nome",
			"descricao",
			"preco",
			"quantidade",
			"data_atualizacao" 
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
			"foto",
			"nome",
			"descricao",
			"preco",
			"quantidade",
			"data_atualizacao" 
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
			"nome",
			"descricao",
			"preco",
			"quantidade",
			"foto",
			"data_atualizacao" 
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
			"nome",
			"descricao",
			"preco",
			"quantidade",
			"foto",
			"data_atualizacao" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"foto",
			"nome",
			"descricao",
			"preco",
			"quantidade",
			"id" 
		];
	}
	

	/**
     * return produtosView page fields of the model.
     * 
     * @return array
     */
	public static function produtosViewFields(){
		return [ 
			"id",
			"foto",
			"nome",
			"descricao",
			"preco",
			"quantidade",
			"data_atualizacao" 
		];
	}
	

	/**
     * return exportProdutosView page fields of the model.
     * 
     * @return array
     */
	public static function exportProdutosViewFields(){
		return [ 
			"id",
			"foto",
			"nome",
			"descricao",
			"preco",
			"quantidade",
			"data_atualizacao" 
		];
	}
}
