<?php 

namespace App\Exports;
use App\Models\MovimentacaoFinanceira;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class MovimentacaofinanceiraFinancaViewExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(MovimentacaoFinanceira::exportFinancaViewFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Id',
			'Produto Id',
			'Tipo Movimentacao',
			'Quantidade',
			'Valor Unitario',
			'Valor Total',
			'Data Movimentacao',
			'Usuario Id',
			'Loja Origem Id',
			'Loja Destino Id',
			'Observacao'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->produto_id,
			$record->tipo_movimentacao,
			$record->quantidade,
			$record->valor_unitario,
			$record->valor_total,
			$record->data_movimentacao,
			$record->usuario_id,
			$record->loja_origem_id,
			$record->loja_destino_id,
			$record->observacao
        ];
    }
}
