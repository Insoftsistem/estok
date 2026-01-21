<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; //✅ CERTO

class CriarIndexController extends Controller
{
    public function index()
    {
        $data = DB::table('config_site')->first();

        return view('pages.index.index', compact('data'));
    }
}
