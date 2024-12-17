<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonasiRequest extends FormRequest
{
    // 'foto',
    //     'category_id',
    //     'user_id',
    //     'name',
    //     'slug_donasis',
    //     'description',
    //     'tanggal_batas_donasi',
    //     'jumlah_target_dana',
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
            'foto' => [$this->method() === 'post' ? 'required' : '', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'name' => [$this->method() === 'post' ? 'required' : '', 'string', 'min:3', 'max:255'],
            'description' => [$this->method() === 'post' ? 'required' : '', 'string', 'min:3'],
            'category_id' => [$this->method() === 'post' ? 'required' : '', 'exists:categories,id'],
            'tanggal_batas_donasi' => [$this->method() === 'post' ? 'required' : '', 'date'],
            'jumlah_target_dana' => [$this->method() === 'post' ? 'required' : '', 'numeric', 'min_digits:5']
        ];
    }
}
