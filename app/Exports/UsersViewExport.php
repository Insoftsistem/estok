<?php 

namespace App\Exports;
use App\Models\Users;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class UsersViewExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	protected $query;

	protected $rec_id;

    public function __construct($query, $rec_id)
    {
        $this->query = $query->select(Users::exportViewFields());
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
			'Foto',
			'Username',
			'Email',
			'Tel',
			'Roles',
			'Endereco',
			'Data Cadastro',
			'User Role Id'
        ];
    }


    public function map($record): array
    {
        return [
			$record->id,
			$record->foto,
			$record->username,
			$record->email,
			$record->tel,
			$record->roles,
			$record->endereco,
			$record->data_cadastro,
			$record->user_role_id
        ];
    }
}
