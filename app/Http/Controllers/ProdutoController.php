<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    public function preco($id)
    {
        $produto = DB::table('produtos')
            ->select('preco')
            ->where('id', $id)
            ->first();

        if (!$produto) {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }

        return response()->json([
            'preco' => $produto->preco
        ]);
    }
}
