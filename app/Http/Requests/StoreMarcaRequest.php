<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class StoreMarcaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => ['required','unique:marcas,nome','string','max:30'],
            'imagem' => ['required','image','max:100']
            // Posso utilizar o mimes:docx para informa qual extensão e permitida nesse campo.
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.unique' => 'O nome já está em uso.',
            'nome.max' => 'O campo nome deve ter no máximo :max caracteres.',
            'imagem.required' => 'O campo imagem é obrigatório.',
            'imagem.max' => 'O campo imagem deve ter no máximo :max caracteres.'
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse(['errors' => $validator->errors()], 422);
        throw new HttpResponseException($response);
    }
}
