<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'name' => 'required|min:3|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|min:3|max:30',
            'newPost' => 'nullable|max:191',
            'delivery'=> 'required|in:1,2',
            'payment'=> 'required|in:1,2,3', 
        ];
    }
}
