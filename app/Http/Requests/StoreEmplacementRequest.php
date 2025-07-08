<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmplacementRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:emplacements,name',
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
            'name.required' => "Le nom de l'emplacement est obligatoire.",
            'name.string' => "Le nom de l'emplacement doit être une chaîne de caractères.",
            'name.max' => "Le nom de l'emplacement ne doit pas dépasser 255 caractères.",
            'name.unique' => "Ce nom d'emplacement existe déjà.",
            'description.string' => 'La description doit être une chaîne de caractères.',
            'description.max' => 'La description ne doit pas dépasser 255 caractères.',
        ];
    }
}
