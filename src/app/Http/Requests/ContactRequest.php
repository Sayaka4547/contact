<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:8'],
            'last_name' => ['required', 'string', 'max:8'],
            'gender' => ['required', 'in:1,2,3'],
            'email' => ['required', 'email'],
            'tel_area'  => ['required', 'digits_between:1,5'],
            'tel_local'  => ['required', 'digits_between:1,5'],
            'tel_number'  => ['required', 'digits_between:1,5'],
            'address'     => ['required'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'detail'      => ['required', 'string', 'max:120']
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => 'お名前を入力してください',
            'first_name.string' => 'お名前を文字列で入力してください',
            'first_name.max' => 'お名前を8文字以下で入力してください',
            'last_name.required' => 'お名前を入力してください',
            'last_name.string' => 'お名前を文字列で入力してください',
            'last_name.max' => 'お名前を8文字以下で入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '有効なメールアドレス形式を入力してください',
            'tel_area.required' => '電話番号を入力してください',
            'tel_area.digits_between' => '電話番号を1〜5桁の数字で入力してください',
            'tel_local.required' => '電話番号を入力してください',
            'tel_local.digits_between' => '電話番号を1〜5桁の数字で入力してください',
            'tel_number.required' => '電話番号を入力してください',
            'tel_number.digits_between' => '電話番号を1〜5桁の数字で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問合せの種類を選択してください',
            'detail.required' => 'お問合せ内容を入力してください',
            'detail.max' => 'お問合せ内容を120文字以下で入力してください',
        ];
     }
}
