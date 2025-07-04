<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'productName' => 'required',
            'shortDescription' => 'required',
            'company' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric|regex:/^\d{1,6}(\.\d{1,2})?$/',
            'stock' => 'required|numeric|max:100000',
            'address' => 'required|max:255',
            'website' => 'required|url|max:255',
            'email' => 'required|email',
            'priority' => 'required|integer|min:1',
            'remember' => 'boolean',
            'profile_photo_path' => $this->hasFile('profile_photo_path') ? 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'nullable|string|max:255',

        ];
    }
}
