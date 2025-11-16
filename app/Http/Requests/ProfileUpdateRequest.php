<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:1', 'max:14'],
            'phone_normalized' => ['required', 'phone:INTERNATIONAL'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'password' => ['nullable', 'string'],
            'new_password' => [
                'nullable',
                'string',
                'min:8',
                'max:64',
                'different:password',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            'confirm_new_password' => ['nullable', 'string']
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if(!$this->filled('phone_normalized')){
                $validator->errors()->add('phone', 'The phone format is invalid.');
            }
            if ($this->filled('password')) {
                if (!Hash::check($this->input('password'), Auth::user()->password)) {
                    $validator->errors()->add('password', 'The old password is incorrect.');
                }
                if(!$this->filled('new_password')){
                    $validator->errors()->add('new_password', 'New password is required.');
                }
                if(!$this->filled('confirm_new_password')){
                    $validator->errors()->add('confirm_new_password', 'Confirm password is required.');
                }
            }
            if ($this->filled('confirm_new_password')) {
                if ($this->input('new_password') !== $this->input('confirm_new_password')) {
                    $validator->errors()->add('confirm_new_password', 'Password confirmation failed.');
                }
            }
        });
    }
}
