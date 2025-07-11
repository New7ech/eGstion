@extends('ecommerce.layouts.app') {{-- Assurez-vous que ce layout existe et est configuré --}}

@section('title', 'Tous nos Produits')

@section('content')
<main class="page-inner-ecommerce products-page section-padding">
    <div class="container">
        <header class="section-header text-center mb-5">
            <h1 class="section-title">Catalogue des Produits</h1>
            <p class="section-tagline">Parcourez notre collection complète.</p>
        </header>

        @if(isset($produits) && $produits->count() > 0)
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 product-grid">
                @foreach($produits as $produit)
                    <div class="col product-grid-item">
                        {{-- Utilisation du composant product-card s'il existe et est adapté --}}
                        {{-- Sinon, structure HTML directe pour la carte produit --}}
                        <div class="card product-card h-100">
                            @if(isset($produit->image_url))
                                <a href="{{ route('ecommerce.produits.show', ['slug' => $produit->slug]) }}">
                                    <img src="{{ $produit->image_url }}" class="card-img-top" alt="{{ $produit->name ?? 'Image du produit' }}">
                                </a>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">
                                    <a href="{{ route('ecommerce.produits.show', ['slug' => $produit->slug]) }}">{{ $produit->name ?? 'Nom du produit' }}</a>
                                </h5>
                                <p class="card-text product-price mb-3">
                                    {{ number_format($produit->price ?? 0, 2, ',', ' ') }} €
                                </p>
                                {{-- Formulaire pour ajouter au panier --}}
                                <form action="{{ route('ecommerce.panier.ajouter') }}" method="POST" class="mt-auto">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $produit->id }}">
                                    <button type="submit" class="btn btn-primary w-100">Ajouter au Panier</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center">Aucun produit à afficher pour le moment.</p>
        @endif

        {{-- Pagination des produits si disponible --}}
        {{-- @if(isset($produits) && $produits instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="mt-5 d-flex justify-content-center">
                {{ $produits->links() }}
            </div>
        @endif --}}
    </div>
</main>
@endsection

@push('styles')
{{-- <link rel="stylesheet" href="{{ asset('assets/css/custom-products-page.css') }}"> --}}
@endpush

@push('scripts')
<script>
    // Scripts spécifiques pour la page catalogue si nécessaire
    document.querySelectorAll('form[action="{{ route('ecommerce.panier.ajouter') }}"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            // Optionnel: Empêcher la soumission multiple ou afficher un indicateur de chargement
            // Pour la consigne JS simple:
            // e.preventDefault(); // Si on voulait gérer en full JS sans rechargement
            // alert('Produit ajouté au panier! (Simulation côté client)');
            // this.submit(); // Soumettre manuellement si preventDefault est utilisé
        });
    });
</script>
@endpush
