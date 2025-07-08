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
                    <a class="nav-link" href="#">Catalogue</a> {{-- Lien vers une future page catalogue/produits --}}
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Promotions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('ecommerce.order.track') ? 'active' : '' }}" href="{{ route('ecommerce.order.track') }}">Suivre ma commande</a>
                </li>

                {{-- Recherche (simple pour l'instant) --}}
                <form class="d-flex ms-3" action="#" method="GET">
                    <input class="form-control me-2" type="search" name="query" placeholder="Rechercher un produit..." aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                </form>

                <li class="nav-item ms-3">
                    <a class="nav-link btn btn-icon btn-round btn-primary" href="{{ route('ecommerce.cart.index') }}" title="Voir le panier">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge bg-danger cart-count-badge">0</span> {{-- Le nombre sera mis à jour par JS --}}
                    </a>
                </li>
                {{-- Espace Client / Connexion (si implémenté plus tard)
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="#">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Inscription</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarUserDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUserDropdown">
                            <li><a class="dropdown-item" href="#">Mon Compte</a></li>
                            <li><a class="dropdown-item" href="#">Mes Commandes</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Déconnexion
                                </a>
                                <form id="logout-form" action="#" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
                --}}
            </ul>
        </div>
    </div>
</nav>

{{-- Placeholder pour compenser la hauteur du fixed-top navbar --}}
<div style="padding-top: 70px;"></div>


<script>
// Script pour mettre à jour le nombre d'articles dans le panier
document.addEventListener('DOMContentLoaded', function () {
    fetchCartCount(); // Au chargement de la page

    // Potentiellement écouter un événement personnalisé si le panier est mis à jour dynamiquement sans rechargement de page
    // document.addEventListener('cartUpdated', fetchCartCount);
});

function fetchCartCount() {
    fetch('{{ route("ecommerce.cart.count") }}')
        .then(response => response.json())
        .then(data => {
            const cartBadge = document.querySelector('.cart-count-badge');
            if (cartBadge) {
                cartBadge.textContent = data.count > 0 ? data.count : '0';
                cartBadge.style.display = data.count > 0 ? 'inline-block' : 'none';

            }
        })
        .catch(error => console.error('Erreur lors de la récupération du nombre d\'articles du panier:', error));
}
</script>
