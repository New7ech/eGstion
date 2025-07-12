@extends('ecommerce.layouts.app') {{-- Assurez-vous que ce layout existe --}}

@section('title', 'Catégorie : ' . ($categorie->nom ?? 'Inconnue'))

@section('content')
<main class="page-inner-ecommerce category-products-page section-padding">
    <div class="container">
        <header class="section-header text-center mb-5">
            @if(isset($categorie) && $categorie)
                <h1 class="section-title">Produits de la catégorie : <span class="text-primary">{{ $categorie->nom }}</span></h1>
                @if($categorie->description)
                    <p class="section-tagline">{{ $categorie->description }}</p>
                @endif
            @else
                <h1 class="section-title">Catégorie non trouvée</h1>
            @endif
        </header>

        @if(isset($categorie) && $categorie)
            @if(isset($produits) && $produits->count() > 0)
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 product-grid">
                    @foreach($produits as $produit)
                        <div class="col product-grid-item">
                            {{-- Idéalement, utiliser un composant Blade pour la carte produit si disponible --}}
                            {{-- <x-ecommerce.product-card :product="$produit" /> --}}
                            <div class="card product-card h-100">
                                @if(isset($produit->image_url))
                                    <a href="{{ route('ecommerce.articles.show', ['slug' => $produit->slug]) }}">
                                        <img src="{{ $produit->image_url }}" class="card-img-top" alt="{{ $produit->name ?? 'Image du produit' }}">
                                    </a>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">
                                        <a href="{{ route('ecommerce.articles.show', ['slug' => $produit->slug]) }}">{{ $produit->name ?? 'Nom du produit' }}</a>
                                    </h5>
                                    {{-- Afficher le nom de la catégorie si différent ou pour confirmation --}}
                                    {{-- <p class="card-subtitle mb-2 text-muted">{{ $produit->category_name ?? $categorie->nom }}</p> --}}
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

                {{-- Pagination des produits si disponible --}}
                {{-- @if($produits instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $produits->links() }}
                    </div>
                @endif --}}

            @else
                <div class="alert alert-info text-center" role="alert">
                    <i class="fas fa-info-circle fa-2x me-2 align-middle"></i>
                    Aucun produit n'a été trouvé dans cette catégorie pour le moment.
                </div>
            @endif
        @else
            <div class="alert alert-danger text-center" role="alert">
                La catégorie que vous essayez de visualiser n'existe pas ou n'est plus disponible.
            </div>
        @endif

        <div class="text-center mt-5">
            <a href="{{ route('ecommerce.articles.index') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-th-list me-2"></i> Voir tous les articles
            </a>
            <a href="{{ route('ecommerce.home') }}" class="btn btn-outline-primary">
                <i class="fas fa-home me-2"></i> Retour à l'accueil de la boutique
            </a>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    // Scripts spécifiques pour la page catégorie si nécessaire
    // Par exemple, pour gérer les filtres ou le tri côté client (non demandé ici)
    document.querySelectorAll('form[action="{{ route('ecommerce.panier.ajouter') }}"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            // Optionnel: animation ou retour visuel avant la redirection
            // alert('Ajout au panier depuis la page catégorie (Simulation JS)');
        });
    });
</script>
@endpush
