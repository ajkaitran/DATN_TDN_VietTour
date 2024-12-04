<?php

namespace App\Http\Requests\Admin\Banner;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerRequest extends FormRequest
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
            'banner_name' => 'sometimes|string|max:255',
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_mobile' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'active' => 'sometimes|boolean',
            'group_id' => 'sometimes|nullable|integer|exists:groups,id',
            'url' => 'sometimes|nullable|url|max:255',
            'sort' => 'sometimes|nullable|integer|min:0',
            'slogan' => 'sometimes|nullable|string|max:255',
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
