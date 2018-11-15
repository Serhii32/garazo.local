<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreCategoryRequest extends FormRequest
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
        return [
            'title' => 'required|max:255',
            'short_description' => 'max:1000',
            'parent_id' => 'integer|nullable',
            'titleSEO' => 'max:255',
            'descriptionSEO' => 'max:1000',
            'keywordsSEO' => 'max:255',
            'photo' => 'mimetypes:image/jpeg,image/png,image/jpg,image/gif|max:20000'
        ];
    }
}
