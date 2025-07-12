{{--
  Composant: ArticleCard
  Description: Affiche une carte pour un article de la boutique.
  Props:
    - article (object): L'objet Article (modèle Eloquent)
--}}

@props(['article'])

<div class="card article-card h-100 shadow-sm">
    <div class="position-relative">
        {{-- Image de l'article --}}
        <a href="{{ route('ecommerce.articles.show', ['slug' => $article->slug]) }}">
            {{-- Utilisation de l'accessor getImageUrlAttribute() du modèle Article --}}
            <img src="{{ $article->image_url ?? asset('assets/img/examples/product_placeholder.jpg') }}"
                 alt="Image de {{ $article->name }}"
                 class="card-img-top article-card-img">
        </a>

        {{-- Badge de promotion si le prix promotionnel est actif --}}
        @if($article->prix_promotionnel && $article->prix_promotionnel < $article->prix)
            <span class="badge bg-danger position-absolute top-0 start-0 m-2">PROMO</span>
        @endif
    </div>

    <div class="card-body d-flex flex-column">
        {{-- Catégorie de l'article --}}
        @if($article->categorie)
            <p class="card-text text-muted small mb-1">{{ $article->categorie->nom }}</p>
        @endif

        {{-- Nom de l'article --}}
        <h5 class="card-title fs-6 fw-medium mb-2 flex-grow-1">
            <a href="{{ route('ecommerce.articles.show', ['slug' => $article->slug]) }}" class="text-dark text-decoration-none article-title-link">
                {{ $article->name }}
            </a>
        </h5>

        {{-- Prix de l'article --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
             @if($article->prix_promotionnel && $article->prix_promotionnel < $article->prix)
                <p class="card-text fs-5 fw-bold mb-0 text-danger">
                    {{ number_format($article->prix_promotionnel, 2, ',', ' ') }} €
                </p>
                <p class="card-text text-muted text-decoration-line-through small mb-0 ms-2">
                    {{ number_format($article->prix, 2, ',', ' ') }} €
                </p>
            @else
                <p class="card-text fs-5 fw-bold mb-0 text-primary">
                    {{ number_format($article->prix, 2, ',', ' ') }} €
                </p>
            @endif
        </div>

        {{-- Formulaire d'ajout au panier --}}
        <div class="mt-auto">
            @if($article->quantite > 0)
                <form action="{{ route('ecommerce.panier.ajouter') }}" method="POST">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-shopping-cart me-1"></i> Ajouter au panier
                    </button>
                </form>
            @else
                <button type="button" class="btn btn-secondary w-100" disabled>
                    <i class="fas fa-times-circle me-1"></i> En rupture de stock
                </button>
            @endif
        </div>
    </div>
</div>

{{-- Styles spécifiques pour la carte article si nécessaire --}}
@once
    @push('styles')
    <style>
        .article-card-img {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
        }
        .article-card:hover .article-card-img {
            transform: scale(1.05);
        }
        .article-title-link:hover {
            color: var(--bs-primary) !important;
        }
    </style>
    @endpush
@endonce
