<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
/**
 * Index Page Controller
 * @category  Controller
 */
class IndexController extends Controller{
	/**
     * index Action
     * @return View
     */
	function index(){
		
		{
        $data = DB::table('config_site')->first();

        return view('pages.index.index', compact('data'));
    }
		
		
		return view("pages.index.index");
	}

	/**
     * Login Action
     * @return View
     */
	function login(){
		return view("pages.index.login");
	}
	
	
	
	
	
}