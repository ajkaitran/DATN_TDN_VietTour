<?php

namespace App\Http\Requests\TourType;

use Illuminate\Foundation\Http\FormRequest;

class TourTypeRequest extends FormRequest
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
                            'name' => 'required|string|max:255', // Yêu cầu trường 'name' không để trống và tối đa 255 ký tự
                            'home_name' => 'nullable|string|max:255', // Trường 'home_name' có thể trống
                            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Trường ảnh có thể trống, nhưng nếu có, nó phải là ảnh
                            'order' => 'nullable|integer', // Trường 'order' có thể trống, nhưng nếu có, phải là số nguyên
                            'show_menu' => 'nullable|boolean', // Trường 'show_menu' có thể trống, nhưng nếu có, phải là boolean
                            'show_home' => 'nullable|boolean', // Trường 'show_home' có thể trống, nhưng nếu có, phải là boolean
                            'active' => 'nullable|boolean', // Trường 'active' có thể trống, nhưng nếu có, phải là boolean
                            'slug' => 'required|string|unique:tour_categories,slug', // Trường 'slug' yêu cầu và phải là duy nhất trong bảng 'tour_categories'
                        ];
                        break;
                endswitch;
        endswitch;
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên loại tour là bắt buộc.',
            'slug.unique' => 'Đường dẫn (slug) này đã tồn tại.',
            'image.image' => 'Ảnh phải là một tệp hình ảnh hợp lệ.',
            'image.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif, svg.',
            'image.max' => 'Ảnh không được vượt quá 2MB.',
        ];
    }
}
