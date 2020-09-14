<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HouseCreateAndEditRequest extends FormRequest
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
            'address_street' => 'required|max:200',
            'address_city' => 'required|max:200',
            'address_state' => 'required|max:2',
            'address_zip' => 'required|max:10|regex:/^\d{5}([\-]?\d{4})?$/',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'description' => 'required'
        ];
    }

    // public function messages(){
    //     return [

    //     ];
    // }

}
