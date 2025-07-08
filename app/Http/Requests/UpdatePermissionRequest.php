<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
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
        $permissionId = $this->route('permission') ? $this->route('permission')->id : null;

        return [
            'name' => 'required|string|max:255|unique:permissions,name,' . $permissionId,
            // 'guard_name' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Le nom de la permission est obligatoire.',
            'name.string' => 'Le nom de la permission doit être une chaîne de caractères.',
            'name.max' => 'Le nom de la permission ne doit pas dépasser 255 caractères.',
            'name.unique' => 'Ce nom de permission existe déjà.',
        ];
    }
}
