<?php

namespace App\Http\Requests\Admin\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'subject' => 'required',
            'description' => 'required',
            'body' => 'required',
            'url' => 'required|url',
            'image' => 'required|image',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'subject.required' => 'Tiêu đề bài viết không được để trống',
            'description.required' => 'Trích dẫn ngắn không được để trống',
            'body.required' => 'Nội dung bài viết không được để trống',
            'url.required' => 'Url không được để trống',
            'url.url' => 'Url không hợp lệ',
            'image.required' => 'Hình ảnh không được để trống',
            'image.image' => 'Hình ảnh không hợp lệ',
        ];
    }
}
