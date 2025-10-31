<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'due_day_id' => 'required',
            'invoice_for_attention_id' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'region_id' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
        ];
    }
}
