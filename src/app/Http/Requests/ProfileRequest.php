<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'profile_image' => 'mimes:jpeg,png',
            'user_name' => 'required|max:20',
            'post_code' => 'required|regex:/^[0-9]{3}-[0-9]{4}$/',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'profile_image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'user_name.required' => 'お名前を入力してください',
            'user_name.max' => 'お名前は20文字以下で入力してください',
            'post_code.required' => '郵便番号を入力してください',
            'post_code.regex' => 'ハイフンありの8文字の郵便番号形式で入力してください',
            'address.required' => '住所を入力してください'
        ];
    }
}
