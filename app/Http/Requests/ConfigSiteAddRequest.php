<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigSiteAddRequest extends FormRequest
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
            
				"nome_site" => "required",
				"logo" => "nullable",
				"cnpj" => "nullable|string",
				"endereco" => "nullable",
				"telefone" => "nullable",
				"whatsapp" => "nullable|string",
				"email" => "nullable|email",
				"facebook" => "nullable|string",
				"instagram" => "nullable|string",
				"twitter" => "nullable|string",
				"linkedin" => "nullable|string",
				"youtube" => "nullable|string",
				"horario_funcionamento" => "nullable|string",
				"sobre" => "nullable",
            
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
