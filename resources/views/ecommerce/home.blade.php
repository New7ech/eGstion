@extends('ecommerce.layouts.app')

@section('title', 'Accueil Boutique')

@section('content')
{{-- Utilisation de la balise <main> pour le contenu principal de la page, avec une classe spécifique pour la page d'accueil --}}
<main class="page-inner-ecommerce home-page">

    <!-- Section Hero: Bannière principale avec appel à l'action -->
    <section id="hero" class="hero-section text-white text-center">
        {{-- Overlay pour améliorer la lisibilité du texte sur l'image de fond --}}
        <div class="hero-overlay"></div>
        <div class="container d-flex flex-column justify-content-center align-items-center">
            {{-- Titre principal de la bannière, animé à l'apparition --}}
            <h1 class="hero-title animated-title">Bienvenue dans Notre Boutique Élégante</h1>
            {{-- Sous-titre ou slogan, animé à l'apparition --}}
            <p class="hero-subtitle animated-subtitle">Découvrez des produits d'exception, pensés pour vous.</p>
            {{-- Bouton d'appel à l'action principal, animé et pointant vers la section des produits --}}
            <a href="#featured-products" class="btn btn-lg btn-custom-primary hero-cta animated-cta">Explorer Nos Collections</a>
        </div>
    </section>
    <!-- Fin Section Hero -->

    <!-- Section Highlights: Met en avant les avantages clés ou des catégories phares -->
    <section id="highlights" class="highlights-section section-padding">
        <div class="container">
            {{-- En-tête de la section --}}
            <header class="section-header text-center mb-5">
                <h2 class="section-title">Pourquoi Nous Choisir ?</h2>
                <p class="section-tagline">Qualité, Service et Confiance à chaque commande.</p>
            </header>
            {{-- Grille d'avantages --}}
            <div class="row g-4">
                {{-- Avantage 1: Livraison --}}
                <div class="col-md-4">
                    <article class="highlight-item text-center">
                        <div class="highlight-icon mb-3">
                            <i class="fas fa-shipping-fast fa-3x text-primary"></i> {{-- Icône Font Awesome pour la livraison rapide --}}
                        </div>
                        <h3 class="highlight-title h5">Livraison Express</h3>
                        <p>Vos articles préférés, livrés rapidement à votre porte.</p>
                    </article>
                </div>
                {{-- Avantage 2: Paiement Sécurisé --}}
                <div class="col-md-4">
                    <article class="highlight-item text-center">
                        <div class="highlight-icon mb-3">
                            <i class="fas fa-shield-alt fa-3x text-primary"></i> {{-- Icône Font Awesome pour le paiement sécurisé --}}
                        </div>
                        <h3 class="highlight-title h5">Paiement 100% Sécurisé</h3>
                        <p>Achetez en toute sérénité grâce à nos systèmes de paiement fiables.</p>
                    </article>
                </div>
                {{-- Avantage 3: Support Client --}}
                <div class="col-md-4">
                    <article class="highlight-item text-center">
                        <div class="highlight-icon mb-3">
                            <i class="fas fa-headset fa-3x text-primary"></i> {{-- Icône Font Awesome pour le support client --}}
                        </div>
                        <h3 class="highlight-title h5">Support Client Dédié</h3>
                        <p>Une question ? Notre équipe est là pour vous accompagner.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <!-- Fin Section Highlights -->


    <!-- Section Produits Phares: Affiche une sélection de produits populaires ou en promotion -->
    <section id="featured-products" class="featured-products-section section-padding bg-light-gray">
        <div class="container">
            {{-- En-tête de la section --}}
            <header class="section-header text-center mb-5">
                <h2 class="section-title">Nos Produits Étoiles</h2>
                <p class="section-tagline">Les coups de cœur de nos clients, sélectionnés pour vous.</p>
            </header>

            {{-- Bloc PHP pour simuler les données de produits si elles ne sont pas passées par le contrôleur. --}}
            {{-- Idéalement, ces données ($produitsPhares) proviennent du contrôleur associé à cette vue. --}}
            @php
                // Simulation de données de produits pour l'affichage
                // En production, ces données seraient injectées par le contrôleur Laravel.
                if (!isset($produitsPhares)) {
                    $produitsPhares = collect([
                        (object)['id' => 1, 'name' => 'Produit Alpha', 'slug' => 'produit-alpha', 'image_url' => 'https://picsum.photos/seed/prod_alpha/400/300', 'price' => 29.99, 'old_price' => 39.99, 'category_name' => 'Nouveautés', 'est_en_promotion' => true],
                        (object)['id' => 2, 'name' => 'Article Beta Premium', 'slug' => 'article-beta-premium', 'image_url' => 'https://picsum.photos/seed/prod_beta/400/300', 'price' => 45.50, 'category_name' => 'Meilleures Ventes'],
                        (object)['id' => 3, 'name' => 'Gadget Gamma Deluxe', 'slug' => 'gadget-gamma-deluxe', 'image_url' => 'https://picsum.photos/seed/prod_gamma/400/300', 'price' => 120.00, 'category_name' => 'Exclusivités'],
                        (object)['id' => 4, 'name' => 'Solution Delta Pratique', 'slug' => 'solution-delta-pratique', 'image_url' => 'https://picsum.photos/seed/prod_delta/400/300', 'price' => 19.75, 'category_name' => 'Promotions', 'est_en_promotion' => true, 'old_price' => 25.00],
                    ]);
                }
            @endphp

            {{-- Vérifie si des produits phares sont disponibles pour affichage --}}
            @if(isset($produitsPhares) && $produitsPhares->count() > 0)
                {{-- Grille responsive pour les produits --}}
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 product-grid">
                    {{-- Boucle sur les produits phares, limitée à 8 pour cette section --}}
                    @foreach($produitsPhares->take(8) as $produit)
                        <div class="col product-grid-item">
                            {{-- Utilisation du composant Blade `product-card` pour afficher chaque produit. --}}
                            {{-- Ce composant est responsable du rendu HTML d'une carte produit individuelle. --}}
                            <x-ecommerce.product-card :product="$produit" />
                        </div>
                    @endforeach
                </div>
                {{-- Affiche un bouton "Voir tous les produits" si plus de 4 produits sont disponibles au total --}}
                {{-- (le nombre 4 est un exemple, ajuster selon le nombre de produits affichés par défaut vs total) --}}
                @if($produitsPhares->count() > 4)
                <div class="text-center mt-5">
                    {{-- Lien vers la page de catalogue complet des produits --}}
                    <a href="{{ route('ecommerce.products.filter') }}" class="btn btn-outline-primary btn-lg">
                        Découvrir Tous Nos Produits
                    </a>
                </div>
                @endif
            @else
                {{-- Message affiché si aucun produit phare n'est disponible --}}
                <p class="text-center text-muted">Aucun produit phare à afficher pour le moment.</p>
            @endif
        </div>
    </section>
    <!-- Fin Section Produits Phares -->

    <!-- Section CTA (Call to Action): Section d'appel à l'action secondaire -->
    <section id="cta" class="cta-section section-padding text-center text-white">
        {{-- Overlay pour améliorer la lisibilité du texte sur l'image de fond --}}
        <div class="cta-overlay"></div>
        <div class="container position-relative">
            <h2 class="cta-title">Prêt à Transformer Votre Expérience d'Achat ?</h2>
            <p class="cta-text mb-4">Parcourez notre catalogue complet et trouvez exactement ce qu'il vous faut.</p>
            {{-- Bouton d'appel à l'action pointant vers le catalogue des produits --}}
            <a href="{{ route('ecommerce.products.filter') }}" class="btn btn-custom-primary btn-lg">Commencer Vos Achats</a>
        </div>
    </section>
    <!-- Fin Section CTA -->

     <!-- Section Categories Showcase: Présente une sélection de catégories de produits -->
    <section id="categories-showcase" class="categories-showcase-section section-padding">
        <div class="container">
            {{-- En-tête de la section --}}
            <header class="section-header text-center mb-5">
                <h2 class="section-title">Explorez Nos Univers</h2>
                <p class="section-tagline">Des collections pensées pour chaque besoin et chaque envie.</p>
            </header>

            {{-- Bloc PHP pour simuler les données de catégories si elles ne sont pas passées par le contrôleur. --}}
            {{-- Idéalement, ces données ($categories) proviennent du contrôleur. --}}
            @php
                // Simulation de données de catégories pour l'affichage
                if (!isset($categories)) {
                    $categories = collect([
                        (object)['id' => 1, 'nom' => 'Électronique & High-Tech', 'image_url' => 'https://picsum.photos/seed/cat_electro/400/250'],
                        (object)['id' => 2, 'nom' => 'Mode & Tendances', 'image_url' => 'https://picsum.photos/seed/cat_mode/400/250'],
                        (object)['id' => 3, 'nom' => 'Maison & Décoration', 'image_url' => 'https://picsum.photos/seed/cat_maison/400/250'],
                        (object)['id' => 4, 'nom' => 'Sport & Aventure', 'image_url' => 'https://picsum.photos/seed/cat_sport/400/250'],
                    ]);
                }
            @endphp

            {{-- Vérifie si des catégories sont disponibles pour affichage --}}
            @if(isset($categories) && $categories->count() > 0)
                {{-- Grille responsive pour les catégories --}}
                <div class="row g-4">
                    {{-- Boucle sur les catégories, limitée à 4 pour cette section pour un affichage concis --}}
                    @foreach($categories->take(4) as $categorie)
                        <div class="col-md-6 col-lg-3">
                            {{-- Carte individuelle pour chaque catégorie --}}
                            <article class="category-card">
                                {{-- Lien pointant vers la page de produits filtrée par cette catégorie --}}
                                <a href="{{ route('ecommerce.products.filter', ['category' => $categorie->id]) }}" class="category-card-link">
                                    <img src="{{ $categorie->image_url ?? 'https://picsum.photos/seed/cat_default_placeholder/400/250' }}" alt="Image de la catégorie {{ $categorie->nom }}" class="category-card-img">
                                    {{-- Overlay sur l'image avec le nom de la catégorie --}}
                                    <div class="category-card-overlay">
                                        <h3 class="category-card-title">{{ $categorie->nom }}</h3>
                                    </div>
                                </a>
                            </article>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Message affiché si aucune catégorie n'est disponible --}}
                <p class="text-center text-muted">Nos catégories seront bientôt disponibles.</p>
            @endif
        </div>
    </section>
    <!-- Fin Section Catégories -->

    {{-- Note: La section "À propos rapide" a été omise pour maintenir un design épuré. --}}
    {{-- Les informations "À Propos" sont généralement plus appropriées sur une page dédiée, accessible via le footer. --}}

</main>
@endsection

@push('styles')
{{-- Les styles CSS spécifiques à cette page sont gérés dans le fichier `public/assets/css/custom-ecommerce.css`. --}}
{{-- Cela permet de garder le fichier Blade propre et de centraliser les styles. --}}
@endpush

@push('scripts')
    {{-- Scripts JavaScript spécifiques à la page d'accueil, notamment pour les animations. --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animation initiale pour les éléments de la section Hero (titre, sous-titre, CTA).
            // Ces éléments reçoivent une classe qui déclenche une animation CSS de type "fade-in-up".
            const heroTitle = document.querySelector('.hero-title');
            const heroSubtitle = document.querySelector('.hero-subtitle');
            const heroCta = document.querySelector('.hero-cta');

            if (heroTitle) heroTitle.classList.add('fade-in-up');
            if (heroSubtitle) heroSubtitle.classList.add('fade-in-up');
            if (heroCta) heroCta.classList.add('fade-in-up');

            // Configuration de l'IntersectionObserver pour animer les éléments au défilement.
            // Cible les éléments des sections "Avantages", "Produits Phares", "Catégories" et les en-têtes de section.
            const scrollAnimatedElements = document.querySelectorAll('.highlight-item, .product-grid-item, .category-card, .section-header');

            const observer = new IntersectionObserver((entries, observerInstance) => {
                entries.forEach(entry => {
                    // Si l'élément est visible dans le viewport
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in-up-scroll'); // Applique la classe d'animation
                        observerInstance.unobserve(entry.target);        // Cesse d'observer l'élément pour éviter ré-animation
                    }
                });
            }, { threshold: 0.1 }); // L'animation se déclenche quand au moins 10% de l'élément est visible.

            scrollAnimatedElements.forEach(el => {
                el.classList.add('animate-on-scroll'); // Classe initiale pour cacher l'élément avant l'animation
                observer.observe(el);                   // Commence à observer l'élément
            });
        });
    </script>
@endpush
