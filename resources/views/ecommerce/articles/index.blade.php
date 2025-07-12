@extends('ecommerce.layouts.app')

@section('title', 'Tous nos Articles')

@section('content')
<main class="page-inner-ecommerce articles-page section-padding">
    <div class="container">
        <header class="section-header text-center mb-5">
            <h1 class="section-title">{{ isset($search) && $search ? 'Résultats pour "' . e($search) . '"' : 'Catalogue des Articles' }}</h1>
            @if(!isset($search) || !$search)
                <p class="section-tagline">Parcourez notre collection complète.</p>
            @endif
        </header>

        @if(session('erreur'))
            <div class="alert alert-danger text-center">{{ session('erreur') }}</div>
        @endif

        @if(isset($articles) && $articles->count() > 0)
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 article-grid">
                @foreach($articles as $article)
                    <div class="col article-grid-item">
                        <x-ecommerce.article-card :article="$article" />
                    </div>
                @endforeach
            </div>

            {{-- Liens de pagination --}}
            <div class="mt-5 d-flex justify-content-center">
                {{ $articles->appends(['search' => $search])->links() }}
            </div>
        @else
            <div class="text-center">
                <p>Aucun article ne correspond à votre recherche.</p>
                <a href="{{ route('ecommerce.articles.index') }}" class="btn btn-primary mt-3">Retour au catalogue complet</a>
            </div>
        @endif
    </div>
</main>
@endsection
