<?php 

namespace App\Exports;
use App\Models\EstoqueSaidas;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class EstoquesaidasSaidaViewExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(EstoqueSaidas::exportSaidaViewFields());
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
			'Quantidade',
			'Motivo',
			'Data Saida',
			'Usuario Id',
			'Recebido',
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
			$record->motivo,
			$record->data_saida,
			$record->usuario_id,
			$record->recebido,
			$record->loja_origem_id,
			$record->loja_destino_id
        ];
    }
}
