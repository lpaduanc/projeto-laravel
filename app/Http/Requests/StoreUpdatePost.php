<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdatePost extends FormRequest
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
        $rules = [
            'title' => [
                'required',
                'min:3',
                'max:160',
                // unico na tabela posts, na coluna title onde o segment(2) (posição do id na url), seja diferente do id editado
                // "unique:posts,title,{$this->segment(2)},id",
                Rule::unique('posts')->ignore($this->segment(2))
            ],
            'content' => [
                'nullable',
                'min:5',
                'max:10000',
            ],
            'image' => [
                'required',
                'image',
            ],
        ];

        if ($this->method() == 'PUT') {
            $rules['image'] = [
                'nullable',
                'image',
            ];
        }

        return $rules;
    }
}
