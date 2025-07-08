@extends('ecommerce.layouts.app')

@section('title', 'Catalogue Produits')

@section('content')
<div class="page-inner-ecommerce catalog-page py-5">
    <div class="container">
        <div class="row">
            <!-- Barre latérale des filtres -->
            <div class="col-lg-3">
                <x-ecommerce.filter-sidebar :categories="$categories" />
            </div>

            <!-- Grille des produits -->
            <div class="col-lg-9">
                <h1 class="mb-4">Catalogue des Produits</h1>

                {{-- Affichage du nombre de résultats et des filtres actifs (optionnel) --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">
                        @if($products->total() > 0)
                            Affichage de {{ $products->firstItem() }} à {{ $products->lastItem() }} sur {{ $products->total() }} produits
                        @else
                            Aucun produit trouvé.
                        @endif
                    </span>
                    {{-- Ici, on pourrait ajouter des options de tri si non gérées dans la sidebar --}}
                </div>

                @if($products->count() > 0)
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                        @foreach($products as $product)
                            <div class="col">
                                <x-ecommerce.product-card :product="$product" />
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $products->appends(request()->query())->links() }} {{-- appends pour conserver les paramètres de filtre dans la pagination --}}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4>Aucun produit ne correspond à vos critères.</h4>
                        <p class="text-muted">Essayez d'ajuster vos filtres ou de <a href="{{ route('ecommerce.products.filter') }}">réinitialiser la recherche</a>.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .catalog-page .filter-sidebar {
        position: sticky;
        top: 80px; /* Ajustez en fonction de la hauteur de votre header fixe */
    }
</style>
@endpush
