@extends('ecommerce.layouts.app')

@section('title', 'Tous nos Articles')

@section('content')
<main class="page-inner-ecommerce articles-page section-padding">
    <div class="container">
        <header class="section-header text-center mb-5">
            <h1 class="section-title">Catalogue des Articles</h1>
            <p class="section-tagline">Parcourez notre collection complète.</p>
        </header>

        @if(session('erreur'))
            <div class="alert alert-danger text-center">{{ session('erreur') }}</div>
        @endif

        @if(isset($articles) && $articles->count() > 0)
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 article-grid">
                @foreach($articles as $article)
                    <div class="col article-grid-item">
                        {{-- Utilisation d'un composant article-card, à créer/renommer plus tard --}}
                        <x-ecommerce.article-card :article="$article" />
                    </div>
                @endforeach
            </div>

            {{-- Liens de pagination --}}
            <div class="mt-5 d-flex justify-content-center">
                {{ $articles->links() }}
            </div>
        @else
            <p class="text-center">Aucun article à afficher pour le moment.</p>
        @endif
    </div>
</main>
@endsection
