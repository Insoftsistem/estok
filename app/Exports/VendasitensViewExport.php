<?php 

namespace App\Exports;
use App\Models\VendasItens;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class VendasitensViewExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	protected $query;

	protected $rec_id;

    public function __construct($query, $rec_id)
    {
        $this->query = $query->select(VendasItens::exportViewFields());
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
			'Venda Id',
			'Produto Id',
			'Quantidade',
			'Valor Unitario',
			'Subtotal'
        ];
    }


    public function map($record): array
    {
        return [
			$record->id,
			$record->venda_id,
			$record->produto_id,
			$record->quantidade,
			$record->valor_unitario,
			$record->subtotal
        ];
    }
}
