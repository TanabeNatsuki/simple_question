<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewpassRequest extends FormRequest
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
            'new_pass' => 'required|min:7',
        ];
    }

    public function messages()
    {
      return [
        'new_pass.required' => '必ず入力して下さい',
        'new_pass.min' => '7文字以上で入力して下さい',
      ];
    }
}
