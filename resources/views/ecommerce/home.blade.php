@extends('ecommerce.layouts.app')

@section('title', 'Accueil Boutique')

@section('content')
<div class="page-inner-ecommerce">

    <!-- Section Hero (Bannière d'accueil) -->
    <section class="banner-section mb-5">
        {{-- Utilisation du composant card de Bootstrap pour la structure --}}
        <div class="card text-white border-0"> {{-- border-0 pour enlever la bordure par défaut de la carte --}}
            <img src="{{ asset('assets/img/examples/ecommerce-banner.jpg') }}" class="card-img hero-banner-img" alt="Bannière principale">
            {{-- L'overlay est géré par un style inline sur card-img-overlay --}}
            <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center text-center p-3 p-md-5" style="background-color: rgba(0,0,0,0.4);">
                {{-- Titre principal avec classes de typographie Bootstrap/KaiAdmin --}}
                <h1 class="display-4 fw-bold mb-3" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">
                    Bienvenue dans notre boutique en ligne
                </h1>
                {{-- Slogan secondaire --}}
                <p class="lead fs-5 mb-4" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">
                    Achetez vos produits sans vous déplacer
                </p>
                {{-- Bouton CTA, utilisant les classes de bouton Bootstrap/KaiAdmin --}}
                <a href="{{ url('/produits') }}" class="btn btn-primary btn-lg px-4 py-2 mt-3">
                    Voir les produits
                </a>
            </div>
        </div>
    </section>
    <!-- Fin Section Hero -->

    <!-- Section Catégories -->
    <section class="categories-section py-5">
        <div class="container">
            <h2 class="text-center h3 mb-4 fw-bold">Découvrez nos Catégories</h2>
            {{-- Assumant que $categories est passé à la vue --}}
            @if(isset($categories) && $categories->count() > 0)
                <div class="row g-4">
                    {{-- Boucle sur les catégories --}}
                    @foreach($categories as $categorie)
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="card h-100 shadow-sm">
                                <a href="{{ url('/produits?categorie=' . $categorie->id) }}" class="text-decoration-none text-dark">
                                    @if(isset($categorie->image_url) && $categorie->image_url)
                                        <img src="{{ $categorie->image_url }}" class="card-img-top" alt="{{ $categorie->nom }}" style="height: 180px; object-fit: cover;">
                                    @else
                                        {{-- Placeholder SVG simple ou image par défaut --}}
                                        <div class="d-flex justify-content-center align-items-center bg-light" style="height: 180px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-tags text-muted" viewBox="0 0 16 16">
                                                <path d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z"/>
                                                <path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="card-body text-center">
                                        <h5 class="card-title fs-6 fw-medium">{{ $categorie->nom }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-muted">Aucune catégorie à afficher pour le moment.</p>
            @endif
        </div>
    </section>
    <!-- Fin Section Catégories -->

    <!-- Section Filtres (simplifiée pour l'instant) - SUPPRIMEE -->

    <!-- Section Produits Phares / En Promotion -->
    <section class="featured-products-section py-5">
        <div class="container">
            <h2 class="text-center h3 mb-4 fw-bold">Nos Produits Phares</h2>
            {{-- Assumant que $produitsPhares est passé à la vue et contient au maximum 8 produits --}}
            {{-- Si la variable passée est $products, il faudra l'utiliser ici --}}
            @if(isset($produitsPhares) && $produitsPhares->count() > 0)
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                    {{-- Boucle sur les produits phares - Limiter à 8 si la collection en contient plus --}}
                    @foreach($produitsPhares->take(8) as $produit)
                        <div class="col">
                            {{-- Le composant product-card sera adapté pour ne plus utiliser Tailwind --}}
                            <x-ecommerce.product-card :product="$produit" />
                        </div>
                    @endforeach
                </div>
                {{-- Optionnel: Bouton "Voir tous les produits" si la liste est un extrait de plus de 8 produits --}}
                @if($produitsPhares->count() > 8)
                <div class="text-center mt-5">
                    <a href="{{ url('/produits') }}" class="btn btn-outline-primary">
                        Voir tous nos produits
                    </a>
                </div>
                @endif
            @else
                <p class="text-center text-muted">Aucun produit phare à afficher pour le moment.</p>
            @endif
        </div>
    </section>
    <!-- Fin Section Produits Phares -->

    <!-- Section Avantages Client -->
    <section class="customer-benefits-section py-5 bg-light">
        <div class="container">
            <h2 class="text-center h3 mb-5 fw-bold">Vos Avantages en Commandant Chez Nous</h2>
            <div class="row g-4">
                {{-- Avantage 1 --}}
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center h-100 border-0 shadow-sm benefit-card">
                        <div class="card-body p-4">
                            {{-- Icône SVG Heroicon: Truck --}}
                            <div class="icon-benefit mx-auto mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 48px; height: 48px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                </svg>
                            </div>
                            <h5 class="card-title h6 fw-bold mb-2">Livraison Rapide</h5>
                            <p class="card-text small text-muted">Recevez vos commandes en un temps record, directement chez vous.</p>
                        </div>
                    </div>
                </div>
                {{-- Avantage 2 --}}
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center h-100 border-0 shadow-sm benefit-card">
                        <div class="card-body p-4">
                            {{-- Icône SVG Heroicon: ShieldCheck --}}
                            <div class="icon-benefit mx-auto mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 48px; height: 48px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.623 0-1.31-.21-2.571-.598-3.751A11.959 11.959 0 0118 5.714c-2.662-.144-5.379 .709-7.5 2.475z" />
                                </svg>
                            </div>
                            <h5 class="card-title h6 fw-bold mb-2">Paiement Sécurisé</h5>
                            <p class="card-text small text-muted">Transactions protégées avec les dernières technologies de cryptage.</p>
                        </div>
                    </div>
                </div>
                {{-- Avantage 3 --}}
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center h-100 border-0 shadow-sm benefit-card">
                        <div class="card-body p-4">
                            {{-- Icône SVG Heroicon: ChatBubbleLeftRight --}}
                            <div class="icon-benefit mx-auto mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 48px; height: 48px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3.543-3.091a9.117 9.117 0 01-1.255-.32l-1.098-.275 1.255-.324a11.042 11.042 0 001.255-.32l1.098-.275-1.255-.323a11.042 11.042 0 00-1.255-.32l-1.098-.275 1.255-.324a11.042 11.042 0 001.255-.32L20.25 8.511zM12 4.242c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3.543-3.091a9.117 9.117 0 01-1.255-.32l-1.098-.275 1.255-.324a11.042 11.042 0 001.255-.32L12 10.751V4.242zM12 4.242L10.745 3.92a11.041 11.041 0 00-1.255-.321l-1.098-.275-1.255.321a11.041 11.041 0 00-1.255.321L4.5 4.242m7.5 0v6.509M4.5 4.242l1.255.323a11.041 11.041 0 001.255.32L8.25 5.156m0 0L6.995 4.832a11.041 11.041 0 00-1.255-.321L4.5 4.242m0 0l.001-.001.001-.001c.001 0 .001 0 .002 0l.003-.001.003-.001.004-.001.004-.001.005-.001.005-.001.006-.001.006-.001.007 0 .007 0 .008 0 .008 0 .009 0 .009 0c.003 0 .006 0 .009 0s.006 0 .009 0m7.5-1.288c.622-.001 1.234-.004 1.836-.007.018 0 .035-.001.053-.001l.003-.001.003-.001.003-.001.004-.001.004-.001.004-.001.004-.001.004-.001.004-.001.003-.001.003-.001.002-.001.002-.001.002-.001.002-.001.001-.001h-.001c-.001 0-.001 0-.002 0-.001 0-.001 0-.001 0z" />
                                </svg>
                            </div>
                            <h5 class="card-title h6 fw-bold mb-2">Support Client</h5>
                            <p class="card-text small text-muted">Notre équipe est là pour vous aider à chaque étape de votre achat.</p>
                        </div>
                    </div>
                </div>
                {{-- Avantage 4 (Optionnel) --}}
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center h-100 border-0 shadow-sm benefit-card">
                        <div class="card-body p-4">
                            {{-- Icône SVG Heroicon: ArrowUturnLeft --}}
                            <div class="icon-benefit mx-auto mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 48px; height: 48px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                                </svg>
                            </div>
                            <h5 class="card-title h6 fw-bold mb-2">Retours Faciles</h5>
                            <p class="card-text small text-muted">Politique de retour simple et transparente pour votre tranquillité.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Fin Section Avantages Client -->

    <!-- Section "À propos" Rapide -->
    <section class="about-quick-section py-5">
        <div class="container">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="h3 mb-3 fw-bold">Qui Sommes-Nous ?</h2>
                            <p class="text-muted mb-4">
                                Bien plus qu'une simple boutique, nous sommes une équipe de passionnés dédiés à vous offrir les meilleurs produits avec une expérience d'achat inégalée. Notre mission est de simplifier votre quotidien en vous proposant qualité, innovation et service client d'exception.
                                {{-- Ce texte est un placeholder, à remplacer par le contenu réel. --}}
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end text-center">
                            <a href="{{ url('/a-propos') }}" class="btn btn-primary btn-lg px-4 py-2">
                                En Savoir Plus
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Fin Section "À propos" Rapide -->

</div>
@endsection

@push('styles')
@once
<style>
    /* Style pour l'image de la bannière Hero */
    .hero-banner-img {
        max-height: 450px;
        object-fit: cover;
        filter: brightness(0.6); /* Assombrir l'image pour améliorer la lisibilité du texte par dessus */
    }

    /* Styles pour la section Avantages Client */
    .benefit-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .benefit-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important; /* Augmente l'ombre au survol */
    }
    .icon-benefit svg {
        color: #1572E8; /* Couleur primaire KaiAdmin, ou var(--bs-primary) si Bootstrap la définit bien */
    }
</style>
@endonce
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
