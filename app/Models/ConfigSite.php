<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ConfigSite extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'config_site';
	

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
		'nome_site','logo','cnpj','endereco','telefone','whatsapp','email','facebook','instagram','twitter','linkedin','youtube','horario_funcionamento','sobre'
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
				nome_site LIKE ?  OR 
				logo LIKE ?  OR 
				cnpj LIKE ?  OR 
				endereco LIKE ?  OR 
				telefone LIKE ?  OR 
				whatsapp LIKE ?  OR 
				email LIKE ?  OR 
				facebook LIKE ?  OR 
				instagram LIKE ?  OR 
				twitter LIKE ?  OR 
				linkedin LIKE ?  OR 
				youtube LIKE ?  OR 
				horario_funcionamento LIKE ?  OR 
				sobre LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"nome_site",
			"logo",
			"cnpj",
			"endereco",
			"telefone",
			"whatsapp",
			"email",
			"facebook",
			"instagram",
			"twitter",
			"linkedin",
			"youtube",
			"horario_funcionamento",
			"sobre",
			"created_at",
			"updated_at" 
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
			"nome_site",
			"logo",
			"cnpj",
			"endereco",
			"telefone",
			"whatsapp",
			"email",
			"facebook",
			"instagram",
			"twitter",
			"linkedin",
			"youtube",
			"horario_funcionamento",
			"sobre",
			"created_at",
			"updated_at" 
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
			"nome_site",
			"logo",
			"cnpj",
			"endereco",
			"telefone",
			"whatsapp",
			"email",
			"facebook",
			"instagram",
			"twitter",
			"linkedin",
			"youtube",
			"horario_funcionamento",
			"sobre",
			"created_at",
			"updated_at" 
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
			"nome_site",
			"logo",
			"cnpj",
			"endereco",
			"telefone",
			"whatsapp",
			"email",
			"facebook",
			"instagram",
			"twitter",
			"linkedin",
			"youtube",
			"horario_funcionamento",
			"sobre",
			"created_at",
			"updated_at" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"nome_site",
			"logo",
			"cnpj",
			"endereco",
			"telefone",
			"whatsapp",
			"email",
			"facebook",
			"instagram",
			"twitter",
			"linkedin",
			"youtube",
			"horario_funcionamento",
			"sobre",
			"id" 
		];
	}
}
