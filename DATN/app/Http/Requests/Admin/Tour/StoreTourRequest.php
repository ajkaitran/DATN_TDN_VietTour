<?php

namespace App\Http\Requests\Admin\Tour;

use Illuminate\Foundation\Http\FormRequest;

class StoreTourRequest extends FormRequest
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
                            'name' => 'required|string',
                            'start_places_id' => 'required',
                            'category_type_id' => 'required',
                            'main_category_id' => 'required',
                            'product_category_id' => 'required',
                            'description' => 'required',
                            'schedule' => 'required',
                            'TimeDetail' => 'required',
                        ];
                        break;
                endswitch;
        endswitch;
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên tour là bắt buộc.',
            'start_places_id.required' => 'Điểm khởi hành tour là bắt buộc.',
            'category_type_id.required' => 'Loại mục tour là bắt buộc.',
            'main_category_id.required' => 'Danh mục tour là bắt buộc.',
            'product_category_id.required' => 'Danh mục con là bắt buộc.',
            'description.required' => 'Trích dẫn ngắn là bắt buộc.',
            'schedule.required' => 'Lịch trình tour là bắt buộc.',
            'TimeDetail.required' => 'Lịch trình là bắt buộc.',
        ];
    }
}
