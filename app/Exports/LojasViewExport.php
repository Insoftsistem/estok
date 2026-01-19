<?php 

namespace App\Exports;
use App\Models\Lojas;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class LojasViewExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	protected $query;

	protected $rec_id;

    public function __construct($query, $rec_id)
    {
        $this->query = $query->select(Lojas::exportViewFields());
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
