<?php

namespace App\Http\Requests\Admin\Combo;

use Illuminate\Foundation\Http\FormRequest;

class StoreComboRequest extends FormRequest
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
        $rules = [];
        $currentAction = $this->route()->getActionMethod();
        switch ($this->method()):
            case 'POST':
                switch ($currentAction):
                    case 'create':
                        // dd(1233);
                        $rules = [
                            'name' => 'required|string|max:255',
                            'product_code' => 'required|string|unique:products,product_code|max:100',
                            'price' => 'required|numeric|min:0',
                            'sale_off' => 'nullable|numeric|min:0',
                            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480', // 2MB
                            // 'category_id' => 'required|exists:main_category_id,id',
                            // 'type_id' => 'required|exists:category_type_id,id',
                            'TimeDetailName.*' => 'nullable|string|max:255',
                            'TimeDetailBody.*' => 'nullable|string',
                        ];
                        break;
                endswitch;
        endswitch;
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống.',
            'product_code.required' => 'Mã sản phẩm không được để trống.',
            'product_code.unique' => 'Mã sản phẩm đã tồn tại.',
            'price.required' => 'Giá bán không được để trống.',
            'price.numeric' => 'Giá bán phải là một số.',
            'sale_off.numeric' => 'Giá khuyến mãi phải là một số.',
            'image.required' => 'Hình ảnh sản phẩm là bắt buộc.',
            'image.image' => 'Hình ảnh phải là định dạng hợp lệ.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'image.max' => 'Hình ảnh không được vượt quá 2MB.',
            'category_id.required' => 'Danh mục sản phẩm là bắt buộc.',
            'category_id.exists' => 'Danh mục sản phẩm không hợp lệ.',
            'type_id.required' => 'Loại tour là bắt buộc.',
            'type_id.exists' => 'Loại tour không hợp lệ.',
            'TimeDetailName.*.string' => 'Tiêu đề ngày phải là chuỗi ký tự.',
            'TimeDetailBody.*.string' => 'Nội dung ngày phải là chuỗi ký tự.',
        ];
    }
}
