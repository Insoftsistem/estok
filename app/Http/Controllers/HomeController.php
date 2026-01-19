<?php 

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
/**
 * Home Page Controller
 * @category  Controller
 */
class HomeController extends Controller{
	/**
     * Index Action
     * @return \Illuminate\View\View
     */
	function index(){
		$user = auth()->user();
		if($user->hasRole('caixa_ativo')){
			return view("pages.home.caixa_ativo");
		}
		elseif($user->hasRole('resumo')){
			return view("pages.home.resumo");
		}
		else{
			return view("pages.home.index");
		}
	}
	
}
