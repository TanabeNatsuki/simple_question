<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QaRequest extends FormRequest
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
             'title' => 'required',
             'category_id' => 'required',
             'content' => 'required',
         ];
     }

    public function messages()
    {
      return [
        'title.required' => 'タイトルは必ず入力して下さい',
        'category_id.required' => 'カテゴリは必ず選択して下さい',
        'content.required' => '本文は必ず入力して下さい',
      ];
    }
}
