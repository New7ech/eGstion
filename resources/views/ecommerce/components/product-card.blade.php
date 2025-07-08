@props(['product'])

<div class="card h-100 product-card">
    <a href="{{ route('ecommerce.product.show', $product->slug) }}">
        <img src="{{ $product->image_url ?? asset('assets/img/examples/product-default.jpg') }}" class="card-img-top" alt="{{ $product->name }}">
    </a>
    <div class="card-body d-flex flex-column">
        <h5 class="card-title">
            <a href="{{ route('ecommerce.product.show', $product->slug) }}" class="text-dark text-decoration-none">{{ Str::limit($product->name, 50) }}</a>
        </h5>
        <p class="card-text text-muted small">{{ Str::limit($product->description, 70) }}</p>

        <div class="mt-auto">
            <div class="d-flex justify-content-between align-items-center mb-2">
                @if($product->prix_promotionnel && $product->prix_promotionnel < $product->prix)
                    <div>
                        <span class="text-danger fw-bold fs-5">{{ number_format($product->prix_promotionnel, 2, ',', ' ') }} €</span>
                        <small class="text-muted text-decoration-line-through ms-1">{{ number_format($product->prix, 2, ',', ' ') }} €</small>
                    </div>
                @else
                    <span class="fw-bold fs-5">{{ number_format($product->prix, 2, ',', ' ') }} €</span>
                @endif

                @if($product->quantite > 0)
                    <span class="badge bg-success">En Stock</span>
                @else
                    <span class="badge bg-danger">Rupture</span>
                @endif
            </div>

            <form action="{{ route('ecommerce.cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                @if($product->quantite > 0)
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
