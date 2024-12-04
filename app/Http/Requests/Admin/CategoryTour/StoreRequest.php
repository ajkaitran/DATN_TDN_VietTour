<?php

namespace App\Http\Requests\Admin\CategoryTour;

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
            'name' => 'required|string',
            'city' => 'required|string',
            'hotline' => 'required|string',
            'url' => 'required|string|url',
            'meta_description' => 'required|string',
            'meta_title' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên danh mục',
            'city.required' => 'Vui lòng nhập tên thành phố',
            'hotline.required' => 'Vui lòng nhập số hotline',
            'url.required' => 'Vui lòng nhập url',
            'meta_description.required' => 'Vui lòng nhập mô tả',
            'meta_title.required' => 'Vui lòng nhập tiêu đề',
            'url.url' => 'Vui lòng nhập url hợp lệ',
        ];
    }
}
