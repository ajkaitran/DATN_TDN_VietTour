<?php

namespace App\Http\Requests\Admin\Banner;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
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
            'banner_name' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'active' => 'boolean',
            'group_id' => 'nullable|integer',
            'url' => 'nullable|max:255',
            'sort' => 'nullable|integer|min:0',
            'slogan' => 'nullable|string|max:255',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'banner_name.string' => 'Tên banner phải là một chuỗi ký tự.',
            'image.image' => 'Ảnh banner phải là một file hình ảnh.',
            'image_mobile.image' => 'Ảnh di động phải là một file hình ảnh.',
            'active.boolean' => 'Trạng thái kích hoạt phải là giá trị đúng hoặc sai.',
            'group_id.integer' => 'Group ID phải là một số nguyên.',
            'sort.integer' => 'Thứ tự phải là một số nguyên.',
            'slogan.string' => 'Slogan phải là một chuỗi ký tự.',
        ];
    }
}
