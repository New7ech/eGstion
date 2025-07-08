<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'integer|exists:permissions,id', // S'assurer que chaque permission est un ID existant
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
            'name.required' => 'Le nom du rôle est obligatoire.',
            'name.string' => 'Le nom du rôle doit être une chaîne de caractères.',
            'name.max' => 'Le nom du rôle ne doit pas dépasser 255 caractères.',
            'name.unique' => 'Ce nom de rôle existe déjà.',
            'permissions.array' => 'Les permissions doivent être fournies sous forme de tableau.',
            'permissions.*.integer' => 'Chaque permission doit être un identifiant numérique.',
            'permissions.*.exists' => 'Une ou plusieurs permissions sélectionnées n\'existent pas.',
        ];
    }
}
