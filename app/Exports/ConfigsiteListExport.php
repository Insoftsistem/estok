<?php 

namespace App\Exports;
use App\Models\ConfigSite;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class ConfigsiteListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(ConfigSite::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Id',
			'Nome Site',
			'Logo',
			'Cnpj',
			'Endereco',
			'Telefone',
			'Whatsapp',
			'Email',
			'Facebook',
			'Instagram',
			'Twitter',
			'Linkedin',
			'Youtube',
			'Horario Funcionamento',
			'Sobre',
			'Created At',
			'Updated At'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->nome_site,
			$record->logo,
			$record->cnpj,
			$record->endereco,
			$record->telefone,
			$record->whatsapp,
			$record->email,
			$record->facebook,
			$record->instagram,
			$record->twitter,
			$record->linkedin,
			$record->youtube,
			$record->horario_funcionamento,
			$record->sobre,
			$record->created_at,
			$record->updated_at
        ];
    }
}
