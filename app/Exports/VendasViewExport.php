<?php 

namespace App\Exports;
use App\Models\Vendas;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class VendasViewExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	protected $query;

	protected $rec_id;

    public function __construct($query, $rec_id)
    {
        $this->query = $query->select(Vendas::exportViewFields());
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
			'Usuario Id',
			'Loja Id',
			'Cliente Nome',
			'Valor Total',
			'Forma Pagamento',
			'Data Venda'
        ];
    }


    public function map($record): array
    {
        return [
			$record->id,
			$record->usuario_id,
			$record->loja_id,
			$record->cliente_nome,
			$record->valor_total,
			$record->forma_pagamento,
			$record->data_venda
        ];
    }
}
