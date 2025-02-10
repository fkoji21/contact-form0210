<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
    return [
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'gender' => ['required', 'string', 'in:男性,女性,その他'], // ← 修正！
        'email' => ['required', 'email', 'max:255'],
        'tel1' => ['required', 'digits_between:2,4'], // ← 2桁以上4桁以下
        'tel2' => ['required', 'digits_between:3,4'], // ← 3桁以上4桁以下
        'tel3' => ['required', 'digits:4'], // ← 4桁固定
        'address' => ['required', 'string', 'max:255'],
        'building' => ['nullable', 'string', 'max:255'],
        'detail' => ['required', 'string', 'max:120'],
    ];
    }

    /**
     * カスタムエラーメッセージ
     */
    public function messages(): array
    {
        return [
            'first_name.required' => '姓を入力してください',
            'last_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'gender.in' => '性別の選択が正しくありません',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスは正しい形式で入力してください',
            'tel.required' => '電話番号を入力してください',
            'tel.regex' => '電話番号は10桁または11桁の半角数字で入力してください',
            'address.required' => '住所を入力してください',
            'building.max' => '建物名は255文字以内で入力してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
