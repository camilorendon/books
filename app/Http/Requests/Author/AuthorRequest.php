<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $rules = [
            'name' => ['required', 'string'],
            'biography' => ['required', 'string'],
        ];
        if ($this->method()== 'POST') {
            array_push($rules['name'], 'unique:authors,name');
            array_push($rules['biography'], 'unique:authors,biography');
        }else{
            array_push($rules['name'], 'unique:authors,name,' . $this->author->id );
            array_push($rules['biography'], 'unique:authors,biography,' . $this->author->id );
        }
        return $rules;
    }
    public function messages()
    {
        return[
            'name.required'=>"El nombre es requerido",
            'name.string'=>"El nombre debe ser valido",
        ];
    }
}
