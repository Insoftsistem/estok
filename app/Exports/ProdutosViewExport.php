<?php 

namespace App\Exports;
use App\Models\Produtos;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class ProdutosViewExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	protected $query;

	protected $rec_id;

    public function __construct($query, $rec_id)
    {
        $this->query = $query->select(Produtos::exportViewFields());
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
			'Nome',
			'Descricao',
			'Preco',
			'Quantidade',
			'Foto',
			'Data Atualizacao'
        ];
    }


    public function map($record): array
    {
        return [
			$record->id,
			$record->nome,
			$record->descricao,
			$record->preco,
			$record->quantidade,
			$record->foto,
			$record->data_atualizacao
        ];
    }
}
