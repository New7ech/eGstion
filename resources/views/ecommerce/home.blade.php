@extends('ecommerce.layouts.app')

@section('title', 'Accueil Boutique')

@section('content')
<main class="page-inner-ecommerce home-page">

    <!-- Section Hero: Bannière principale avec appel à l'action -->
    <section id="hero" class="hero-section text-white text-center">
        <div class="hero-overlay"></div>
        <div class="container d-flex flex-column justify-content-center align-items-center">
            <h1 class="hero-title animated-title">Bienvenue dans Notre Boutique Élégante</h1>
            <p class="hero-subtitle animated-subtitle">Découvrez des articles d'exception, pensés pour vous.</p>
            {{-- Lien vers le catalogue des articles --}}
            <a href="{{ route('ecommerce.articles.index') }}" class="btn btn-lg btn-custom-primary hero-cta animated-cta">Explorer Nos Collections</a>
        </div>
    </section>
    <!-- Fin Section Hero -->

    <!-- Section Highlights: Met en avant les avantages clés -->
    <section id="highlights" class="highlights-section section-padding">
        <div class="container">
            <header class="section-header text-center mb-5">
                <h2 class="section-title">Pourquoi Nous Choisir ?</h2>
                <p class="section-tagline">Qualité, Service et Confiance à chaque commande.</p>
            </header>
            <div class="row g-4">
                <div class="col-md-4">
                    <article class="highlight-item text-center">
                        <div class="highlight-icon mb-3"><i class="fas fa-shipping-fast fa-3x text-primary"></i></div>
                        <h3 class="highlight-title h5">Livraison Express</h3>
                        <p>Vos articles préférés, livrés rapidement à votre porte.</p>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="highlight-item text-center">
                        <div class="highlight-icon mb-3"><i class="fas fa-shield-alt fa-3x text-primary"></i></div>
                        <h3 class="highlight-title h5">Paiement 100% Sécurisé</h3>
                        <p>Achetez en toute sérénité grâce à nos systèmes de paiement fiables.</p>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="highlight-item text-center">
                        <div class="highlight-icon mb-3"><i class="fas fa-headset fa-3x text-primary"></i></div>
                        <h3 class="highlight-title h5">Support Client Dédié</h3>
                        <p>Une question ? Notre équipe est là pour vous accompagner.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <!-- Fin Section Highlights -->

    <!-- Section Articles Phares -->
    <section id="featured-articles" class="featured-articles-section section-padding bg-light-gray">
        <div class="container">
            <header class="section-header text-center mb-5">
                <h2 class="section-title">Nos Articles Étoiles</h2>
                <p class="section-tagline">Les coups de cœur de nos clients, sélectionnés pour vous.</p>
            </header>

            {{-- Si les articles phares sont passés par le contrôleur --}}
            @if(isset($articlesPhares) && $articlesPhares->count() > 0)
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 article-grid">
                    @foreach($articlesPhares as $article)
                        <div class="col article-grid-item">
                            {{-- Utilisation du composant article-card --}}
                            <x-ecommerce.article-card :article="$article" />
                        </div>
                    @endforeach
                </div>

                {{-- Bouton "Voir tous les articles" --}}
                <div class="text-center mt-5">
                    <a href="{{ route('ecommerce.articles.index') }}" class="btn btn-outline-primary btn-lg">
                        Découvrir Tous Nos Articles
                    </a>
                </div>
            @else
                {{-- Message si aucun article phare n'est disponible --}}
                <p class="text-center text-muted">Aucun article phare à afficher pour le moment.</p>
            @endif
        </div>
    </section>
    <!-- Fin Section Articles Phares -->

    <!-- Section CTA (Call to Action) -->
    <section id="cta" class="cta-section section-padding text-center text-white">
        <div class="cta-overlay"></div>
        <div class="container position-relative">
            <h2 class="cta-title">Prêt à Transformer Votre Expérience d'Achat ?</h2>
            <p class="cta-text mb-4">Parcourez notre catalogue complet et trouvez exactement ce qu'il vous faut.</p>
            <a href="{{ route('ecommerce.articles.index') }}" class="btn btn-custom-primary btn-lg">Commencer Vos Achats</a>
        </div>
    </section>
    <!-- Fin Section CTA -->

     <!-- Section Categories Showcase -->
    <section id="categories-showcase" class="categories-showcase-section section-padding">
        <div class="container">
            <header class="section-header text-center mb-5">
                <h2 class="section-title">Explorez Nos Univers</h2>
                <p class="section-tagline">Des collections pensées pour chaque besoin et chaque envie.</p>
            </header>

            @if(isset($categories) && $categories->count() > 0)
                <div class="row g-4">
                    @foreach($categories->take(4) as $categorie)
                        <div class="col-md-6 col-lg-3">
                            <article class="category-card">
                                <a href="{{ route('ecommerce.categories.show', ['slug' => $categorie->slug]) }}" class="category-card-link">
                                    <img src="{{ $categorie->image_url ?? asset('assets/img/examples/product_placeholder.jpg') }}" alt="Image de la catégorie {{ $categorie->nom }}" class="category-card-img">
                                    <div class="category-card-overlay">
                                        <h3 class="category-card-title">{{ $categorie->nom }}</h3>
                                    </div>
                                </a>
                            </article>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-muted">Nos catégories seront bientôt disponibles.</p>
            @endif
        </div>
    </section>
    <!-- Fin Section Catégories -->

</main>
@endsection

@push('scripts')
    {{-- Scripts JavaScript spécifiques à la page d'accueil pour les animations. --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const animatedElements = document.querySelectorAll('.animated-title, .animated-subtitle, .animated-cta');
            animatedElements.forEach(el => el.classList.add('fade-in-up'));

            const observer = new IntersectionObserver((entries, observerInstance) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in-up-scroll');
                        observerInstance.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            const scrollAnimatedElements = document.querySelectorAll('.highlight-item, .article-grid-item, .category-card, .section-header');
            scrollAnimatedElements.forEach(el => {
                el.classList.add('animate-on-scroll');
                observer.observe(el);
            });
        });
    </script>
@endpush
