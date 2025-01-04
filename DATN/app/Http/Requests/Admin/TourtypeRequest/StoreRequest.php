<?php

namespace App\Http\Requests\Admin\TourtypeRequest;

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
        $rules = [];
        $currentAction = $this->route()->getActionMethod();
        switch ($this->method()):
            case 'POST':
                switch ($currentAction):
                    case 'create':
                        // dd(1233);
                        $rules = [
                            'name' => 'required|string|max:255',
                            'home_name' => 'nullable|string|max:255',
                            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                            'order' => 'nullable|integer',
                            'show_menu' => 'nullable|boolean',
                            'active' => 'nullable|boolean',
                            'show_home' => 'nullable|boolean',
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
            'name.max' => 'Tên loại tour không được vượt quá 255 ký tự.',
            'image.image' => 'Ảnh phải là tệp hình ảnh.',
            'image.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'image.max' => 'Dung lượng ảnh không được vượt quá 2MB.',
        ];
    }
}
