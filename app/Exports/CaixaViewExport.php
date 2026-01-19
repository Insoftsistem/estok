<?php 

namespace App\Exports;
use App\Models\Caixa;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class CaixaViewExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	protected $query;

	protected $rec_id;

    public function __construct($query, $rec_id)
    {
        $this->query = $query->select(Caixa::exportViewFields());
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
			'Movimentacao Id',
			'Tipo',
			'Valor',
			'Descricao',
			'Data Movimento'
        ];
    }


    public function map($record): array
    {
        return [
			$record->id,
			$record->movimentacao_id,
			$record->tipo,
			$record->valor,
			$record->descricao,
			$record->data_movimento
        ];
    }
}
