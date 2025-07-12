@extends('ecommerce.layouts.app')

@section('title', $article->name ?? 'Détail de l\'Article')

@section('content')
<main class="page-inner-ecommerce article-detail-page section-padding">
    <div class="container">
        @if(isset($article) && $article)
            <div class="row">
                <!-- Colonne de l'image de l'article -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="article-image-gallery">
                        {{-- Utilisation de l'accessor getImageUrlAttribute() du modèle Article --}}
                        <img src="{{ $article->image_url ?? asset('assets/img/examples/product_placeholder.jpg') }}"
                             alt="Image de {{ $article->name }}"
                             class="img-fluid rounded article-main-image">
                    </div>
                </div>

                <!-- Colonne des informations de l'article et actions -->
                <div class="col-md-6">
                    <div class="article-info">
                        <h1 class="article-title mb-3">{{ $article->name }}</h1>

                        @if($article->categorie && $article->categorie->slug)
                            <p class="article-category text-muted">
                                Catégorie :
                                <a href="{{ route('ecommerce.categories.show', ['slug' => $article->categorie->slug]) }}">{{ $article->categorie->name }}</a>
                            </p>
                        @elseif($article->categorie)
                            <p class="article-category text-muted">
                                Catégorie : {{ $article->categorie->name }}
                            </p>
                        @endif

                        {{-- Gestion de l'affichage du prix --}}
                        @if($article->prix_promotionnel && $article->prix_promotionnel < $article->prix)
                            <p class="article-price h3 mb-3">
                                <span class="text-danger fw-bold">{{ number_format($article->prix_promotionnel, 2, ',', ' ') }} €</span>
                                <small class="text-muted text-decoration-line-through ms-2">{{ number_format($article->prix, 2, ',', ' ') }} €</small>
                            </p>
                        @else
                            <p class="article-price h3 mb-3">{{ number_format($article->prix, 2, ',', ' ') }} €</p>
                        @endif

                        <div class="article-description mb-4">
                            <h5 class="mb-2">Description :</h5>
                            <p>{!! nl2br(e($article->description)) !!}</p>
                        </div>

                        {{-- Formulaire d'ajout au panier --}}
                        <form action="{{ route('ecommerce.panier.ajouter') }}" method="POST" class="add-to-cart-form">
                            @csrf
                            {{-- L'ID de l'article sera utilisé pour l'ajout au panier --}}
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            <div class="row g-2 align-items-center mb-3">
                                <div class="col-auto">
                                    <label for="quantity" class="form-label">Quantité :</label>
                                </div>
                                <div class="col-auto">
                                    <input type="number" name="quantity" id="quantity" class="form-control form-control-sm" value="1" min="1" max="{{ $article->quantite }}" style="width: 80px;">
                                </div>
                            </div>

                            @if($article->quantite > 0)
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-shopping-cart me-2"></i> Ajouter au Panier
                                </button>
                            @else
                                <button type="button" class="btn btn-secondary btn-lg w-100" disabled>
                                    <i class="fas fa-times-circle me-2"></i> En rupture de stock
                                </button>
                            @endif
                        </form>

                        <div class="article-meta mt-4">
                            @if($article->sku)
                                <p><span class="fw-bold">Référence :</span> {{ $article->sku }}</p>
                            @endif
                             <p><span class="fw-bold">Disponibilité :</span>
                                @if($article->quantite > 0)
                                    <span class="text-success">En stock ({{$article->quantite}} unités)</span>
                                @else
                                    <span class="text-danger">Épuisé</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- Ce cas est normalement géré par la redirection dans le contrôleur --}}
            <div class="alert alert-warning text-center" role="alert">
                L'article que vous recherchez n'a pas été trouvé ou n'est plus disponible.
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('ecommerce.articles.index') }}" class="btn btn-secondary">Retourner au catalogue</a>
            </div>
        @endif
    </div>
</main>
@endsection
