@props(['product'])

<div class="card h-100 product-card">
    {{-- Lien vers la page de détail du produit. Utilise la route 'ecommerce.produits.show'. --}}
    <a href="{{ route('ecommerce.produits.show', ['slug' => $product->slug]) }}">
        <img src="{{ $product->image_url ?? asset('assets/img/examples/product-default.jpg') }}" class="card-img-top" alt="{{ $product->name ?? 'Image du produit' }}">
    </a>
    <div class="card-body d-flex flex-column">
        <h5 class="card-title">
            {{-- Lien vers la page de détail du produit. --}}
            <a href="{{ route('ecommerce.produits.show', ['slug' => $product->slug]) }}" class="text-dark text-decoration-none">{{ Str::limit($product->name ?? 'Produit sans nom', 50) }}</a>
        </h5>
        <p class="card-text text-muted small">{{ Str::limit($product->description ?? 'Pas de description.', 70) }}</p>

        <div class="mt-auto">
            <div class="d-flex justify-content-between align-items-center mb-2">
                {{-- Gestion de l'affichage du prix (normal ou promotionnel) --}}
                @if(isset($product->prix_promotionnel) && $product->prix_promotionnel < ($product->prix ?? $product->price))
                    <div>
                        <span class="text-danger fw-bold fs-5">{{ number_format($product->prix_promotionnel, 2, ',', ' ') }} €</span>
                        <small class="text-muted text-decoration-line-through ms-1">{{ number_format($product->prix ?? $product->price, 2, ',', ' ') }} €</small>
                    </div>
                @else
                    <span class="fw-bold fs-5">{{ number_format($product->prix ?? $product->price ?? 0, 2, ',', ' ') }} €</span>
                @endif

                {{-- Affichage du statut du stock --}}
                @if(isset($product->quantite) && $product->quantite > 0)
                    <span class="badge bg-success">En Stock</span>
                @else
                    <span class="badge bg-danger">Rupture</span>
                @endif
            </div>

            {{-- Formulaire pour ajouter le produit au panier. Utilise la route 'ecommerce.panier.ajouter'. --}}
            {{-- Cette route a été définie pour pointer vers PanierController@ajouter. --}}
            <form action="{{ route('ecommerce.panier.ajouter') }}" method="POST" class="form-add-to-cart">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1"> {{-- Quantité par défaut à 1 --}}

                {{-- Le bouton est activé ou désactivé en fonction de la disponibilité du produit --}}
                @if(isset($product->quantite) && $product->quantite > 0)
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="fas fa-cart-plus me-1"></i> Ajouter au panier
                    </button>
                @else
                    <button type="button" class="btn btn-secondary btn-sm w-100" disabled>
                        <i class="fas fa-times-circle me-1"></i> Indisponible
                    </button>
                @endif
            </form>
        </div>
    </div>
</div>

{{-- Styles optionnels spécifiques à la product-card, pourraient être dans ecommerce.css --}}
@push('styles')
<style>
.product-card {
    transition: transform .2s ease-out, box-shadow .2s ease-out;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.product-card .card-img-top {
    max-height: 200px; /* Ajustez selon vos besoins */
    object-fit: cover; /* ou 'contain' selon le type d'images */
}
</style>
@endpush
