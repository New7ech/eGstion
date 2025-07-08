<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategorieRequest extends FormRequest
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
        // On récupère l'ID de la catégorie depuis la route pour l'ignorer lors de la validation de l'unicité
        $categoryId = $this->route('category') ? $this->route('category')->id : $this->route('categorie.id');

        return [
            'name' => 'required|string|max:255|unique:categories,name,' . $categoryId,
            'description' => 'nullable|string|max:255',
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
            'name.required' => 'Le nom de la catégorie est obligatoire.',
            'name.string' => 'Le nom de la catégorie doit être une chaîne de caractères.',
            'name.max' => 'Le nom de la catégorie ne doit pas dépasser 255 caractères.',
            'name.unique' => 'Ce nom de catégorie existe déjà.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'description.max' => 'La description ne doit pas dépasser 255 caractères.',
        ];
    }
}
