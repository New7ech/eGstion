@extends('ecommerce.layouts.app')

@section('title', $product->name)

@section('content')
<div class="page-inner-ecommerce product-detail-page py-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- Galerie d'images -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="product-gallery">
                        <img src="{{ $product->image_url ?? asset('assets/img/examples/product-default-large.jpg') }}"
                             alt="{{ $product->name }}"
                             class="img-fluid rounded main-product-image"
                             style="max-height: 500px; width: 100%; object-fit: cover;">
                        <!-- Miniatures pour galerie (à implémenter si plusieurs images) -->
                        {{-- <div class="thumbnails mt-3 d-flex justify-content-start">
                            <img src="{{ $product->image_url ?? asset('assets/img/examples/product-default-thumb.jpg') }}" class="img-thumbnail me-2" style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;" onclick="changeMainImage(this.src)">
                            <img src="{{ asset('assets/img/examples/product-default-thumb-2.jpg') }}" class="img-thumbnail me-2" style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;" onclick="changeMainImage(this.src)">
                            </div> --}}
                    </div>
                </div>

                <!-- Détails du produit -->
                <div class="col-md-6">
                    <h1 class="product-title mb-3">{{ $product->name }}</h1>

                    <div class="product-price mb-3">
                        @if($product->prix_promotionnel && $product->prix_promotionnel < $product->prix)
                            <span class="h2 text-danger fw-bold me-2">{{ number_format($product->prix_promotionnel, 2, ',', ' ') }} €</span>
                            <small class="text-muted text-decoration-line-through fs-5">{{ number_format($product->prix, 2, ',', ' ') }} €</small>
                        @else
                            <span class="h2 fw-bold">{{ number_format($product->prix, 2, ',', ' ') }} €</span>
                        @endif
                        <span class="ms-2 text-muted small">TTC</span>
                    </div>

                    <p class="product-stock mb-3">
                        @if($product->quantite > 10)
                            <span class="badge bg-success p-2"><i class="fas fa-check-circle me-1"></i> En stock</span>
                        @elseif($product->quantite > 0 && $product->quantite <=10 )
                            <span class="badge bg-warning text-dark p-2"><i class="fas fa-exclamation-triangle me-1"></i> Stock limité ({{$product->quantite}} restants)</span>
                        @else
                            <span class="badge bg-danger p-2"><i class="fas fa-times-circle me-1"></i> En rupture de stock</span>
                        @endif
                        @if($product->sku)
                            <span class="ms-2 text-muted small">SKU: {{ $product->sku }}</span>
                        @endif
                    </p>

                    <p class="product-short-description text-muted mb-4">
                        {{-- Afficher une description courte ici si disponible, sinon un extrait de la description longue --}}
                        {{ Str::limit($product->description, 150) }}
                    </p>

                    <form action="{{ route('ecommerce.cart.add') }}" method="POST" class="add-to-cart-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="row g-2 align-items-center mb-3">
                            <div class="col-auto">
                                <label for="quantity" class="form-label">Quantité :</label>
                            </div>
                            <div class="col-auto" style="max-width: 100px;">
                                <input type="number" name="quantity" id="quantity" class="form-control text-center" value="1" min="1" {{ $product->quantite <= 0 ? 'disabled' : '' }} max="{{ $product->quantite > 0 ? $product->quantite : 1 }}">
                            </div>
                        </div>
                        @if($product->quantite > 0)
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-cart-plus me-2"></i> Ajouter au panier
                            </button>
                        @else
                            <button type="button" class="btn btn-secondary btn-lg w-100" disabled>
                                <i class="fas fa-times-circle me-2"></i> Indisponible
                            </button>
                        @endif
                    </form>

                    <div class="product-meta mt-4">
                        @if($product->categorie)
                            <p class="mb-1"><strong>Catégorie :</strong> <a href="#">{{ $product->categorie->name }}</a></p>
                        @endif
                        {{-- Tags, etc. pourraient être ajoutés ici --}}
                    </div>
                </div>
            </div>

            <!-- Description longue et autres informations -->
            <div class="row mt-5">
                <div class="col-12">
                    <ul class="nav nav-tabs" id="productTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description Complète</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button" role="tab" aria-controls="specs" aria-selected="false">Caractéristiques</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Avis Clients</button>
                        </li>
                    </ul>
                    <div class="tab-content card p-4" id="productTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                        <div class="tab-pane fade" id="specs" role="tabpanel" aria-labelledby="specs-tab">
                            <p>Les caractéristiques détaillées du produit seront listées ici.</p>
                            <ul>
                                <li>Poids: {{ $product->poids ?? 'N/A' }} kg</li>
                                {{-- Autres caractéristiques --}}
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <p>Les avis des clients apparaîtront ici.</p>
                            {{-- Système d'avis à implémenter --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Produits Recommandés -->
    @if(isset($recommendedProducts) && $recommendedProducts->count() > 0)
    <section class="recommended-products-section mt-5 py-4 bg-light">
        <div class="container">
            <h3 class="mb-4 text-center">Produits Similaires</h3>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach($recommendedProducts as $recommendedProduct)
                    <div class="col">
                        <x-ecommerce.product-card :product="$recommendedProduct" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

</div>
@endsection

@push('styles')
<style>
    .product-detail-page .main-product-image {
        border: 1px solid #ddd;
    }
    .product-detail-page .thumbnails img:hover {
        border-color: var(--bs-primary); /* Utilise la variable Bootstrap pour la couleur primaire */
    }
    /* Style pour les onglets */
    .nav-tabs .nav-link {
        color: #495057;
    }
    .nav-tabs .nav-link.active {
        color: var(--bs-primary);
        border-color: var(--bs-primary) var(--bs-primary) #fff;
    }
    .tab-content {
        border: 1px solid #dee2e6;
        border-top: 0;
    }
</style>
@endpush

@push('scripts')
<script>
    function changeMainImage(src) {
        document.querySelector('.main-product-image').src = src;
    }
</script>
@endpush
