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
        $rules = [];
        $currentAction = $this->route()->getActionMethod();
        switch ($this->method()):
            case 'POST':
                switch ($currentAction):
                    case 'create':
                        // dd(1233);
                        $rules = [
                            'full_name' => 'required|string|max:255',  // Họ tên là bắt buộc
                            'address' => 'nullable|string|max:255',     // Địa chỉ không bắt buộc
                            'position' => 'nullable|string|max:255',    // Chức vụ không bắt buộc
                            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Ảnh hợp lệ, tối đa 2MB
                            'comment' => 'required|string',             // Lời nhận xét là bắt buộc
                            'order' => 'nullable|integer|min:0',        // Thứ tự hiển thị, mặc định là số nguyên không âm
                            'active' => 'nullable|boolean',
                        ];
                        break;
                endswitch;
        endswitch;
        return $rules;
    }
    public function messages()
    {
        return [
            'full_name.required' => 'Họ tên là bắt buộc.',
            'comment.required' => 'Lời nhận xét là bắt buộc.',
            'image.image' => 'Ảnh phải là một tệp hình ảnh hợp lệ.',
            'order.integer' => 'Thứ tự phải là một số nguyên.',
        ];
    }
}
