<?php 

namespace App\Exports;
use App\Models\EstoqueEntradas;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class EstoqueentradasViewExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	protected $query;

	protected $rec_id;

    public function __construct($query, $rec_id)
    {
        $this->query = $query->select(EstoqueEntradas::exportViewFields());
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
			'Quantidade',
			'Valor Unitario',
			'Data Entrada',
			'Recebido',
			'Usuario Id',
			'Loja Origem Id',
			'Loja Destino Id'
        ];
    }


    public function map($record): array
    {
        return [
			$record->id,
			$record->produto_id,
			$record->quantidade,
			$record->valor_unitario,
			$record->data_entrada,
			$record->recebido,
			$record->usuario_id,
			$record->loja_origem_id,
			$record->loja_destino_id
        ];
    }
}
