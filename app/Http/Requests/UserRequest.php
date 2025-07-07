<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; 
        // Puedes agregar lógica de autorización aquí si es necesario
        // Por ahora, permitimos que todos los usuarios hagan esta solicitud
        // return $this->user()->can('create', User::class); // Ejemplo de autorización
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [ 
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'string|max:255',
            'city' => 'string|max:100',
            'state' => 'string|max:100',
            'country' => 'string|max:100',
            'zip_code' => 'string|max:20',
            'company' => 'string|max:255',
            'profile_photo_path' => $this->hasFile('profile_photo_path') ? 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'nullable|string|max:255',
            'role_id' => 'required|integer|exists:roles,id',
        ];

        if ($this->input('id')) {
            // $rules['password'] = 'nullable|string|min:8|confirmed';
            $rules['username'] = 'required|string|max:255|present_unless:users,username';
            $rules['email'] = 'required|string|email|max:255|present_unless:users,email';
        } else {
            $rules['username'] = 'required|string|max:255|unique:users,username';
            $rules['email'] = 'required|string|email|max:255|unique:users,email';
            // $rules['password'] = 'required|string|min:8|confirmed';
            //'password' => 'required|string|min:8|confirmed|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
        }
        return $rules;
    }
}
