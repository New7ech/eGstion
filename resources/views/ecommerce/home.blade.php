@extends('ecommerce.layouts.app') {{-- Utilisation du layout spécifique à l'e-commerce --}}

@section('title', 'Accueil') {{-- Titre spécifique pour la page d'accueil --}}

@section('content')
    {{-- Section Hero --}}
    <section class="bg-gradient-to-r from-purple-600 via-pink-500 to-red-500 text-white py-20 md:py-32">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-4 leading-tight animate-fade-in-down">
                Bienvenue dans Notre Boutique en Ligne
            </h1>
            <p class="text-lg sm:text-xl md:text-2xl mb-8 animate-fade-in-up delay-200">
                Achetez vos produits préférés sans vous déplacer, en toute simplicité.
            </p>
            <a href="{{ route('produits.index') }}"
               class="bg-white text-purple-700 font-semibold px-8 py-3 rounded-lg shadow-lg hover:bg-gray-100 hover:text-purple-800 transition-all duration-300 transform hover:scale-105 animate-bounce-in delay-500">
                Voir les Produits
            </a>
        </div>
    </section>
    {{-- Fin Section Hero --}}

    {{-- Section Catégories --}}
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Découvrez nos Catégories</h2>

            {{-- Simulation de la variable $categories --}}
            @php
                $categories = [
                    (object)['nom' => 'Électronique', 'image' => 'https://via.placeholder.com/300x200/E0E7FF/4F46E5?text=Électronique', 'lien' => '#electronique'],
                    (object)['nom' => 'Mode & Vêtements', 'image' => 'https://via.placeholder.com/300x200/FCE7F3/DB2777?text=Mode', 'lien' => '#mode'],
                    (object)['nom' => 'Maison & Jardin', 'image' => 'https://via.placeholder.com/300x200/D1FAE5/059669?text=Maison', 'lien' => '#maison'],
                    (object)['nom' => 'Sports & Loisirs', 'image' => 'https://via.placeholder.com/300x200/FEF3C7/D97706?text=Sports', 'lien' => '#sports'],
                ];
            @endphp

            @if(!empty($categories))
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($categories as $categorie)
                        <a href="{{ $categorie->lien }}" class="group block rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 bg-white">
                            <div class="relative">
                                <img src="{{ $categorie->image }}" alt="Image de la catégorie {{ $categorie->nom }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-10 transition-opacity duration-300"></div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-800 text-center group-hover:text-purple-600 transition-colors duration-300">
                                    {{ $categorie->nom }}
                                </h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600">Aucune catégorie à afficher pour le moment.</p>
            @endif
        </div>
    </section>
    {{-- Fin Section Catégories --}}

    {{-- Section Produits Phares / En Promotion --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Nos Produits Phares</h2>

            {{-- Simulation de la variable $produits --}}
            @php
                $produits = [
                    (object)['image' => 'https://via.placeholder.com/300x300/E2E8F0/4A5568?text=Produit+1', 'titre' => 'Superbe Gadget Électronique', 'prix' => '199.99€', 'promotion' => true, 'prix_promo' => '149.99€'],
                    (object)['image' => 'https://via.placeholder.com/300x300/FEFBF6/7F5539?text=Produit+2', 'titre' => 'Vêtement Tendance Ultime', 'prix' => '79.50€', 'promotion' => false],
                    (object)['image' => 'https://via.placeholder.com/300x300/F0FFF4/2F855A?text=Produit+3', 'titre' => 'Accessoire Maison Indispensable', 'prix' => '45.00€', 'promotion' => true, 'prix_promo' => '35.00€'],
                    (object)['image' => 'https://via.placeholder.com/300x300/FFF5F5/C53030?text=Produit+4', 'titre' => 'Équipement Sportif Pro', 'prix' => '120.00€', 'promotion' => false],
                    (object)['image' => 'https://via.placeholder.com/300x300/EBF8FF/3182CE?text=Produit+5', 'titre' => 'Jouet Éducatif Amusant', 'prix' => '29.99€', 'promotion' => false],
                    (object)['image' => 'https://via.placeholder.com/300x300/FAF5FF/805AD5?text=Produit+6', 'titre' => 'Livre Best-seller Captivant', 'prix' => '19.90€', 'promotion' => true, 'prix_promo' => '15.50€'],
                ];
            @endphp

            @if(!empty($produits))
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($produits as $produit)
                        <div class="group bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 relative flex flex-col">
                            @if($produit->promotion)
                                <span class="absolute top-0 left-0 bg-red-500 text-white text-xs font-semibold px-3 py-1 rounded-br-lg z-10">PROMO</span>
                            @endif
                            <div class="relative overflow-hidden product-card-image"> {{-- Classe ajoutée pour le style de l'image --}}
                                <img src="{{ $produit->image }}" alt="Image de {{ $produit->titre }}" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                            <div class="p-6 flex flex-col flex-grow">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2 product-title-min-height">{{ $produit->titre }}</h3> {{-- Classe ajoutée pour hauteur min --}}
                                <div class="mb-4 mt-auto">
                                    @if($produit->promotion && isset($produit->prix_promo))
                                        <p class="text-xl font-bold text-purple-600">{{ $produit->prix_promo }}</p>
                                        <p class="text-sm text-gray-500 line-through">{{ $produit->prix }}</p>
                                    @else
                                        <p class="text-xl font-bold text-purple-600">{{ $produit->prix }}</p>
                                    @endif
                                </div>
                                <button class="w-full bg-purple-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-purple-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
                                    Ajouter au Panier
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600">Aucun produit phare à afficher pour le moment.</p>
            @endif
        </div>
    </section>
    {{-- Fin Section Produits Phares / En Promotion --}}

    {{-- Section Avantages Client --}}
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Vos Avantages en Choisissant Notre Boutique</h2>

            {{-- Simulation de la variable $avantages --}}
            @php
                $avantages = [
                    (object)['icone' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-purple-600 mb-4"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125V14.25m-17.25 4.5H9.75m0-4.5H3.375M9.75 14.25H14.25m5.25 0h-4.5m0 0V6.75c0-.621-.504-1.125-1.125-1.125H9.75S8.625 5.625 8.625 4.5m6.75 1.125c0 .621.504 1.125 1.125 1.125H18.75m0 0V4.5m0 0h-2.25m0 0H12m6.75 0H12M12 4.5v1.125" /></svg>', 'titre' => 'Livraison Rapide et Fiable', 'description' => 'Recevez vos commandes en un temps record, directement à votre porte.'],
                    (object)['icone' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-purple-600 mb-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>', 'titre' => 'Paiement 100% Sécurisé', 'description' => 'Effectuez vos achats en toute confiance grâce à nos systèmes de paiement sécurisés.'],
                    (object)['icone' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-purple-600 mb-4"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L1.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.25 12L17 14.25l-1.25-2.25L13.5 11l2.25-1.25L17 7.5l1.25 2.25L20.5 11l-2.25 1.25z" /></svg>', 'titre' => 'Produits de Qualité Supérieure', 'description' => 'Nous sélectionnons avec soin les meilleurs produits pour votre satisfaction.'],
                    (object)['icone' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-purple-600 mb-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a.75.75 0 00.75-.75V11.25l-1.5 1.5L9.75 12l3-3m0 0l3 3L11.25 12l-1.5-1.5V18a.75.75 0 00.75.75zM10.5 21.75H13.5M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75S17.385 21.75 12 21.75 2.25 17.385 2.25 12z" /></svg>', 'titre' => 'Support Client Réactif', 'description' => 'Notre équipe est à votre écoute pour répondre à toutes vos questions.'],
                ];
            @endphp

            @if(!empty($avantages))
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($avantages as $avantage)
                        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col items-center text-center transform hover:scale-105">
                            {!! $avantage->icone !!} {{-- Icône SVG inline --}}
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $avantage->titre }}</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">{{ $avantage->description }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600">Nos avantages seront bientôt listés ici.</p>
            @endif
        </div>
    </section>
    {{-- Fin Section Avantages Client --}}

    {{-- Section "À propos" rapide --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">À Propos de Notre Boutique</h2>
                <p class="text-gray-600 leading-relaxed mb-8">
                    Bienvenue chez [Nom de la Boutique], votre destination privilégiée pour découvrir une sélection exceptionnelle de produits de qualité. Notre mission est de vous offrir une expérience d'achat en ligne simple, agréable et sécurisée. Passionnés par [Votre Domaine/Type de Produits], nous nous engageons à vous proposer les dernières tendances et les meilleurs articles, soigneusement choisis pour répondre à vos besoins et envies.
                </p>
                <a href="{{ route('about') }}" {{-- Remplacez 'about' par la route réelle de votre page "À propos" --}}
                   class="bg-purple-600 text-white font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-purple-700 transition-colors duration-300 transform hover:scale-105">
                    En Savoir Plus
                </a>
            </div>
        </div>
    </section>
    {{-- Fin Section "À propos" rapide --}}

    {{-- Le footer est inclus via le layout ecommerce.layouts.app, qui appelle ecommerce.partials.footer --}}
    {{-- Aucun placeholder n'est nécessaire ici si le layout gère correctement l'inclusion du footer. --}}
@endsection

@push('styles')
    {{-- Styles spécifiques pour les animations de la section Hero (optionnel, Tailwind gère déjà beaucoup) --}}
    <style>
        @keyframes fade-in-down {
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
            animation: fade-in-down 0.8s ease-out forwards;
        }

        @keyframes fade-in-up {
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
            animation: fade-in-up 0.8s ease-out forwards;
        }

        @keyframes bounce-in {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                transform: scale(1);
            }
        }
        .animate-bounce-in {
            animation: bounce-in 1s ease-out forwards;
        }

        /* Assurer que les images des produits ne dépassent pas leur conteneur et gardent leur ratio */
        .product-card-image img {
            aspect-ratio: 1 / 1; /* Ou un autre ratio souhaité, ex: 4 / 3 */
            object-fit: cover;
        }

        /* Hauteur minimale pour les titres de produits pour alignement */
        .product-title-min-height {
            min-height: 3.5em; /* Ajuster selon la taille de police et le nombre de lignes souhaité */
        }
    </style>
@endpush

@push('scripts')
    {{-- Si des scripts spécifiques à cette page sont nécessaires --}}
    {{-- Exemple: initialisation d'un carrousel pour les produits si on en utilisait un --}}
    {{-- <script>
        // Code JS spécifique à la page d'accueil
    </script> --}}
@endpush
