<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentDonasiRequest extends FormRequest
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
            'donasi_id' => [$this->method() === 'post' ? 'required' : '', 'exists:donasis,id'],
            'name' => [$this->method() === 'post' ? 'required' : '', 'string', 'min:3', 'max:255'],
            'email' => [$this->method() === 'post' ? 'required' : '', 'email'],
            'phone' => ['required', 'min_digits:11'],
            'pesan' => [$this->method() === 'post' ? 'required' : '', 'string', 'min:3', 'max:255'],
            'amount' => [$this->method() === 'post' ? 'required' : '', 'numeric', 'min_digits:5', 'min:10000'],
        ];
    }
}
