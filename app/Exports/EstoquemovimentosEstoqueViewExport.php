<?php 

namespace App\Exports;
use App\Models\EstoqueMovimentos;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class EstoquemovimentosEstoqueViewExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(EstoqueMovimentos::exportEstoqueViewFields());
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
			'Tipo',
			'Quantidade',
			'Data Movimento',
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
			$record->tipo,
			$record->quantidade,
			$record->data_movimento,
			$record->usuario_id,
			$record->loja_origem_id,
			$record->loja_destino_id
        ];
    }
}
