<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'login' => ['required', 'string', 'max:255'], // login có thể là email hoặc username
            'password' => ['required', 'string', 'min:6'], // Đảm bảo password tối thiểu 6 ký tự
        ];
    }

    public function messages(): array
    {
        return [
            'login.required' => 'Vui lòng nhập email hoặc tên người dùng.',
            'login.string' => 'Email hoặc tên người dùng phải là chuỗi ký tự.',
            'login.max' => 'Email hoặc tên người dùng tối đa 255 ký tự.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'password.min' => 'Mật khẩu tối thiểu phải có 6 ký tự.',
        ];
    }
}
