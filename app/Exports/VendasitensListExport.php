<?php 

namespace App\Exports;
use App\Models\VendasItens;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class VendasitensListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(VendasItens::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
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
