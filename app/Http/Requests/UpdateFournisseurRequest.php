<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFournisseurRequest extends FormRequest
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
        $fournisseurId = $this->route('fournisseur') ? $this->route('fournisseur')->id : null;

        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'nom_entreprise' => 'nullable|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20|unique:fournisseurs,telephone,' . $fournisseurId,
            'email' => 'nullable|email|max:255|unique:fournisseurs,email,' . $fournisseurId,
            'ville' => 'nullable|string|max:100',
            'pays' => 'nullable|string|max:100',
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
            'name.required' => 'Le nom du fournisseur est obligatoire.',
            'name.max' => 'Le nom du fournisseur ne doit pas dépasser 255 caractères.',
            'description.max' => 'La description ne doit pas dépasser 1000 caractères.',
            'nom_entreprise.max' => "Le nom de l'entreprise ne doit pas dépasser 255 caractères.",
            'adresse.max' => "L'adresse ne doit pas dépasser 255 caractères.",
            'telephone.max' => 'Le numéro de téléphone ne doit pas dépasser 20 caractères.',
            'telephone.unique' => 'Ce numéro de téléphone est déjà utilisé par un autre fournisseur.',
            'email.email' => "L'adresse e-mail n'est pas valide.",
            'email.max' => "L'adresse e-mail ne doit pas dépasser 255 caractères.",
            'email.unique' => 'Cette adresse e-mail est déjà utilisée par un autre fournisseur.',
            'ville.max' => 'Le nom de la ville ne doit pas dépasser 100 caractères.',
            'pays.max' => 'Le nom du pays ne doit pas dépasser 100 caractères.',
        ];
    }
}
