<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSEORequest extends FormRequest
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
        $output = [];
        for($i = 1; $i <= (count($this->request->all())-2)/3; $i++) {
            $output['titleSEO_'.$i] = 'max:255';
            $output['descriptionSEO_'.$i] = 'max:1000';
            $output['keywordsSEO_'.$i] = 'max:255';
        }
        return $output;
    }
}
