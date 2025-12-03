<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'selected_due_day' => 'required',
            'selected_invoice_for_attention' => 'required',
            'selected_category' => 'required',
            'selected_user' => 'required',
            'selected_region' => 'required',
            'selected_country' => 'required',
            'selected_city' => 'required',
            'selected_currency' => 'required',
            'selected_frequency' => ['required', Rule::in(['Monthly', 'Quarterly'])],
            'lease_no' => ['nullable', 'string', 'max:50'],
            'amount' => ['required', 'formatted_number'],
        ];
    }
}
