<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class orderProduct extends FormRequest
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
                // 'shipping_details' => 'required',
                'phone'=>'required|min:10|max:10',
                'cardNo' =>'required',
                'name' => 'required'
        ];
    }
}
