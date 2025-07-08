<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // TODO: Autorisation : L'utilisateur peut-il modifier cet utilisateur spécifique ? (lui-même ou admin)
        return true; // Pour l'instant, ouvert
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user') ? $this->route('user')->id : null;

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
            'password' => ['nullable', 'confirmed', Password::defaults()], // Mot de passe optionnel à la mise à jour
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'nullable|string|max:20|unique:users,phone,' . $userId,
            'address' => 'nullable|string|max:255',
            'birthdate' => 'nullable|date',
            // 'roles' => 'nullable|array',
            // 'roles.*' => 'exists:roles,id'
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
            'name.required' => "Le nom de l'utilisateur est obligatoire.",
            'email.required' => "L'adresse e-mail est obligatoire.",
            'email.email' => "L'adresse e-mail n'est pas valide.",
            'email.unique' => "Cette adresse e-mail est déjà utilisée.",
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'photo.image' => 'Le fichier doit être une image.',
            'photo.mimes' => 'La photo doit être de type : jpeg, png, jpg, gif.',
            'photo.max' => 'La photo ne doit pas dépasser 2Mo.',
            'phone.max' => 'Le numéro de téléphone ne doit pas dépasser 20 caractères.',
            'phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',
            'birthdate.date' => 'La date de naissance n\'est pas une date valide.',
        ];
    }
}
