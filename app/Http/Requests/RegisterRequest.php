<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|unique:users|email',
            'name' => 'required',
            'password' => 'required|confirmed|min:7',
            'password_confirmed' => 'required',
        ];
    }

    public function messages()
    {
      return [
        'email.required' => 'Eメールは入力必須です',
        'email.unique' => 'すでに登録されているメールアドレスです',
        'email.email' => 'メールアドレスを入力してください',
        'name.required' => '名前は必ず入力してください',
        'password.required' =>'パスワードを入力してください',
        'password.confirmed' => 'パスワードが一致しません',
        'password.min' => 'パスワードは7文字以上で入力してください',
        'password_confirmed' => 'パスワード（確認用）は入力必須です',
      ];
    }
}
