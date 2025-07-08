<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role; // Keep this if you need Role model for other purposes, though not strictly for rules here

class UpdateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // TODO: Ajouter une logique d'autorisation si nécessaire
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $roleId = $this->route('role') ? $this->route('role')->id : null;

        return [
            'name' => 'required|string|max:255|unique:roles,name,' . $roleId,
            'permissions' => 'nullable|array',
            'permissions.*' => 'integer|exists:permissions,id',
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
