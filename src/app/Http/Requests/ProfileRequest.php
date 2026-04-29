<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required'],
            'postal_code' => ['nullable'],
            'address' => ['nullable'],
            'building' => ['nullable'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ユーザー名を入力してください',
            'profile_image.image' => '画像ファイルをアップロードしてください',
            'profile_image.mimes' => 'jpeg, png, jpg, gif形式の画像をアップロードしてください',
            'profile_image.max' => '画像サイズは2MB以下にしてください',
        ];
    }
}
