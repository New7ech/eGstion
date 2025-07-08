{{--
  Fichier: resources/views/home.blade.php
  Description: Page d'accueil du site e-commerce.
--}}

@extends('layouts.app') {{-- On suppose que layouts.app est le layout principal de KaiAdmin --}}

{{-- Titre de la page spécifique à la page d'accueil --}}
@section('title', 'Accueil - Notre Boutique en Ligne')

@section('contenus')

  {{-- En-tête E-commerce --}}
  <header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16 md:h-20">
        {{-- Logo --}}
        <div class="flex-shrink-0">
          <a href="{{ url('/') }}" class="flex items-center">
            {{-- Placeholder pour le logo --}}
            <img class="h-8 md:h-10 w-auto" src="https://via.placeholder.com/150x50?text=Logo" alt="Logo de la boutique">
            {{-- <span class="ml-2 text-xl font-semibold text-gray-800">MaBoutique</span> --}}
          </a>
        </div>

        {{-- Barre de recherche (visible sur md et plus) --}}
        <div class="hidden md:flex flex-grow items-center justify-center px-4">
          <form action="#" method="GET" class="w-full max-w-lg">
            <div class="relative">
              <input
                type="search"
                name="q"
                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Rechercher un produit, une catégorie..."
              >
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                {{-- Icône de recherche (Heroicons ou Font Awesome) --}}
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                </svg>
              </div>
            </div>
          </form>
        </div>

        {{-- Menu et Icônes utilisateur --}}
        <div class="flex items-center">
          <nav class="hidden lg:flex space-x-6 text-sm font-medium text-gray-700 hover:text-gray-900">
            <a href="{{ url('/') }}" class="hover:text-indigo-600">Accueil</a>
            <a href="#" class="hover:text-indigo-600">Nouveautés</a>
            <a href="#" class="hover:text-indigo-600">Promotions</a>
            {{-- Menu déroulant pour Catégories --}}
            <div class="relative group">
              <button type="button" class="hover:text-indigo-600 inline-flex items-center">
                Catégories
                <svg class="ml-1 h-4 w-4 text-gray-500 group-hover:text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
              </button>
              <div class="absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 ease-in-out z-20">
                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                  {{-- Liens de catégories (placeholders) --}}
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Électronique</a>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Vêtements</a>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Maison & Jardin</a>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Sports & Loisirs</a>
                </div>
              </div>
            </div>
            <a href="#" class="hover:text-indigo-600">Blog</a>
            <a href="#" class="hover:text-indigo-600">Contact</a>
          </nav>

          <div class="flex items-center ml-4">
            {{-- Icône Panier --}}
            <a href="#" class="p-2 text-gray-600 hover:text-indigo-600 relative">
              <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
              {{-- Compteur d'articles dans le panier (placeholder) --}}
              <span class="absolute top-0 right-0 block h-4 w-4 rounded-full bg-red-500 text-white text-xs flex items-center justify-center">3</span>
            </a>

            {{-- Icône Compte Utilisateur --}}
            <a href="#" class="ml-2 p-2 text-gray-600 hover:text-indigo-600">
              <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </a>
          </div>

          {{-- Bouton Burger Menu (pour mobile/tablette) --}}
          <div class="lg:hidden ml-2">
            <button type="button" id="burger-menu-button" class="p-2 inline-flex items-center justify-center rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-expanded="false">
              <span class="sr-only">Ouvrir le menu principal</span>
              {{-- Icône Burger --}}
              <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
              {{-- Icône Croix (pour fermer, initialement cachée) --}}
              <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
      </div>

      {{-- Barre de recherche (visible sur sm uniquement, en dessous du header principal) --}}
      <div class="md:hidden border-t border-gray-200 py-2">
        <form action="#" method="GET" class="w-full">
          <div class="relative">
            <input
              type="search"
              name="q_mobile"
              class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              placeholder="Rechercher..."
            >
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
              </svg>
            </div>
          </div>
        </form>
      </div>
    </div>

    {{-- Menu Mobile (initialement caché) --}}
    <div id="mobile-menu" class="lg:hidden hidden bg-white border-b border-gray-200">
      <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
        <a href="{{ url('/') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Accueil</a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Nouveautés</a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Promotions</a>
        {{-- Menu déroulant mobile pour Catégories --}}
        <div>
          <button type="button" id="mobile-categories-button" class="w-full flex items-center justify-between px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
            Catégories
            <svg id="mobile-categories-arrow" class="ml-1 h-5 w-5 text-gray-500 transform transition-transform duration-150" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
            </svg>
          </button>
          <div id="mobile-categories-dropdown" class="hidden mt-1 space-y-1 pl-6">
            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">Électronique</a>
            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">Vêtements</a>
            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">Maison & Jardin</a>
            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">Sports & Loisirs</a>
          </div>
        </div>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Blog</a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Contact</a>
      </div>
      {{-- Barre de recherche dans le menu mobile si pas affichée en dessous du header principal sur sm --}}
      {{-- <div class="md:hidden px-4 pt-2 pb-4">
        <form action="#" method="GET" class="w-full">
          <input type="search" name="q_mobile_menu" class="block w-full pl-3 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Rechercher...">
        </form>
      </div> --}}
    </div>
  </header>
  {{-- Fin de l'En-tête E-commerce --}}

  {{-- Le reste du contenu de la page viendra ici --}}
  <main class="ecommerce-container mx-auto">
    {{-- Section Slider/Bannière principale --}}
    <section class="bg-gray-100 dark:bg-gray-800 relative overflow-hidden">
      {{-- Image de fond --}}
      {{-- Pour un vrai slider, il faudrait plusieurs images et du JS. Ici, une bannière statique. --}}
      {{-- Image de fond (exemple, à remplacer par une image de haute qualité) --}}
      {{-- Vous pouvez utiliser une balise <img> avec des classes object-cover si vous préférez contrôler l'image via HTML --}}
      <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://via.placeholder.com/1920x800/cccccc/888888?text=Banniere+Principale+E-commerce');">
        {{-- Superposition foncée optionnelle pour améliorer la lisibilité du texte --}}
        <div class="absolute inset-0 bg-black opacity-40"></div>
      </div>

      <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="min-h-[60vh] md:min-h-[70vh] lg:min-h-[80vh] flex flex-col items-center justify-center text-center text-white py-12 md:py-20">
          {{-- Titre accrocheur --}}
          <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold leading-tight mb-4 animate-fade-in-down">
            Découvrez nos Nouveautés Exclusives
          </h1>
          {{-- Texte descriptif --}}
          <p class="text-lg sm:text-xl md:text-2xl text-gray-200 mb-8 max-w-2xl animate-fade-in-up animation-delay-300">
            Des produits de qualité supérieure, conçus pour vous. Explorez nos collections et trouvez votre bonheur.
          </p>
          {{-- Bouton Call-to-Action (CTA) --}}
          <a href="#produits-vedette" {{-- Lien vers la section des produits en vedette ou une page spécifique --}}
             class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-8 rounded-lg text-lg md:text-xl shadow-lg transform hover:scale-105 transition-transform duration-150 ease-in-out animate-fade-in-up animation-delay-600">
            Explorer la Collection
          </a>
        </div>
      </div>
      {{-- Optionnel: indicateurs de slider si c'était un vrai slider --}}
    </section>
    {{-- Fin Section Slider/Bannière principale --}}

    {{-- Section Catégories Populaires --}}
    <section id="categories-populaires" class="py-12 md:py-20 bg-white dark:bg-gray-900">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Titre de la section --}}
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-white mb-4">
          Catégories Populaires
        </h2>
        <p class="text-center text-gray-600 dark:text-gray-300 mb-10 md:mb-12 max-w-xl mx-auto">
          Parcourez nos catégories les plus consultées et trouvez rapidement ce que vous cherchez.
        </p>

        {{-- Grille des catégories --}}
        {{--
          Données mockées pour les catégories.
          Dans une application réelle, ces données viendraient d'un contrôleur.
          @php
            $categories = [
              ['nom' => 'Électronique', 'image' => 'https://via.placeholder.com/400x300/E0E7FF/4F46E5?text=Électronique', 'url' => '#'],
              ['nom' => 'Mode Femme', 'image' => 'https://via.placeholder.com/400x300/FCE7F3/DB2777?text=Mode+Femme', 'url' => '#'],
              ['nom' => 'Maison & Cuisine', 'image' => 'https://via.placeholder.com/400x300/FEF3C7/D97706?text=Maison', 'url' => '#'],
              ['nom' => 'Sport & Plein Air', 'image' => 'https://via.placeholder.com/400x300/D1FAE5/059669?text=Sport', 'url' => '#'],
              // Ajoutez plus de catégories si nécessaire pour tester la grille
              // ['nom' => 'Beauté & Soins', 'image' => 'https://via.placeholder.com/400x300/FEE2E2/DC2626?text=Beauté', 'url' => '#'],
              // ['nom' => 'Jouets & Jeux', 'image' => 'https://via.placeholder.com/400x300/E0F2FE/0EA5E9?text=Jouets', 'url' => '#'],
            ];
          @endphp
        --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
          @php
            // Simuler des données dynamiques pour les catégories
            $placeholderCategories = [
              (object)['nom' => 'Smartphones & Tablettes', 'image_url' => 'https://via.placeholder.com/400x300/E0E7FF/4F46E5?text=Électronique', 'url' => '#', 'nombre_produits' => 120],
              (object)['nom' => 'Robes & Jupes', 'image_url' => 'https://via.placeholder.com/400x300/FCE7F3/DB2777?text=Mode+Femme', 'url' => '#', 'nombre_produits' => 85],
              (object)['nom' => 'Mobilier de Salon', 'image_url' => 'https://via.placeholder.com/400x300/FEF3C7/D97706?text=Maison', 'url' => '#', 'nombre_produits' => 200],
              (object)['nom' => 'Équipement de Fitness', 'image_url' => 'https://via.placeholder.com/400x300/D1FAE5/059669?text=Sport', 'url' => '#', 'nombre_produits' => 150],
            ];
          @endphp

          {{-- Boucle @foreach pour afficher les catégories --}}
          @foreach($placeholderCategories as $categorie)
          <a href="{{ $categorie->url }}" class="group block rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out bg-gray-50 dark:bg-gray-800">
            <div class="relative aspect-w-4 aspect-h-3">
              {{-- Image de la catégorie --}}
              <img src="{{ $categorie->image_url }}" alt="Image de la catégorie {{ $categorie->nom }}" class="object-cover w-full h-full transform group-hover:scale-105 transition-transform duration-300">
              {{-- Superposition optionnelle pour le texte --}}
              <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
            </div>
            <div class="p-4 md:p-5">
              {{-- Nom de la catégorie --}}
              <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-1 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors duration-300">
                {{ $categorie->nom }}
              </h3>
              {{-- Nombre de produits dans la catégorie (optionnel) --}}
              <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ $categorie->nombre_produits ?? 'Plusieurs' }} articles
              </p>
            </div>
          </a>
          @endforeach
        </div>

        {{-- Bouton pour voir toutes les catégories (optionnel) --}}
        <div class="text-center mt-10 md:mt-12">
          <a href="#" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-lg shadow hover:shadow-md transition-all duration-150 ease-in-out">
            Toutes les catégories
          </a>
        </div>
      </div>
    </section>
    {{-- Fin Section Catégories Populaires --}}

    {{-- Section Produits en Vedette --}}
    <section id="produits-vedette" class="py-12 md:py-20 bg-gray-50 dark:bg-gray-800">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Titre de la section --}}
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-white mb-4">
          Nos Produits en Vedette
        </h2>
        <p class="text-center text-gray-600 dark:text-gray-300 mb-10 md:mb-12 max-w-xl mx-auto">
          Découvrez une sélection de nos meilleurs produits, choisis spécialement pour vous.
        </p>

        {{-- Grille des produits --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
          @php
            // Simuler des données dynamiques pour les produits en vedette
            $placeholderProduits = [
              (object)[
                'nom' => 'Super Casque Audio Pro',
                'image_url' => 'https://via.placeholder.com/300x300/EBF4FF/1D4ED8?text=Casque+Audio',
                'url' => '#',
                'prix' => '149,99 €',
                'ancien_prix' => '199,99 €', // Optionnel
                'reduction_badge' => '-25%', // Optionnel
                'nouveau_badge' => true, // Optionnel
                'evaluation' => 4.5, // Optionnel: note sur 5
                'nombre_avis' => 120, // Optionnel
              ],
              (object)[
                'nom' => 'Montre Connectée Élégante',
                'image_url' => 'https://via.placeholder.com/300x300/FEE2E2/B91C1C?text=Montre',
                'url' => '#',
                'prix' => '249,00 €',
                'nouveau_badge' => false,
                'evaluation' => 5,
                'nombre_avis' => 95,
              ],
              (object)[
                'nom' => 'Cafetière Express Haute Performance',
                'image_url' => 'https://via.placeholder.com/300x300/FEF9C3/713F12?text=Cafetière',
                'url' => '#',
                'prix' => '89,50 €',
                'reduction_badge' => 'Promo!',
                'evaluation' => 4,
                'nombre_avis' => 210,
              ],
              (object)[
                'nom' => 'Baskets de Course Ultra Légères',
                'image_url' => 'https://via.placeholder.com/300x300/E0F2FE/0891B2?text=Baskets',
                'url' => '#',
                'prix' => '119,90 €',
                'ancien_prix' => '150,00 €',
                'nouveau_badge' => true,
                'evaluation' => 4.8,
                'nombre_avis' => 77,
              ],
            ];
          @endphp

          {{-- Boucle @foreach pour afficher les produits --}}
          {{-- Ceci pourrait être un @component('components.ecommerce.product-card', ['product' => $produit]) --}}
          @foreach($placeholderProduits as $produit)
          <div class="group bg-white dark:bg-gray-900 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out overflow-hidden flex flex-col">
            <div class="relative">
              {{-- Image du produit --}}
              <a href="{{ $produit->url }}" class="block aspect-w-1 aspect-h-1">
                <img src="{{ $produit->image_url }}" alt="Image de {{ $produit->nom }}" class="object-cover w-full h-full transform group-hover:scale-105 transition-transform duration-300">
              </a>
              {{-- Badges (Réduction, Nouveau) --}}
              <div class="absolute top-3 left-3 flex flex-col space-y-1">
                @if(isset($produit->reduction_badge) && $produit->reduction_badge)
                  <span class="bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">{{ $produit->reduction_badge }}</span>
                @endif
                @if(isset($produit->nouveau_badge) && $produit->nouveau_badge)
                  <span class="bg-blue-500 text-white text-xs font-semibold px-2 py-1 rounded-full">Nouveau</span>
                @endif
              </div>
              {{-- Actions rapides (optionnel, ex: ajout rapide au panier, wishlist) --}}
              <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex space-x-2">
                <button title="Ajouter au panier" class="bg-white text-gray-700 hover:bg-indigo-500 hover:text-white p-2 rounded-full shadow-md transition-colors duration-200">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </button>
                <button title="Ajouter aux favoris" class="bg-white text-gray-700 hover:bg-pink-500 hover:text-white p-2 rounded-full shadow-md transition-colors duration-200">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </button>
              </div>
            </div>

            <div class="p-4 md:p-5 flex flex-col flex-grow">
              {{-- Nom du produit --}}
              <h3 class="text-base font-semibold text-gray-800 dark:text-white mb-1 flex-grow">
                <a href="{{ $produit->url }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-300">
                  {{ $produit->nom }}
                </a>
              </h3>

              {{-- Évaluation (étoiles) --}}
              @if(isset($produit->evaluation) && $produit->evaluation > 0)
              <div class="flex items-center my-1">
                @for ($i = 1; $i <= 5; $i++)
                  <svg class="w-4 h-4 {{ $i <= $produit->evaluation ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                @endfor
                @if(isset($produit->nombre_avis))
                  <span class="ml-2 text-xs text-gray-500 dark:text-gray-400">({{ $produit->nombre_avis }} avis)</span>
                @endif
              </div>
              @endif

              {{-- Prix --}}
              <div class="mt-auto pt-2">
                <span class="text-lg font-bold text-indigo-600 dark:text-indigo-400">{{ $produit->prix }}</span>
                @if(isset($produit->ancien_prix) && $produit->ancien_prix)
                  <span class="ml-2 text-sm text-gray-500 line-through dark:text-gray-400">{{ $produit->ancien_prix }}</span>
                @endif
              </div>

              {{-- Bouton Ajouter au panier (visible en permanence ou au survol selon design) --}}
              <button class="mt-3 w-full bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium py-2 px-4 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                Ajouter au panier
              </button>
            </div>
          </div>
          @endforeach
        </div>

        {{-- Bouton pour voir tous les produits (optionnel) --}}
        <div class="text-center mt-10 md:mt-12">
          <a href="#" class="inline-block bg-transparent hover:bg-indigo-50 dark:hover:bg-gray-700 text-indigo-600 dark:text-indigo-400 font-medium py-3 px-6 rounded-lg border border-indigo-600 dark:border-indigo-400 hover:border-transparent transition-all duration-150 ease-in-out">
            Voir tous nos produits
          </a>
        </div>
      </div>
    </section>
    {{-- Fin Section Produits en Vedette --}}

    {{-- Section Offres Promotionnelles --}}
    <section id="offres-promotionnelles" class="py-12 md:py-20 bg-indigo-600 dark:bg-indigo-800 text-white">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Titre de la section --}}
        <h2 class="text-3xl font-bold text-center mb-4">
          Profitez de nos Offres Exclusives !
        </h2>
        <p class="text-center text-indigo-200 dark:text-indigo-300 mb-10 md:mb-12 max-w-xl mx-auto">
          Ne manquez pas nos promotions limitées sur une sélection d'articles.
        </p>

        {{-- Grille des offres (exemple avec 2 offres côte à côte sur grands écrans) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10 lg:gap-12">
          {{-- Offre 1 --}}
          @php
            $offre1 = (object)[
              'titre' => 'Jusqu\'à -40% sur l\'Électronique',
              'description' => 'Équipez-vous avec les dernières technologies à prix réduit. Offre valable pour une durée limitée !',
              'image_url' => 'https://via.placeholder.com/600x400/FFFFFF/4F46E5?text=Promo+Électro',
              'url' => '#',
              'cta_texte' => 'Découvrir les Promos Électro'
            ];
          @endphp
          <div class="group bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden transform hover:scale-105 transition-transform duration-300 ease-in-out">
            <div class="md:flex">
              <div class="md:flex-shrink-0">
                <img class="h-56 w-full object-cover md:w-56" src="{{ $offre1->image_url }}" alt="Promotion {{ $offre1->titre }}">
              </div>
              <div class="p-6 md:p-8 flex flex-col justify-center">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $offre1->titre }}</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4 text-sm">{{ $offre1->description }}</p>
                <a href="{{ $offre1->url }}" class="inline-block mt-auto bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-2 px-5 rounded-md transition-colors duration-200 text-center">
                  {{ $offre1->cta_texte }}
                </a>
              </div>
            </div>
          </div>

          {{-- Offre 2 --}}
          @php
            $offre2 = (object)[
              'titre' => 'Livraison Gratuite dès 50€ d\'Achat',
              'description' => 'Faites-vous plaisir ! La livraison est offerte pour toute commande supérieure à 50 euros.',
              'image_url' => 'https://via.placeholder.com/600x400/FFFFFF/059669?text=Livraison+Offerte',
              'url' => '#',
              'cta_texte' => 'Commencer mes Achats'
            ];
          @endphp
          <div class="group bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden transform hover:scale-105 transition-transform duration-300 ease-in-out">
            <div class="md:flex">
              <div class="md:flex-shrink-0">
                <img class="h-56 w-full object-cover md:w-56" src="{{ $offre2->image_url }}" alt="Promotion {{ $offre2->titre }}">
              </div>
              <div class="p-6 md:p-8 flex flex-col justify-center">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $offre2->titre }}</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4 text-sm">{{ $offre2->description }}</p>
                <a href="{{ $offre2->url }}" class="inline-block mt-auto bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-5 rounded-md transition-colors duration-200 text-center">
                  {{ $offre2->cta_texte }}
                </a>
              </div>
            </div>
          </div>
        </div>
        {{-- Fin Grille des offres --}}

        {{-- Exemple d'une offre pleine largeur (si une seule offre majeure) --}}
        {{--
        @php
          $offreMajeure = (object)[
            'titre' => 'Ventes Flash : -50% sur TOUT le site pendant 24h !',
            'sous_titre' => 'Ne ratez pas cette occasion unique !',
            'image_url' => 'https://via.placeholder.com/1200x400/333333/FFFFFF?text=VENTES+FLASH',
            'url' => '#',
            'cta_texte' => 'J\'en Profite Maintenant !'
          ];
        @endphp
        <div class="mt-12 md:mt-16 group relative rounded-xl shadow-2xl overflow-hidden transform hover:scale-102 transition-transform duration-300 ease-in-out">
          <img src="{{ $offreMajeure->image_url }}" alt="{{ $offreMajeure->titre }}" class="w-full h-auto max-h-96 object-cover">
          <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center text-center p-6">
            <h3 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $offreMajeure->titre }}</h3>
            <p class="text-xl text-yellow-300 mb-6">{{ $offreMajeure->sous_titre }}</p>
            <a href="{{ $offreMajeure->url }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-lg text-lg shadow-lg transition-colors duration-200">
              {{ $offreMajeure->cta_texte }}
            </a>
          </div>
        </div>
        --}}

      </div>
    </section>
    {{-- Fin Section Offres Promotionnelles --}}

    {{-- Section Témoignages Clients --}}
    <section id="temoignages-clients" class="py-12 md:py-20 bg-white dark:bg-gray-900">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Titre de la section --}}
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-white mb-4">
          Ce que disent nos Clients
        </h2>
        <p class="text-center text-gray-600 dark:text-gray-300 mb-10 md:mb-12 max-w-xl mx-auto">
          La satisfaction de nos clients est notre priorité. Découvrez leurs expériences.
        </p>

        {{-- Grille des témoignages --}}
        {{-- Pour un meilleur effet, un carrousel JS serait idéal pour plus de 3-4 témoignages --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          @php
            // Simuler des données dynamiques pour les témoignages
            $placeholderTemoignages = [
              (object)[
                'nom' => 'Sophie L.',
                'avatar_url' => 'https://via.placeholder.com/100x100/EBF4FF/1D4ED8?text=SL',
                'texte' => 'Service client incroyable et produits de très haute qualité. Ma commande est arrivée rapidement et bien emballée. Je recommande vivement cette boutique !',
                'note' => 5, // Note sur 5
                'metier_ville' => 'Développeuse Web, Paris', // Optionnel
              ],
              (object)[
                'nom' => 'Marc D.',
                'avatar_url' => 'https://via.placeholder.com/100x100/FEE2E2/B91C1C?text=MD',
                'texte' => 'J\'étais un peu sceptique au début, mais la qualité du produit a dépassé mes attentes. Le processus de commande était simple et intuitif.',
                'note' => 4,
                'metier_ville' => 'Chef de Projet, Lyon',
              ],
              (object)[
                'nom' => 'Aïcha K.',
                'avatar_url' => 'https://via.placeholder.com/100x100/FEF9C3/713F12?text=AK',
                'texte' => 'Un large choix de produits et des prix compétitifs. J\'ai trouvé exactement ce que je cherchais. Le site est très agréable à naviguer.',
                'note' => 5,
                'metier_ville' => 'Graphiste Freelance, Marseille',
              ],
            ];
          @endphp

          {{-- Boucle @foreach pour afficher les témoignages --}}
          {{-- Ceci pourrait être un @component('components.ecommerce.testimonial-card', ['testimonial' => $temoignage]) --}}
          @foreach($placeholderTemoignages as $temoignage)
          <div class="bg-gray-50 dark:bg-gray-800 p-6 md:p-8 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out flex flex-col">
            {{-- Icône de citation (optionnel) --}}
            <svg class="w-8 h-8 text-indigo-500 dark:text-indigo-400 mb-4" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
              <path d="M9.333 22.667C7.333 22.667 6 21.333 6 19.333C6 17.333 7.333 16 9.333 16C11.333 16 12.667 17.333 12.667 19.333C12.667 21.333 11.333 22.667 9.333 22.667ZM22.667 22.667C20.667 22.667 19.333 21.333 19.333 19.333C19.333 17.333 20.667 16 22.667 16C24.667 16 26 17.333 26 19.333C26 21.333 24.667 22.667 22.667 22.667Z M14.667 11.48C14.667 8.867 15.693 6.667 17.76 5.027L19.48 4C17.6 2.28 15.013 1.333 12 1.333C6.667 1.333 2.667 5.333 2.667 10.667C2.667 14.4 4.72 17.627 8 19.48V28H17.333V19.333C17.333 15.707 14.667 11.48 14.667 11.48ZM28 11.48C28 8.867 29.027 6.667 31.093 5.027L32.813 4C30.933 2.28 28.347 1.333 25.333 1.333C20 1.333 16 5.333 16 10.667C16 14.4 18.053 17.627 21.333 19.48V28H30.667V19.333C30.667 15.707 28 11.48 28 11.48Z"/>
            </svg>
            {{-- Texte du témoignage --}}
            <p class="text-gray-600 dark:text-gray-300 text-base leading-relaxed mb-6 flex-grow italic">
              "{{ $temoignage->texte }}"
            </p>
            {{-- Auteur du témoignage --}}
            <div class="flex items-center mt-auto">
              <img class="w-12 h-12 rounded-full object-cover mr-4 shadow-sm" src="{{ $temoignage->avatar_url }}" alt="Avatar de {{ $temoignage->nom }}">
              <div>
                <p class="font-semibold text-gray-800 dark:text-white">{{ $temoignage->nom }}</p>
                @if(isset($temoignage->metier_ville))
                  <p class="text-sm text-gray-500 dark:text-gray-400">{{ $temoignage->metier_ville }}</p>
                @endif
              </div>
            </div>
            {{-- Note (étoiles) --}}
            @if(isset($temoignage->note) && $temoignage->note > 0)
            <div class="flex items-center mt-3 pt-3 border-t border-gray-200 dark:border-gray-700">
              @for ($i = 1; $i <= 5; $i++)
                <svg class="w-5 h-5 {{ $i <= $temoignage->note ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
              @endfor
              <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $temoignage->note }}/5</span>
            </div>
            @endif
          </div>
          @endforeach
        </div>
      </div>
    </section>
    {{-- Fin Section Témoignages Clients --}}

    {{-- Section Blog / Articles Récents --}}
    <section id="blog-recent" class="py-12 md:py-20 bg-gray-50 dark:bg-gray-800">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Titre de la section --}}
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-white mb-4">
          Nos Derniers Articles de Blog
        </h2>
        <p class="text-center text-gray-600 dark:text-gray-300 mb-10 md:mb-12 max-w-xl mx-auto">
          Restez informé avec nos conseils, actualités et guides d'achat.
        </p>

        {{-- Grille des articles --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
          @php
            // Simuler des données dynamiques pour les articles de blog
            $placeholderArticles = [
              (object)[
                'titre' => 'Comment choisir le meilleur smartphone en 2024 ?',
                'image_url' => 'https://via.placeholder.com/500x350/E0E7FF/4F46E5?text=Blog+Smartphone',
                'url' => '#',
                'extrait' => 'Un guide complet pour vous aider à naviguer dans la jungle des smartphones et à trouver celui qui correspond parfaitement à vos besoins et votre budget...',
                'date_publication' => '15 Juil. 2024',
                'categorie' => 'Guides d\'achat',
                'temps_lecture' => '7 min de lecture',
              ],
              (object)[
                'titre' => 'Les secrets d\'une cuisine bien organisée',
                'image_url' => 'https://via.placeholder.com/500x350/FEF3C7/D97706?text=Blog+Cuisine',
                'url' => '#',
                'extrait' => 'Transformez votre cuisine en un espace fonctionnel et agréable grâce à nos astuces de rangement et d\'organisation simples et efficaces...',
                'date_publication' => '10 Juil. 2024',
                'categorie' => 'Conseils Maison',
                'temps_lecture' => '5 min de lecture',
              ],
              (object)[
                'titre' => 'Tendances mode Automne/Hiver : ce qu\'il faut savoir',
                'image_url' => 'https://via.placeholder.com/500x350/FCE7F3/DB2777?text=Blog+Mode',
                'url' => '#',
                'extrait' => 'Découvrez les couleurs, matières et coupes phares de la prochaine saison pour un look toujours au top des tendances...',
                'date_publication' => '05 Juil. 2024',
                'categorie' => 'Mode & Tendances',
                'temps_lecture' => '6 min de lecture',
              ],
            ];
          @endphp

          {{-- Boucle @foreach pour afficher les articles --}}
          {{-- Ceci pourrait être un @component('components.ecommerce.article-preview-card', ['article' => $article]) --}}
          @foreach($placeholderArticles as $article)
          <div class="group bg-white dark:bg-gray-900 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out overflow-hidden flex flex-col">
            {{-- Image de l'article --}}
            <a href="{{ $article->url }}" class="block">
              <img src="{{ $article->image_url }}" alt="Image de l'article {{ $article->titre }}" class="w-full h-56 object-cover transform group-hover:scale-105 transition-transform duration-300">
            </a>
            <div class="p-6 flex flex-col flex-grow">
              {{-- Catégorie et Temps de lecture --}}
              <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mb-2">
                <span>{{ $article->categorie }}</span>
                <span class="mx-2">&bull;</span>
                <span>{{ $article->temps_lecture }}</span>
              </div>
              {{-- Titre de l'article --}}
              <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3 flex-grow">
                <a href="{{ $article->url }}" class="group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors duration-300">
                  {{ $article->titre }}
                </a>
              </h3>
              {{-- Extrait de l'article --}}
              <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">
                {{ Str::limit($article->extrait, 120) }} {{-- Utilisation de Str::limit pour un extrait propre --}}
              </p>
              {{-- Date de publication et Lien Lire la suite --}}
              <div class="mt-auto flex items-center justify-between">
                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $article->date_publication }}</span>
                <a href="{{ $article->url }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-500 transition-colors duration-300">
                  Lire la suite &rarr;
                </a>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        {{-- Bouton pour voir tous les articles (optionnel) --}}
        <div class="text-center mt-10 md:mt-12">
          <a href="#" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-lg shadow hover:shadow-md transition-all duration-150 ease-in-out">
            Visiter notre Blog
          </a>
        </div>
      </div>
    </section>
    {{-- Fin Section Blog / Articles Récents --}}

    {{-- Section Newsletter --}}
    <section id="newsletter" class="py-12 md:py-20 bg-indigo-700 dark:bg-indigo-900 text-white">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
          {{-- Icône optionnelle --}}
          <svg class="mx-auto h-12 w-12 text-indigo-300 dark:text-indigo-400 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
          </svg>
          <h2 class="text-3xl font-bold mb-3">
            Abonnez-vous à notre Newsletter
          </h2>
          <p class="text-indigo-200 dark:text-indigo-300 mb-8 text-lg">
            Recevez nos dernières actualités, offres exclusives et conseils directement dans votre boîte mail.
          </p>
          {{-- Formulaire d'inscription --}}
          <form action="#" method="POST" class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto" id="newsletter-form">
            @csrf {{-- Protection CSRF pour Laravel --}}
            <label for="email-newsletter" class="sr-only">Adresse e-mail</label>
            <input
              type="email"
              name="email"
              id="email-newsletter"
              required
              class="flex-grow appearance-none block w-full px-4 py-3 rounded-md shadow-sm text-gray-900 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent sm:text-sm"
              placeholder="Votre adresse e-mail"
            >
            <button
              type="submit"
              class="sm:flex-shrink-0 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-3 px-6 rounded-md shadow-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-yellow-600 focus:ring-offset-2 focus:ring-offset-indigo-700 dark:focus:ring-offset-indigo-900"
            >
              S'inscrire
            </button>
          </form>
          <p class="mt-4 text-xs text-indigo-300 dark:text-indigo-400">
            En vous inscrivant, vous acceptez notre <a href="#" class="underline hover:text-white">politique de confidentialité</a>.
          </p>
          {{-- Message de succès/erreur (à gérer avec JS ou rechargement de page) --}}
          {{-- <div id="newsletter-message" class="mt-4 text-sm"></div> --}}
        </div>
      </div>
    </section>
    {{-- Fin Section Newsletter --}}

    {{-- Bandeau de Réassurance --}}
    <section id="reassurance" class="py-8 md:py-12 bg-gray-100 dark:bg-gray-800 border-t border-b border-gray-200 dark:border-gray-700">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8 text-center">
          {{-- Élément de réassurance 1 --}}
          <div class="flex flex-col items-center p-4">
            {{-- Icône (Exemple avec Heroicons - à remplacer par vos icônes SVG ou FontAwesome si préféré) --}}
            <svg class="w-10 h-10 md:w-12 md:h-12 text-indigo-600 dark:text-indigo-400 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /> {{-- Placeholder: ShieldCheckIcon --}}
            </svg>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-1">Paiement Sécurisé</h3>
            <p class="text-sm text-gray-600 dark:text-gray-300">Transactions 100% protégées SSL.</p>
          </div>

          {{-- Élément de réassurance 2 --}}
          <div class="flex flex-col items-center p-4">
            <svg class="w-10 h-10 md:w-12 md:h-12 text-indigo-600 dark:text-indigo-400 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" /> {{-- Placeholder: TruckIcon --}}
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16m-7-3h2m5-4h2" />
            </svg>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-1">Livraison Rapide</h3>
            <p class="text-sm text-gray-600 dark:text-gray-300">Expédition en 24/48h.</p>
          </div>

          {{-- Élément de réassurance 3 --}}
          <div class="flex flex-col items-center p-4">
            <svg class="w-10 h-10 md:w-12 md:h-12 text-indigo-600 dark:text-indigo-400 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /> {{-- Placeholder: RefreshIcon ou ArrowUturnLeftIcon --}}
            </svg>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-1">Retours Faciles</h3>
            <p class="text-sm text-gray-600 dark:text-gray-300">Satisfait ou remboursé sous 30 jours.</p>
          </div>

          {{-- Élément de réassurance 4 --}}
          <div class="flex flex-col items-center p-4">
            <svg class="w-10 h-10 md:w-12 md:h-12 text-indigo-600 dark:text-indigo-400 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /> {{-- Placeholder: ChatBubbleLeftEllipsisIcon --}}
            </svg>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-1">Service Client</h3>
            <p class="text-sm text-gray-600 dark:text-gray-300">À votre écoute 6j/7.</p>
          </div>
        </div>
      </div>
    </section>
    {{-- Fin Bandeau de Réassurance --}}

  </main> {{-- Fin du contenu principal de la page ecommerce-container --}}

  {{-- Pied de Page E-commerce --}}
  <footer class="bg-gray-800 dark:bg-gray-900 text-gray-300 dark:text-gray-400 border-t border-gray-700 dark:border-gray-600">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12">
        {{-- Colonne 1: À Propos / Logo --}}
        <div>
          <a href="{{ url('/') }}" class="inline-block mb-4">
            {{-- Placeholder pour le logo (version claire pour fond sombre) --}}
            <img class="h-10 w-auto" src="https://via.placeholder.com/150x50/FFFFFF/000000?text=LogoBlanc" alt="Logo de la boutique">
          </a>
          <p class="text-sm mb-4 leading-relaxed">
            Votre boutique en ligne de référence pour des produits de qualité, un service client exceptionnel et une expérience d'achat inégalée.
          </p>
          {{-- Réseaux sociaux --}}
          <div class="flex space-x-4">
            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200" aria-label="Facebook">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200" aria-label="Instagram">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.85s-.012 3.584-.07 4.85c-.148 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.584-.012-4.85-.07c-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.85s.012-3.584.07-4.85c.149-3.227 1.664-4.771 4.919-4.919.058-1.265.07-1.644.07-4.85zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.359 2.618 6.78 6.98 6.98 1.281.059 1.689.073 4.948.073s3.667-.014 4.947-.072c4.359-.2 6.78-2.618 6.98-6.98.059-1.281.073-1.689.073-4.948s-.014-3.667-.072-4.947c-.2-4.359-2.618-6.78-6.98-6.98-1.281-.059-1.689-.073-4.948-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4s1.791-4 4-4c2.21 0 4 1.791 4 4s-1.79 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200" aria-label="Twitter">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-.424.728-.666 1.581-.666 2.477 0 1.921.93 3.616 2.342 4.601-.867-.027-1.678-.268-2.392-.658v.056c0 2.683 1.908 4.924 4.44 5.433-.464.126-.95.193-1.453.193-.357 0-.702-.034-1.038-.097.703 2.202 2.734 3.808 5.146 3.853-1.895 1.483-4.291 2.368-6.897 2.368-.448 0-.89-.026-1.324-.077 2.449 1.579 5.357 2.499 8.481 2.499 10.178 0 15.745-8.428 15.454-15.914a11.047 11.047 0 002.705-2.808z"/></svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200" aria-label="LinkedIn">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.594-11.018-3.714v-2.155z"/></svg>
            </a>
          </div>
        </div>

        {{-- Colonne 2: Liens Utiles --}}
        <div>
          <h3 class="text-lg font-semibold text-white mb-5">Liens Utiles</h3>
          <ul class="space-y-3">
            <li><a href="#" class="hover:text-indigo-400 transition-colors duration-200">FAQ</a></li>
            <li><a href="#" class="hover:text-indigo-400 transition-colors duration-200">Suivi de Commande</a></li>
            <li><a href="#" class="hover:text-indigo-400 transition-colors duration-200">Politique de Retour</a></li>
            <li><a href="#" class="hover:text-indigo-400 transition-colors duration-200">Conditions Générales de Vente</a></li>
            <li><a href="#" class="hover:text-indigo-400 transition-colors duration-200">Mentions Légales</a></li>
            <li><a href="#" class="hover:text-indigo-400 transition-colors duration-200">Politique de Confidentialité</a></li>
          </ul>
        </div>

        {{-- Colonne 3: Catégories Populaires (ou Service Client) --}}
        <div>
          <h3 class="text-lg font-semibold text-white mb-5">Nos Catégories</h3>
          <ul class="space-y-3">
            <li><a href="#" class="hover:text-indigo-400 transition-colors duration-200">Électronique</a></li>
            <li><a href="#" class="hover:text-indigo-400 transition-colors duration-200">Mode & Vêtements</a></li>
            <li><a href="#" class="hover:text-indigo-400 transition-colors duration-200">Maison & Jardin</a></li>
            <li><a href="#" class="hover:text-indigo-400 transition-colors duration-200">Sports & Loisirs</a></li>
            <li><a href="#" class="hover:text-indigo-400 transition-colors duration-200">Beauté & Santé</a></li>
            <li><a href="#" class="hover:text-indigo-400 transition-colors duration-200">Promotions</a></li>
          </ul>
        </div>

        {{-- Colonne 4: Contact --}}
        <div>
          <h3 class="text-lg font-semibold text-white mb-5">Contactez-nous</h3>
          <address class="not-italic space-y-3 text-sm">
            <p>123 Rue de l'Exemple<br>75000 Paris, France</p>
            <p>Email: <a href="mailto:contact@maboutique.com" class="hover:text-indigo-400 transition-colors duration-200">contact@maboutique.com</a></p>
            <p>Téléphone: <a href="tel:+33123456789" class="hover:text-indigo-400 transition-colors duration-200">01 23 45 67 89</a></p>
          </address>
          {{-- Moyens de paiement acceptés (optionnel) --}}
          <div class="mt-6">
            <h4 class="text-md font-semibold text-white mb-2">Moyens de paiement</h4>
            <div class="flex space-x-2">
              {{-- Placeholder pour icônes de paiement (Visa, Mastercard, PayPal etc.) --}}
              <img src="https://via.placeholder.com/50x32/CCCCCC/FFFFFF?text=Visa" alt="Visa" class="h-8 rounded">
              <img src="https://via.placeholder.com/50x32/CCCCCC/FFFFFF?text=MC" alt="Mastercard" class="h-8 rounded">
              <img src="https://via.placeholder.com/50x32/CCCCCC/FFFFFF?text=PayPal" alt="PayPal" class="h-8 rounded">
            </div>
          </div>
        </div>
      </div>

      {{-- Ligne de Copyright --}}
      <div class="mt-12 md:mt-16 pt-8 border-t border-gray-700 dark:border-gray-600 text-center text-sm">
        <p>&copy; {{ date('Y') }} MaBoutique. Tous droits réservés. Site conçu avec <span class="text-red-500">&hearts;</span> par Votre Agence.</p>
        {{-- Lien vers le haut de page (optionnel) --}}
        {{-- <p class="mt-2"><a href="#top" class="hover:text-indigo-400 transition-colors duration-200">Retour en haut &uarr;</a></p> --}}
      </div>
    </div>
  </footer>
  {{-- Fin Pied de Page E-commerce --}}

  {{--
    Note pour l'intégration avec KaiAdmin:
    Le layout 'layouts.app' de KaiAdmin inclut déjà :
    - Une structure HTML de base (<html>, <head>, <body>)
    - Les CSS de KaiAdmin (Bootstrap, plugins, et son propre style)
    - Les JS de KaiAdmin (jQuery, Bootstrap, plugins, et son propre script)
    - Une section @yield('contenus') où ce contenu sera injecté.
    - Un sidebar, un header d'admin et un footer d'admin.

    Pour un site e-commerce, il est probable que l'on veuille un header et un footer différents
    de ceux de l'interface d'administration. Cela nécessitera soit :
    1. Un layout e-commerce dédié (ex: `layouts.ecommerce.blade.php`) que cette vue étendrait.
    2. Des modifications dans `layouts.app` pour conditionnellement afficher le header/footer/sidebar
       en fonction de la route ou d'une variable de configuration.

    Pour cette tâche, je me concentre sur le contenu de la page (`@section('contenus')`).
    L'en-tête et le pied de page spécifiques à l'e-commerce seront conçus comme des sections autonomes
    dans ce fichier, avec l'hypothèse qu'ils pourront être facilement déplacés
    vers un layout e-commerce dédié par la suite.
  --}}

@endsection

@push('styles')
  {{--
    Si des styles spécifiques à cette page sont nécessaires et ne peuvent pas être gérés
    uniquement avec Tailwind dans le template, ils peuvent être ajoutés ici.
    Cependant, l'objectif est d'utiliser Tailwind CSS autant que possible directement dans le HTML.
    Exemple: <link rel="stylesheet" href="{{ asset('css/home-custom.css') }}">
  --}}
  <style>
    /* Styles Tailwind personnalisés ou surcharges si nécessaire, bien que l'approche privilégiée soit les classes utilitaires */
    /* Exemple : .ecommerce-container { max-width: 1600px; } */
    /* Pour l'instant, on utilise les classes mx-auto de Tailwind pour le conteneur principal */

    /* Animations simples pour la bannière */
    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .animate-fade-in-down {
      animation: fadeInDown 0.5s ease-out forwards;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .animate-fade-in-up {
      animation: fadeInUp 0.5s ease-out forwards;
    }
    /* Classes pour gérer le délai d'animation */
    .animation-delay-300 { animation-delay: 0.3s; }
    .animation-delay-600 { animation-delay: 0.6s; }


    /* Assurer que le contenu e-commerce prend toute la largeur si le layout principal a des contraintes */
    .main-panel .container {
        max-width: 100% !important; /* Important pour surcharger KaiAdmin si besoin */
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    .page-inner {
        padding: 0 !important; /* Annuler le padding de .page-inner de KaiAdmin pour la page e-commerce */
    }
    .ecommerce-container {
        /* Ce conteneur peut être utilisé pour limiter la largeur max du contenu e-commerce si souhaité, */
        /* ou on peut laisser chaque section gérer sa propre largeur (ex: full-width pour header/footer, contenu centré pour les produits) */
    }
  </style>
@endpush

@push('scripts')
  {{--
    Si des scripts JavaScript spécifiques à la page d'accueil sont nécessaires.
    Exemple: <script src="{{ asset('js/home-animations.js') }}"></script>
  --}}
  <script>
    // Scripts spécifiques à la page d'accueil
    console.log("Page d'accueil e-commerce chargée et initialisée.");

    // Gestion du menu mobile (burger)
    const burgerButton = document.getElementById('burger-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const burgerIcon = burgerButton.querySelector('svg.block'); // Icône burger
    const closeIcon = burgerButton.querySelector('svg.hidden'); // Icône croix

    if (burgerButton && mobileMenu && burgerIcon && closeIcon) {
      burgerButton.addEventListener('click', () => {
        const expanded = burgerButton.getAttribute('aria-expanded') === 'true' || false;
        burgerButton.setAttribute('aria-expanded', !expanded);
        mobileMenu.classList.toggle('hidden');
        burgerIcon.classList.toggle('hidden');
        burgerIcon.classList.toggle('block');
        closeIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('block');
      });
    }

    // Gestion du sous-menu mobile pour les catégories
    const mobileCategoriesButton = document.getElementById('mobile-categories-button');
    const mobileCategoriesDropdown = document.getElementById('mobile-categories-dropdown');
    const mobileCategoriesArrow = document.getElementById('mobile-categories-arrow');

    if (mobileCategoriesButton && mobileCategoriesDropdown && mobileCategoriesArrow) {
      mobileCategoriesButton.addEventListener('click', (e) => {
        e.preventDefault(); // Empêche le comportement par défaut si c'est un lien <a>
        mobileCategoriesDropdown.classList.toggle('hidden');
        mobileCategoriesArrow.classList.toggle('rotate-180'); // Ajoute une rotation à la flèche
      });
    }

    // Optionnel: Fermer le menu mobile si on clique en dehors (plus complexe, pour une V2)
    // document.addEventListener('click', (event) => {
    //   const isClickInsideMenu = mobileMenu.contains(event.target);
    //   const isClickOnBurgerButton = burgerButton.contains(event.target);
    //   if (!isClickInsideMenu && !isClickOnBurgerButton && !mobileMenu.classList.contains('hidden')) {
    //     burgerButton.setAttribute('aria-expanded', 'false');
    //     mobileMenu.classList.add('hidden');
    //     burgerIcon.classList.remove('hidden');
    //     burgerIcon.classList.add('block');
    //     closeIcon.classList.add('hidden');
    //     closeIcon.classList.remove('block');
    //   }
    // });

  </script>
@endpush
