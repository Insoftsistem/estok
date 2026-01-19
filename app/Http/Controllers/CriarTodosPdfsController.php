<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class CriarTodosPdfsController extends Controller
{
    private function gerarPdf($view, $dados, $nomeArquivo)
    {
        $html = View::make($view, $dados)->render();

        $options = new Options();
		$options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'DejaVu Sans');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', "inline; filename={$nomeArquivo}");
    }

    /* =======================
       NOTA DE VENDA
    ======================= */
    public function notaVenda($id)
    {
        $venda = DB::table('vendas')->where('id', $id)->first();

        $itens = DB::table('vendas_itens as vi')
            ->join('produtos as p', 'p.id', '=', 'vi.produto_id')
            ->select(
                'p.nome as produto',
                'vi.quantidade',
                'vi.valor_unitario as valor'
            )
            ->where('vi.venda_id', $id)
            ->get();

        $config = DB::table('config_site')->where('id', 1)->first();

        return $this->gerarPdf(
            'pdf.nota_venda',
            compact('venda', 'itens', 'config'),
            "nota_venda_{$id}.pdf"
        );
    }

    /* =======================
       MOVIMENTAÇÃO FINANCEIRA
    ======================= */
    public function movimentacaoFinanceira($id)
{
    $mov = DB::table('movimentacao_financeira')
        ->select(
            'id',
            'tipo_movimentacao',
            'observacao',
            'data_movimentacao',
            DB::raw('COALESCE(valor_total, 0) as valor')
        )
        ->where('id', $id)
        ->first();

    $config = DB::table('config_site')->where('id', 1)->first();

    return $this->gerarPdf(
        'pdf.movimentacao_financeira',
        compact('mov', 'config'),
        "movimentacao_{$id}.pdf"
    );
}

    /* =======================
       ENTRADA DE ESTOQUE
    ======================= */
    public function entradaEstoque($id)
    {
        $entrada = DB::table('estoque_entradas as e')
            ->join('produtos as p', 'p.id', '=', 'e.produto_id')
            ->select(
                'e.*',
                'p.nome as produto_nome'
            )
            ->where('e.id', $id)
            ->first();

        $config = DB::table('config_site')->where('id', 1)->first();

        return $this->gerarPdf(
            'pdf.entrada_estoque',
            compact('entrada', 'config'),
            "entrada_estoque_{$id}.pdf"
        );
    }

    /* =======================
       SAÍDA DE ESTOQUE
    ======================= */
    public function saidaEstoque($id)
    {
        $saida = DB::table('estoque_saidas as s')
            ->join('produtos as p', 'p.id', '=', 's.produto_id')
            ->select(
                's.*',
                'p.nome as produto_nome'
            )
            ->where('s.id', $id)
            ->first();

        $config = DB::table('config_site')->where('id', 1)->first();

        return $this->gerarPdf(
            'pdf.saida_estoque',
            compact('saida', 'config'),
            "saida_estoque_{$id}.pdf"
        );
    }
	
	
	/* =======================
   MOVIMENTAÇÕES DE ESTOQUE POR PERÍODO
======================= */
public function estoqueMovimentosPeriodo(Request $request)
{
    $dataInicio = $request->get('inicio');
    $dataFim    = $request->get('fim');

    $movimentos = DB::table('estoque_movimentos as m')
        ->join('produtos as p', 'p.id', '=', 'm.produto_id')
        ->select(
            'm.id',
            'p.nome as produto',
            'm.tipo',
            'm.quantidade',
            'm.data_movimento'
        )
        ->whereBetween('m.data_movimento', [
            $dataInicio . ' 00:00:00',
            $dataFim . ' 23:59:59'
        ])
        ->orderBy('m.data_movimento', 'asc')
        ->get();

    $config = DB::table('config_site')->where('id', 1)->first();

    return $this->gerarPdf(
        'pdf.estoque_movimentos_periodo',
        compact('movimentos', 'config', 'dataInicio', 'dataFim'),
        "movimentos_estoque_{$dataInicio}_{$dataFim}.pdf"
    );
}

	
	
	
	//FIM
}
