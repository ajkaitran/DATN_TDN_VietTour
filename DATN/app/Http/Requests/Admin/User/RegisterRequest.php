<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:255', 'unique:users,username'], 
            'email' => ['required', 'email', 'max:255', 'unique:users,email'], 
            'password' => ['required', 'string', 'min:6'], 
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Vui lòng nhập tên tài khoản.',
            'username.string' => 'Tên tài khoản phải là chuỗi ký tự.',
            'username.max' => 'Tên tài khoản tối đa 255 ký tự.',
            'username.unique' => 'Tên tài khoản đã tồn tại.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.max' => 'Email tối đa 255 ký tự.',
            'email.unique' => 'Email đã tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'password.min' => 'Mật khẩu tối thiểu phải có 6 ký tự.',
            // 'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ];
    }
}
