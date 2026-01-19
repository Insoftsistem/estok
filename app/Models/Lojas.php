<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Lojas extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'lojas';
	

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
		'nome','cnpj','email','telefone','endereco'
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
				nome LIKE ?  OR 
				cnpj LIKE ?  OR 
				email LIKE ?  OR 
				telefone LIKE ?  OR 
				endereco LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"nome",
			"cnpj",
			"email",
			"telefone",
			"endereco",
			"data_cadastro" 
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
			"nome",
			"cnpj",
			"email",
			"telefone",
			"endereco",
			"data_cadastro" 
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
			"cnpj",
			"email",
			"telefone",
			"endereco",
			"data_cadastro" 
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
			"cnpj",
			"email",
			"telefone",
			"endereco",
			"data_cadastro" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"nome",
			"cnpj",
			"email",
			"telefone",
			"endereco",
			"id" 
		];
	}
	

	/**
     * return lojasViewList page fields of the model.
     * 
     * @return array
     */
	public static function lojasViewListFields(){
		return [ 
			"id",
			"nome",
			"cnpj",
			"email",
			"telefone",
			"endereco",
			"data_cadastro" 
		];
	}
	

	/**
     * return exportLojasViewList page fields of the model.
     * 
     * @return array
     */
	public static function exportLojasViewListFields(){
		return [ 
			"id",
			"nome",
			"cnpj",
			"email",
			"telefone",
			"endereco",
			"data_cadastro" 
		];
	}
}
