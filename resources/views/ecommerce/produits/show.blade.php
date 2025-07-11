@extends('ecommerce.layouts.app') {{-- Assurez-vous que ce layout existe --}}

@section('title', $produit->name ?? 'Détail du Produit')

@section('content')
<main class="page-inner-ecommerce product-detail-page section-padding">
    <div class="container">
        @if(isset($produit) && $produit)
            <div class="row">
                <!-- Colonne de l'image du produit -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="product-image-gallery">
                        {{-- Image principale --}}
                        <img src="{{ $produit->image_url ?? 'https://picsum.photos/seed/product_placeholder/800/600' }}"
                             alt="Image de {{ $produit->name ?? 'produit' }}"
                             class="img-fluid rounded product-main-image">
                        {{-- Vignettes pour images supplémentaires (si disponibles) --}}
                        {{-- <div class="product-thumbnails mt-3 d-flex">
                            <img src="..." class="img-thumbnail me-2" style="width: 80px; height: 80px; object-fit: cover;" alt="Vignette 1">
                            <img src="..." class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;" alt="Vignette 2">
                        </div> --}}
                    </div>
                </div>

                <!-- Colonne des informations du produit et actions -->
                <div class="col-md-6">
                    <div class="product-info">
                        <h1 class="product-title mb-3">{{ $produit->name ?? 'Nom du Produit Indisponible' }}</h1>

                        @if(isset($produit->category_name) && $produit->category_name)
                            <p class="product-category text-muted">
                                Catégorie :
                                {{-- Lien vers la catégorie si la route existe et est configurée --}}
                                {{-- <a href="{{ route('ecommerce.categories.show', ['slug' => $produit->category_slug ?? $produit->category_name]) }}">{{ $produit->category_name }}</a> --}}
                                {{ $produit->category_name }}
                            </p>
                        @endif

                        <p class="product-price h3 mb-3">{{ number_format($produit->price ?? 0, 2, ',', ' ') }} €</p>

                        <div class="product-description mb-4">
                            <h5 class="mb-2">Description :</h5>
                            <p>{{ $produit->description ?? 'Aucune description disponible pour ce produit.' }}</p>
                        </div>

                        {{-- Formulaire d'ajout au panier --}}
                        <form action="{{ route('ecommerce.panier.ajouter') }}" method="POST" class="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $produit->id }}">
                            <div class="row g-2 align-items-center mb-3">
                                <div class="col-auto">
                                    <label for="quantity" class="form-label">Quantité :</label>
                                </div>
                                <div class="col-auto">
                                    <input type="number" name="quantity" id="quantity" class="form-control form-control-sm" value="1" min="1" style="width: 70px;">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-shopping-cart me-2"></i> Ajouter au Panier
                            </button>
                        </form>

                        {{-- Autres informations ou actions --}}
                        {{-- <div class="product-meta mt-4">
                            <p><span class="fw-bold">UGS :</span> {{ $produit->sku ?? 'N/A' }}</p>
                            <p><span class="fw-bold">Disponibilité :</span>
                                @if(isset($produit->stock) && $produit->stock > 0)
                                    En stock
                                @else
                                    Épuisé
                                @endif
                            </p>
                        </div> --}}
                    </div>
                </div>
            </div>

            {{-- Section pour produits similaires ou recommandés (optionnel) --}}
            {{-- <section class="related-products-section mt-5 pt-5 border-top">
                <h3 class="text-center mb-4">Produits Similaires</h3>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="col">
                            <div class="card product-card h-100">
                                <a href="#"> <img src="https://picsum.photos/seed/related{{$i}}/400/300" class="card-img-top" alt="Produit Similaire"></a>
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#">Nom Produit Similaire {{$i+1}}</a></h5>
                                    <p class="card-text product-price">19,99 €</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </section> --}}

        @else
            <div class="alert alert-warning text-center" role="alert">
                Le produit que vous recherchez n'a pas été trouvé ou n'est plus disponible.
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('ecommerce.produits.index') }}" class="btn btn-secondary">Retourner au catalogue</a>
            </div>
        @endif
    </div>
</main>
@endsection

@push('scripts')
<script>
    document.querySelector('form.add-to-cart-form')?.addEventListener('submit', function(e) {
        // e.preventDefault(); // Décommenter pour gérer en full JS
        // alert('Produit ajouté au panier! (Simulation côté client pour la page détail)');
        // this.submit(); // Soumettre manuellement si preventDefault est utilisé
    });
</script>
@endpush
