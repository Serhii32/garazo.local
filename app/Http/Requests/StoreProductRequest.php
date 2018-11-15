<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Gate::allows('adminBusiness')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|max:255',
            'price' => 'required|numeric|min:0.00|max:100000000.00',
            'main_photo' => 'mimetypes:image/jpeg,image/png,image/jpg,image/gif|max:20000',
            'category' => 'integer|nullable',
            'promo_action' => 'integer|min:0|max:1',
            'best' => 'integer|min:0|max:1',
            'novelty' => 'integer|min:0|max:1',
            'description' => 'max:65000',
            'short_description' => 'max:1000',
            'titleSEO' => 'max:255',
            'descriptionSEO' => 'max:1000',
            'keywordsSEO' => 'max:255',
        ];

        if ($this->attributes_names != null) {
                   
            $attributes_names = count($this->attributes_names) - 1;
            foreach(range(0, $attributes_names) as $index) {
                $rules['attributes_names.' . $index] = 'required|max:255';
                $rules['attributes_values.' . $index] = 'required|max:255';
            }
        }

        return $rules;
    }
}
