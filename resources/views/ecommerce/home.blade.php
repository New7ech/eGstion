@extends('ecommerce.layouts.app')

@section('title', 'Accueil Boutique')

@section('content')
<div class="page-inner-ecommerce pt-5 pb-5"> {{-- Padding Tailwind ajouté ici --}}

    <!-- Section Hero (Bannière d'accueil) -->
    <section class="banner-section mb-5 relative">
        {{-- Image de fond --}}
        <img src="{{ asset('assets/img/examples/ecommerce-banner.jpg') }}" class="absolute inset-0 w-full h-full object-cover" alt="Bannière principale">
        {{-- Conteneur pour le contenu avec un overlay sombre pour la lisibilité --}}
        <div class="relative min-h-[400px] md:min-h-[500px] flex flex-col justify-center items-center text-center text-white p-6" style="background-color: rgba(0,0,0,0.5);">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.7);">
                Bienvenue dans notre boutique en ligne
            </h1>
            <p class="text-lg md:text-xl lg:text-2xl mb-8 max-w-2xl" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.7);">
                Achetez vos produits sans vous déplacer
            </p>
            <a href="{{ url('/produits') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg text-lg transition duration-300 ease-in-out transform hover:scale-105">
                Voir les produits
            </a>
        </div>
    </section>
    <!-- Fin Section Hero -->

    <!-- Section Catégories -->
    <section class="categories-section my-8 md:my-12">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-semibold text-center mb-6 md:mb-8">Découvrez nos Catégories</h2>
            {{-- Assumant que $categories est passé à la vue --}}
            @if(isset($categories) && $categories->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                    @foreach($categories as $categorie)
                        <a href="{{ url('/produits?categorie=' . $categorie->id) }}" class="group block rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out overflow-hidden bg-white">
                            <div class="h-32 sm:h-40 bg-gray-200 flex items-center justify-center">
                                {{-- Placeholder pour image/icône --}}
                                @if(isset($categorie->image_url) && $categorie->image_url)
                                    <img src="{{ $categorie->image_url }}" alt="{{ $categorie->nom }}" class="h-full w-full object-cover">
                                @else
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4M4 7s0 0 0 0M12 15V7m0 0L8 11m4-4l4 4"></path></svg>
                                @endif
                            </div>
                            <div class="p-4 text-center">
                                <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">{{ $categorie->nom }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600">Aucune catégorie à afficher pour le moment.</p>
            @endif
        </div>
    </section>
    <!-- Fin Section Catégories -->

    <!-- Section Produits Phares / En Promotion -->
    <section class="featured-products-section my-8 md:my-12">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-semibold text-center mb-6 md:mb-8">Nos Produits Phares</h2>
            {{-- Assumant que $produitsPhares est passé à la vue et contient au maximum 8 produits --}}
            @if(isset($produitsPhares) && $produitsPhares->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
                    {{-- La grille sera 1 colonne sur mobile (par défaut), 2 sur sm, 3 sur md, et 4 sur lg et plus.
                         La demande initiale était 2 colonnes mobile, 4 desktop.
                         Tailwind mobile-first: grid-cols-2 lg:grid-cols-4
                         Je vais utiliser grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 pour une meilleure progressivité.
                         Ajustement pour 2 colonnes mobile et 4 desktop : grid grid-cols-2 lg:grid-cols-4 gap-6
                    --}}
                    @foreach($produitsPhares as $produit)
                        {{-- Le composant product-card sera modifié pour inclure le badge promo et les autres détails --}}
                        <x-ecommerce.product-card :product="$produit" />
                    @endforeach
                </div>
                {{-- Optionnel: Bouton "Voir tous les produits" si la liste est un extrait --}}
                {{-- <div class="text-center mt-8">
                    <a href="{{ url('/produits') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-lg transition duration-300">
                        Voir tous nos produits
                    </a>
                </div> --}}
            @else
                <p class="text-center text-gray-600">Aucun produit phare à afficher pour le moment.</p>
            @endif
        </div>
    </section>
    <!-- Fin Section Produits Phares -->

    <!-- Section Avantages Client -->
    <section class="customer-benefits-section bg-gray-100 py-8 md:py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-semibold text-center mb-6 md:mb-8">Vos Avantages en Commandant Chez Nous</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8 text-center">
                {{-- Avantage 1 --}}
                <div class="benefit-item p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    {{-- Icône Heroicon: Truck --}}
                    <svg class="w-12 h-12 text-blue-600 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Livraison Rapide</h3>
                    <p class="text-gray-600 text-sm">Recevez vos commandes en un temps record, directement chez vous.</p>
                </div>
                {{-- Avantage 2 --}}
                <div class="benefit-item p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    {{-- Icône Heroicon: ShieldCheck --}}
                    <svg class="w-12 h-12 text-blue-600 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.623 0-1.31-.21-2.571-.598-3.751A11.959 11.959 0 0118 5.714c-2.662-.144-5.379 .709-7.5 2.475z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Paiement Sécurisé</h3>
                    <p class="text-gray-600 text-sm">Transactions protégées avec les dernières technologies de cryptage.</p>
                </div>
                {{-- Avantage 3 --}}
                <div class="benefit-item p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    {{-- Icône Heroicon: ChatBubbleLeftRight --}}
                    <svg class="w-12 h-12 text-blue-600 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3.543-3.091a9.117 9.117 0 01-1.255-.32l-1.098-.275 1.255-.324a11.042 11.042 0 001.255-.32l1.098-.275-1.255-.323a11.042 11.042 0 00-1.255-.32l-1.098-.275 1.255-.324a11.042 11.042 0 001.255-.32L20.25 8.511zM12 4.242c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3.543-3.091a9.117 9.117 0 01-1.255-.32l-1.098-.275 1.255-.324a11.042 11.042 0 001.255-.32L12 10.751V4.242zM12 4.242L10.745 3.92a11.041 11.041 0 00-1.255-.321l-1.098-.275-1.255.321a11.041 11.041 0 00-1.255.321L4.5 4.242m7.5 0v6.509M4.5 4.242l1.255.323a11.041 11.041 0 001.255.32L8.25 5.156m0 0L6.995 4.832a11.041 11.041 0 00-1.255-.321L4.5 4.242m0 0l.001-.001.001-.001c.001 0 .001 0 .002 0l.003-.001.003-.001.004-.001.004-.001.005-.001.005-.001.006-.001.006-.001.007 0 .007 0 .008 0 .008 0 .009 0 .009 0c.003 0 .006 0 .009 0s.006 0 .009 0m7.5-1.288c.622-.001 1.234-.004 1.836-.007.018 0 .035-.001.053-.001l.003-.001.003-.001.003-.001.004-.001.004-.001.004-.001.004-.001.004-.001.004-.001.003-.001.003-.001.002-.001.002-.001.002-.001.002-.001.001-.001h-.001c-.001 0-.001 0-.002 0-.001 0-.001 0-.001 0z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Support Client Réactif</h3>
                    <p class="text-gray-600 text-sm">Notre équipe est là pour vous aider à chaque étape.</p>
                </div>
                {{-- Avantage 4 (Optionnel) --}}
                <div class="benefit-item p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    {{-- Icône Heroicon: ArrowUturnLeft --}}
                     <svg class="w-12 h-12 text-blue-600 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Retours Faciles</h3>
                    <p class="text-gray-600 text-sm">Politique de retour simple et transparente pour votre tranquillité d'esprit.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Fin Section Avantages Client -->

    <!-- Section "À propos" Rapide -->
    <section class="about-quick-section py-8 md:py-12">
        <div class="container mx-auto px-4 text-center md:text-left">
            <div class="md:flex md:items-center md:justify-between bg-white p-6 md:p-8 rounded-lg shadow-lg">
                <div class="md:w-2/3 md:pr-8">
                    <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-4">Qui Sommes-Nous ?</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Bien plus qu'une simple boutique, nous sommes une équipe de passionnés dédiés à vous offrir les meilleurs produits avec une expérience d'achat inégalée. Notre mission est de simplifier votre quotidien en vous proposant qualité, innovation et service client d'exception. Découvrez notre histoire et nos engagements.
                        {{-- Ce texte est un placeholder, à remplacer par le contenu réel. --}}
                    </p>
                </div>
                <div class="md:w-1/3 text-center md:text-right mt-6 md:mt-0">
                    <a href="{{ url('/a-propos') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg text-lg transition duration-300 ease-in-out transform hover:scale-105">
                        En Savoir Plus
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Fin Section "À propos" Rapide -->

</div>
@endsection

@push('styles')
{{-- Le style custom a été intégré via des classes Tailwind ou style inline directement sur les éléments concernés --}}
@endpush

@push('scripts')
    {{-- Scripts spécifiques à la page d'accueil si besoin --}}
@endpush
