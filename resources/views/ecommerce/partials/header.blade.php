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
                    <a class="nav-link" href="#">Promotions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('ecommerce.order.track') ? 'active' : '' }}" href="{{ route('ecommerce.order.track') }}">Suivre ma commande</a>
                </li>

                {{-- Recherche Asynchrone --}}
                <li class="nav-item ms-3 search-container">
                    <form class="d-flex" action="{{ route('ecommerce.articles.index') }}" method="GET" id="live-search-form">
                        <input class="form-control me-2" type="search" name="search" id="live-search-input" placeholder="Rechercher un article..." aria-label="Search" autocomplete="off" value="{{ request('search') }}">
                        <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                    <div id="search-results" class="search-results-box"></div>
                </li>


                <li class="nav-item ms-3 dropdown">
                    <a class="nav-link btn btn-icon btn-round btn-primary dropdown-toggle" href="#" id="cartDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Voir le panier">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge bg-danger cart-count-badge"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end mini-cart-dropdown" aria-labelledby="cartDropdown" id="mini-cart-container">
                        {{-- Le contenu du mini-panier sera chargé ici par AJAX/au chargement de la page --}}
                        @include('ecommerce.partials._mini-cart')
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Placeholder pour compenser la hauteur du fixed-top navbar --}}
<div style="padding-top: 70px;"></div>

{{-- Scripts --}}
@push('styles')
<style>
    /* Amélioration du badge du panier */
    .nav-item.dropdown .btn-primary {
        position: relative;
    }
    .cart-count-badge {
        position: absolute;
        top: -5px;
        right: -10px;
        font-size: 10px;
        width: 20px;
        height: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        padding: 0;
    }

    .mini-cart-dropdown {
        min-width: 300px;
        padding: 0;
    }
    .mini-cart-list {
        list-style: none;
        padding: 0;
        margin: 0;
        max-height: 250px;
        overflow-y: auto;
    }
    .mini-cart-item {
        border-bottom: 1px solid #eee;
    }
    .mini-cart-item-link {
        display: flex;
        align-items: center;
        padding: 10px;
        text-decoration: none;
        color: #333;
    }
    .mini-cart-item-link:hover {
        background-color: #f8f9fa;
    }
    .mini-cart-item-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        margin-right: 10px;
    }
    .mini-cart-item-details {
        display: flex;
        flex-direction: column;
    }
    .mini-cart-item-name {
        font-weight: bold;
    }
    .mini-cart-item-price {
        font-size: 0.9em;
        color: #6c757d;
    }
    .mini-cart-footer {
        padding: 10px;
        border-top: 1px solid #ddd;
    }
    .mini-cart-total {
        display: flex;
        justify-content: space-between;
        font-size: 1.1em;
        margin-bottom: 10px;
    }
    .mini-cart-actions {
        display: flex;
        justify-content: space-between;
    }
    .mini-cart-empty {
        text-align: center;
        padding: 20px;
    }

    .search-container {
        position: relative;
    }
    .search-results-box {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 0 0 .25rem .25rem;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        z-index: 1000;
        max-height: 300px;
        overflow-y: auto;
    }
    .search-result-item {
        display: flex;
        align-items: center;
        padding: 0.5rem 0.75rem;
        text-decoration: none;
        color: #333;
        border-bottom: 1px solid #eee;
    }
    .search-result-item:hover {
        background-color: #f8f9fa;
    }
    .search-result-item:last-child {
        border-bottom: none;
    }
    .search-result-img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        margin-right: 10px;
        border-radius: .25rem;
    }
    .search-result-item-none {
        padding: 1rem;
        color: #6c757d;
        text-align: center;
        font-style: italic;
    }
    .search-result-footer {
        display: block;
        text-align: center;
        padding: 0.75rem;
        background-color: #f8f9fa;
        color: var(--bs-primary);
        font-weight: bold;
        text-decoration: none;
    }
    .search-result-footer:hover {
        background-color: #e9ecef;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Mise à jour du compteur de panier
    fetchCartCount();

    // Logique de recherche en direct
    const searchInput = document.getElementById('live-search-input');
    const searchResults = document.getElementById('search-results');
    let searchTimeout;

    searchInput.addEventListener('input', function () {
        clearTimeout(searchTimeout);
        const query = this.value;

        if (query.length < 2) {
            searchResults.style.display = 'none';
            return;
        }

        searchTimeout = setTimeout(() => {
            fetch(`{{ route('ecommerce.search') }}?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    searchResults.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(item => {
                            const resultItem = `
                                <a href="${item.url}" class="search-result-item">
                                    <img src="${item.image || '{{ asset('assets/img/examples/article_placeholder_thumb.jpg') }}'}" alt="" class="search-result-img">
                                    <span>${item.name}</span>
                                </a>
                            `;
                            searchResults.innerHTML += resultItem;
                        });
                        // Ajout du lien "Voir tous les résultats"
                        searchResults.innerHTML += `<a href="/shop/articles?search=${query}" class="search-result-footer">Voir tous les résultats</a>`;
                    } else {
                        searchResults.innerHTML = '<div class="search-result-item-none">Aucun article ne correspond à votre recherche.</div>';
                    }
                    searchResults.style.display = 'block';
                })
                .catch(error => console.error('Erreur de recherche:', error));
        }, 300); // Délai de 300ms avant de lancer la recherche
    });

    // Cacher les résultats si on clique en dehors
    document.addEventListener('click', function(event) {
        if (!document.querySelector('.search-container').contains(event.target)) {
            searchResults.style.display = 'none';
        }
    });
});

function fetchCartCount() {
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
@endpush
