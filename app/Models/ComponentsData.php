<?php 
namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
 * Components data Model
 * Use for getting values from the database for page components
 * Support raw query builder
 * @category Model
 */
class ComponentsData{
	

	/**
     * valor_option_list Model Action
     * @return array
     */
	function valor_option_list(){
		$sqltext = "";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * movimentacao_id_option_list Model Action
     * @return array
     */
	function movimentacao_id_option_list(){
		$sqltext = "SELECT id as value, id as label FROM movimentacao_financeira";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * produto_id_option_list Model Action
     * @return array
     */
	function produto_id_option_list(){
		$sqltext = "SELECT id as value, nome as label FROM produtos";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * loja_origem_id_option_list Model Action
     * @return array
     */
	function loja_origem_id_option_list(){
		$sqltext = "SELECT id as value, nome as label FROM lojas";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * estoquemovimentos_produto_id_option_list Model Action
     * @return array
     */
	function estoquemovimentos_produto_id_option_list(){
		$sqltext = "SELECT id as value, id as label FROM produtos";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * usuario_id_option_list Model Action
     * @return array
     */
	function usuario_id_option_list(){
		$sqltext = "SELECT id as value, username as label FROM users";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * estoquemovimentos_loja_origem_id_option_list Model Action
     * @return array
     */
	function estoquemovimentos_loja_origem_id_option_list(){
		$sqltext = "SELECT id as value, id as label FROM lojas";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * role_id_option_list Model Action
     * @return array
     */
	function role_id_option_list(){
		$sqltext = "SELECT role_id as value, role_name as label FROM roles";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * Check if value already exist in Users table
	 * @param string $value
     * @return bool
     */
	function users_username_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('users')->where('username', $value)->value('username');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * Check if value already exist in Users table
	 * @param string $value
     * @return bool
     */
	function users_email_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('users')->where('email', $value)->value('email');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * vendasitens_produto_id_option_list Model Action
     * @return array
     */
	function vendasitens_produto_id_option_list(){
		$arr = [];
		if(request()->search){
			$search = trim(request()->search);
			$sqltext = "SELECT  DISTINCT id AS value,nome AS label FROM produtos WHERE nome LIKE  :search  ORDER BY nome ASC LIMIT 10" ;
			$query_params = [];
			$query_params['search'] = "%$search%";
			$arr = DB::select($sqltext, $query_params);
		}
		return $arr;
	}
	

	/**
	* linechart_lojasatuais Model Action
	* @return array
	*/
	function linechart_lojasatuais(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT  lojas.id, lojas.nome, lojas.cnpj, lojas.email, lojas.telefone, lojas.endereco, lojas.data_cadastro FROM lojas";
		$query_params = [];
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nome');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'cnpj'),
			'label' => "CNPJ",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$dataset2 = [
			'data' =>  array_column($records, 'data_cadastro'),
			'label' => "Data",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset2;
		$dataset3 = [
			'data' =>  array_column($records, 'telefone'),
			'label' => "Fone",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset3;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* barchart_produtosdaslojas Model Action
	* @return array
	*/
	function barchart_produtosdaslojas(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT  produtos.id, produtos.nome, produtos.descricao, produtos.preco, produtos.quantidade, produtos.foto, produtos.data_atualizacao FROM produtos";
		$query_params = [];
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nome');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'nome'),
			'label' => "NOME",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$dataset2 = [
			'data' =>  array_column($records, 'quantidade'),
			'label' => "QTD",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset2;
		$dataset3 = [
			'data' =>  array_column($records, 'data_atualizacao'),
			'label' => "DATA",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset3;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
     * getcount_produtos Model Action
     * @return int
     */
	function getcount_produtos(){
		$sqltext = "SELECT COUNT(*) AS num FROM produtos";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}
	

	/**
     * getcount_estoquemovimentos Model Action
     * @return int
     */
	function getcount_estoquemovimentos(){
		$sqltext = "SELECT COUNT(*) AS num FROM estoque_movimentos";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}
	

	/**
     * getcount_estoqueentradas Model Action
     * @return int
     */
	function getcount_estoqueentradas(){
		$sqltext = "SELECT COUNT(*) AS num FROM estoque_entradas";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}
	

	/**
     * getcount_estoquesaidas Model Action
     * @return int
     */
	function getcount_estoquesaidas(){
		$sqltext = "SELECT COUNT(*) AS num FROM estoque_saidas";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}
	

	/**
	* barchart_movimentosdeprodutos Model Action
	* @return array
	*/
	function barchart_movimentosdeprodutos(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT  estoque_movimentos.id, estoque_movimentos.produto_id, estoque_movimentos.tipo, estoque_movimentos.quantidade, estoque_movimentos.data_movimento, estoque_movimentos.usuario_id FROM estoque_movimentos";
		$query_params = [];
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'id');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'tipo'),
			'label' => "TIPO",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$dataset2 = [
			'data' =>  array_column($records, 'quantidade'),
			'label' => "QTD",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset2;
		$dataset3 = [
			'data' =>  array_column($records, 'data_movimento'),
			'label' => "DATA",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset3;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* piechart_entradadeprodutos Model Action
	* @return array
	*/
	function piechart_entradadeprodutos(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT  estoque_entradas.id, estoque_entradas.produto_id, estoque_entradas.quantidade, estoque_entradas.valor_unitario, estoque_entradas.data_entrada, estoque_entradas.recebido, estoque_entradas.usuario_id FROM estoque_entradas";
		$query_params = [];
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'id');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'usuario_id'),
			'label' => "User",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$dataset2 = [
			'data' =>  array_column($records, 'quantidade'),
			'label' => "QTD",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset2;
		$dataset3 = [
			'data' =>  array_column($records, 'data_entrada'),
			'label' => "DATA",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset3;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* linechart_sadaprodutos Model Action
	* @return array
	*/
	function linechart_sadaprodutos(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT  estoque_saidas.id, estoque_saidas.produto_id, estoque_saidas.quantidade, estoque_saidas.motivo, estoque_saidas.data_saida, estoque_saidas.usuario_id, estoque_saidas.recebido FROM estoque_saidas";
		$query_params = [];
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'id');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'usuario_id'),
			'label' => "User",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$dataset2 = [
			'data' =>  array_column($records, 'quantidade'),
			'label' => "QTD",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset2;
		$dataset3 = [
			'data' =>  array_column($records, 'data_saida'),
			'label' => "DATA",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset3;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
}
