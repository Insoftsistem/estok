<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstoqueMovimentosAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
		
        return [
            
				"produto_id" => "required",
				"tipo" => "required",
				"quantidade" => "required|numeric",
				"usuario_id" => "nullable",
				"loja_origem_id" => "nullable",
				"loja_destino_id" => "nullable",
            
        ];
    }

	public function messages()
    {
        return [
			
            //using laravel default validation messages
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            //eg = 'name' => 'trim|capitalize|escape'
        ];
    }
}
