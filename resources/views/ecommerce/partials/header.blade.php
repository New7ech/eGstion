<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('ecommerce.home') }}">
            <img src="{{ asset('assets/img/logoproduct.svg') }}" alt="{{ config('app.name', 'Gestlog') }} E-commerce" height="30">
            {{ config('app.name', 'Gestlog') }} Boutique
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('ecommerce.home') ? 'active' : '' }}" href="{{ route('ecommerce.home') }}">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('ecommerce.articles.index') ? 'active' : '' }}" href="{{ route('ecommerce.articles.index') }}">Catalogue</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Promotions</a> {{-- TODO: Définir une route pour les promotions --}}
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('ecommerce.order.track') ? 'active' : '' }}" href="{{ route('ecommerce.order.track') }}">Suivre ma commande</a>
                </li>

                {{-- Recherche --}}
                <form class="d-flex ms-3" action="{{ route('ecommerce.articles.index') }}" method="GET">
                    <input class="form-control me-2" type="search" name="search" placeholder="Rechercher un article..." aria-label="Search" value="{{ request('search') }}">
                    <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                </form>

                <li class="nav-item ms-3">
                    <a class="nav-link btn btn-icon btn-round btn-primary" href="{{ route('ecommerce.panier.index') }}" title="Voir le panier">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge bg-danger cart-count-badge"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Placeholder pour compenser la hauteur du fixed-top navbar --}}
<div style="padding-top: 70px;"></div>

{{-- Script pour mettre à jour le nombre d'articles dans le panier --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    fetchCartCount();
});

function fetchCartCount() {
    // Utilise la nouvelle route 'ecommerce.panier.count'
    fetch('{{ route("ecommerce.panier.count") }}')
        .then(response => response.json())
        .then(data => {
            const cartBadge = document.querySelector('.cart-count-badge');
            if (cartBadge) {
                cartBadge.textContent = data.count > 0 ? data.count : '';
                cartBadge.style.display = data.count > 0 ? 'inline-block' : 'none';
            }
        })
        .catch(error => console.error('Erreur lors de la récupération du nombre d\'articles du panier:', error));
}
</script>
