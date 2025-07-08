@extends('ecommerce.layouts.app')

@section('title', 'Accueil Boutique')

@section('content')
<div class="page-inner-ecommerce">

    <!-- Bannière Principale -->
    <section class="banner-section mb-5">
        <div class="card text-white">
            <img src="{{ asset('assets/img/examples/ecommerce-banner.jpg') }}" class="card-img" alt="Bannière principale" style="max-height: 400px; object-fit: cover;">
            <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center" style="background-color: rgba(0,0,0,0.4);">
                <h1 class="display-4 card-title">Découvrez nos Nouveautés</h1>
                <p class="lead card-text">Des produits de qualité exceptionnelle vous attendent.</p>
                <a href="#" class="btn btn-primary btn-lg mt-3">Achetez Maintenant</a>
            </div>
        </div>
    </section>

    <!-- Section Filtres (simplifiée pour l'instant) -->
    {{-- <section class="filters-section mb-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('ecommerce.products.filter') }}" method="GET">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-3">
                            <label for="category_filter" class="form-label">Catégorie</label>
                            <select name="category" id="category_filter" class="form-select">
                                <option value="">Toutes</option>
                                @foreach(\App\Models\Categorie::orderBy('name')->get() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="price_filter" class="form-label">Prix Max</label>
                            <input type="number" name="max_price" id="price_filter" class="form-control" placeholder="ex: 500">
                        </div>
                        <div class="col-md-3">
                            <label for="sort_by_filter" class="form-label">Trier par</label>
                            <select name="sort_by" id="sort_by_filter" class="form-select">
                                <option value="newest">Nouveautés</option>
                                <option value="price_asc">Prix Croissant</option>
                                <option value="price_desc">Prix Décroissant</option>
                                <option value="name_asc">Nom A-Z</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-info w-100">Filtrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section> --}}


    <!-- Grille de présentation de produits (Principale) -->
    <section class="products-grid-section mb-5">
        <h2 class="mb-4 text-center">Nos Produits</h2>
        @if(isset($products) && $products->count() > 0)
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach($products as $product)
                    <div class="col">
                        <x-ecommerce.product-card :product="$product" />
                    </div>
                @endforeach
            </div>
            <div class="mt-4 d-flex justify-content-center">
                {{ $products->links() }} <!-- Pagination -->
            </div>
        @else
            <p class="text-center text-muted">Aucun produit à afficher pour le moment.</p>
        @endif
    </section>

    <!-- Section Nouveautés -->
    @if(isset($newProducts) && $newProducts->count() > 0)
    <section class="new-products-section mb-5">
        <h2 class="mb-4 text-center">Nouveautés</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($newProducts as $product)
                <div class="col">
                    <x-ecommerce.product-card :product="$product" />
                </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Section Produits Populaires -->
    @if(isset($popularProducts) && $popularProducts->count() > 0)
    <section class="popular-products-section mb-5">
        <h2 class="mb-4 text-center">Produits Populaires</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($popularProducts as $product)
                <div class="col">
                    <x-ecommerce.product-card :product="$product" />
                </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Section Promotions -->
    @if(isset($promotionalProducts) && $promotionalProducts->count() > 0)
    <section class="promotional-products-section mb-5">
        <h2 class="mb-4 text-center">Promotions</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($promotionalProducts as $product)
                <div class="col">
                    <x-ecommerce.product-card :product="$product" />
                </div>
            @endforeach
        </div>
    </section>
    @endif

</div>
@endsection

@push('styles')
<style>
    .banner-section .card-img-overlay h1,
    .banner-section .card-img-overlay .lead {
        text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
    }
    .page-inner-ecommerce {
        padding-top: 20px; /* Un peu d'espace après le header fixe */
        padding-bottom: 20px;
    }
</style>
@endpush

@push('scripts')
    {{-- Scripts spécifiques à la page d'accueil si besoin --}}
@endpush
