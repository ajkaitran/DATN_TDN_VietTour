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
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'product_category_id' => 'required',
            'active' => 'required',
            'price1' => 'required',
            'price2' => 'required',
            'price3' => 'required',
            'price4' => 'required',
            'price5' => 'required',
            'original_price' => 'required',
            'dat_coc' => 'required',
            'do_tuoi_tre_em' => 'required',
            'do_tuoi_tre_nho' => 'required',
            'do_tuoi_em_be' => 'required',
            'tieu_de_phu_thu' => 'required',
            'product_code' => 'required',
            'time' => 'required',
            'active' => 'required',
            'gift' => 'required',
            'gift_note',
            'slot' => 'required',
            'url' => 'required',
            'url_book_tour' => 'required',
            'email' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên tour là bắt buộc.',
            'description.required' => 'Mô tả tour là bắt buộc.',
            'product_category_id.required' => 'Danh sách tour là bắt buộc.',
            'active.required' => 'Trang thai tour là bắt buộc.',
            'price1.required' => 'Giá 1 tour là bắt buộc.',
            'price2.required' => 'Giá 2 tour là bắt buộc.',
            'price3.required' => 'Giá 3 tour là bắt buộc.',
            'price4.required' => 'Giá 4 tour là bắt buộc.',
            'price5.required' => 'Giá 5 tour là bắt buộc.',
            'original_price.required' => 'Giá gốc tour là bắt buộc.',
            'dat_coc.required' => 'Dat coc tour là bắt buộc.',
            'do_tuoi_tre_em.required' => 'Do tuoi tre em tour là bắt buộc.',
            'do_tuoi_tre_nho.required' => 'Do tuoi tre nho tour là bắt buộc.',
            'do_tuoi_em_be.required' => 'Do tuoi em be tour là bắt buộc.',
            'tieu_de_phu_thu.required' => 'Tieu de phu thu tour là bắt buộc.',
            'product_code.required' => 'Ma tour là bắt buộc.',
            'time.required' => 'Thoi gian tour là bắt buộc.',
            'active.required' => 'Trang thai tour là bắt buộc.',
            'gift.required' => 'Phuong thuc phat tour là bắt buộc.',
            'gift_note.required' => 'Phuong thuc phat tour là bắt buộc.',
            'slot.required' => 'Slot tour là bắt buộc.',
            'url.required' => 'Url tour là bắt buộc.',
            'url_book_tour.required' => 'Url book tour là bắt buộc.',
            'email.required' => 'Email tour là bắt buộc.',
        ];
    }
}
