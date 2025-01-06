<?php

namespace App\Http\Requests\Admin\FeedbackRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'full_name' => 'required',
            'comment' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Vui lòng nhập tên',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'position.required' => 'Vui lòng nhập vị trí',
            'comment.required' => 'Vui lòng nhập nội dung',
            'type.required' => 'Vui lòng nhập loại',
        ];
    }
}
