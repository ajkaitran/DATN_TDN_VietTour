<?php

namespace App\Http\Requests\Admin\CategoryArticle;

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
            'category_name' => 'required|string',
            'category_sort' => 'required|string',
            'type_post' => 'required|string',
            'url' => 'required|string|url',
        ];
    }

    public function messages()
    {
        return [
            'category_name.required' => 'Vui lòng nhập tên danh mục',
            'category_name.string' => 'Tên danh mục phải là chuổi',
            'category_sort.required' => 'Vui lòng nhập số thứ tự',
            'category_sort.string' => 'Số thứ tự phải là chuổi',
            'type_post.required' => 'Vui lòng chọn loại bài viết',
            'type_post.string' => 'Loại bài viết phải là chuổi',
            'url.required' => 'Vui lòng nhập url',
            'url.string' => 'Url phải là chuổi',
            'url.url' => 'Url phải là url',
        ];
    }
}
