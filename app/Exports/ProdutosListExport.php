<?php 

namespace App\Exports;
use App\Models\Produtos;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class ProdutosListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Produtos::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Id',
			'Foto',
			'Nome',
			'Descricao',
			'Preco',
			'Quantidade',
			'Data Atualizacao'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->foto,
			$record->nome,
			$record->descricao,
			$record->preco,
			$record->quantidade,
			$record->data_atualizacao
        ];
    }
}
