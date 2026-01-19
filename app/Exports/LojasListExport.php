<?php 

namespace App\Exports;
use App\Models\Lojas;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class LojasListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Lojas::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Id',
			'Nome',
			'Cnpj',
			'Email',
			'Telefone',
			'Endereco',
			'Data Cadastro'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->nome,
			$record->cnpj,
			$record->email,
			$record->telefone,
			$record->endereco,
			$record->data_cadastro
        ];
    }
}
