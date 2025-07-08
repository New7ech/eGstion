<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'prix_promotionnel' => 'nullable|numeric|min:0|lt:prix',
            'quantite' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'fournisseur_id' => 'nullable|exists:fournisseurs,id',
            'emplacement_id' => 'nullable|exists:emplacements,id',
            'sku' => 'nullable|string|max:100|unique:articles,sku',
            'image_principale' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Modifié pour l'upload d'image
            'statut' => 'nullable|string|in:disponible,brouillon,archivé,en_rupture_de_stock',
            'poids' => 'nullable|numeric|min:0',
            'slug' => 'nullable|string|max:255|unique:articles,slug',
            'est_visible' => 'nullable|boolean',
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
            'name.required' => "Le nom de l'article est obligatoire.",
            'name.string' => "Le nom de l'article doit être une chaîne de caractères.",
            'name.max' => "Le nom de l'article ne doit pas dépasser 255 caractères.",
            'description.string' => "La description de l'article doit être une chaîne de caractères.",
            'prix.required' => "Le prix de l'article est obligatoire.",
            'prix.numeric' => "Le prix de l'article doit être un nombre.",
            'prix.min' => "Le prix de l'article ne peut pas être négatif.",
            'prix_promotionnel.numeric' => "Le prix promotionnel doit être un nombre.",
            'prix_promotionnel.min' => "Le prix promotionnel ne peut pas être négatif.",
            'prix_promotionnel.lt' => "Le prix promotionnel doit être inférieur au prix normal.",
            'quantite.required' => "La quantité de l'article est obligatoire.",
            'quantite.integer' => "La quantité de l'article doit être un nombre entier.",
            'quantite.min' => "La quantité de l'article ne peut pas être négative.",
            'category_id.exists' => "La catégorie sélectionnée n'est pas valide.",
            'fournisseur_id.exists' => "Le fournisseur sélectionné n'est pas valide.",
            'emplacement_id.exists' => "L'emplacement sélectionné n'est pas valide.",
            'sku.string' => "Le SKU doit être une chaîne de caractères.",
            'sku.max' => "Le SKU ne doit pas dépasser 100 caractères.",
            'sku.unique' => "Ce SKU existe déjà.",
            'image_principale.image' => "Le fichier doit être une image.",
            'image_principale.mimes' => "L'image doit être de type : jpeg, png, jpg, gif, svg, webp.",
            'image_principale.max' => "L'image ne doit pas dépasser 2Mo (2048 Ko).",
            'statut.string' => "Le statut doit être une chaîne de caractères.",
            'statut.in' => "Le statut sélectionné n'est pas valide.",
            'poids.numeric' => "Le poids doit être un nombre.",
            'poids.min' => "Le poids ne peut pas être négatif.",
            'slug.string' => "Le slug doit être une chaîne de caractères.",
            'slug.max' => "Le slug ne doit pas dépasser 255 caractères.",
            'slug.unique' => "Ce slug existe déjà.",
            'est_visible.boolean' => "La valeur du champ 'est visible' doit être vraie ou fausse.",
        ];
    }
}
