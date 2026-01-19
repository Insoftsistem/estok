<?php 

namespace App\Exports;
use App\Models\MovimentacaoFinanceira;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class MovimentacaofinanceiraViewExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	protected $query;

	protected $rec_id;

    public function __construct($query, $rec_id)
    {
        $this->query = $query->select(MovimentacaoFinanceira::exportViewFields());
        $this->rec_id = $rec_id;
    }


    public function query()
    {
        return $this->query->where("id", $this->rec_id);
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
