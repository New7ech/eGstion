<header class="bg-dark shadow-md sticky-top z-50">
    <div class="container mx-auto px-4 py-3">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
            <!-- Logo et Badge -->
            <div class="d-flex align-items-center mb-3 mb-md-0">
                <a href="{{ route('ecommerce.home') }}" class="text-decoration-none">
                    <h1 class="h4 text-white mb-0">
                        <span class="fw-bold text-warning">LOGO</span><span class="text-success">Shop</span>
                    </h1>
                </a>
                <span class="ms-3 badge bg-warning text-white" data-testid="badge-burkinabe">
                    100% Burkinabé
                </span>
            </div>

            <!-- Barre de recherche -->
            <div class="w-100 w-md-50 w-lg-33 mb-3 mb-md-0 position-relative">
                <form action="{{ route('ecommerce.articles.index') }}" method="GET" id="live-search-form">
                    <input type="text" name="search" id="live-search-input" placeholder="Rechercher un produit, une marque ou une catégorie..."
                           class="form-control form-control-lg"
                           data-testid="search-bar" autocomplete="off" value="{{ request('search') }}">
                </form>
                <div class="position-absolute start-0 end-0 mt-1 bg-white border border-light rounded-lg shadow-lg z-10 d-none" id="search-results">
                    <!-- item: <a href="#" class="d-block px-4 py-2 text-decoration-none text-dark hover-bg-light">Suggestion 1</a> -->
                </div>
            </div>

            <!-- Icônes utilisateur, panier, favoris -->
            <div class="d-flex align-items-center space-x-4">
                <a href="#" class="text-white hover-text-warning" aria-label="Mon compte" data-testid="icon-user">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    </svg>
                </a>
                <a href="{{ route('ecommerce.panier.index') }}" class="text-white hover-text-warning position-relative" aria-label="Panier" data-testid="icon-cart">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-count-badge" data-testid="cart-count"></span>
                </a>
                <a href="#" class="text-white hover-text-warning" aria-label="Favoris" data-testid="icon-wishlist">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Menu catégories -->
        <nav class="mt-3 border-top border-secondary pt-3">
            <ul class="d-flex flex-wrap justify-content-center justify-content-md-start list-unstyled">
                @php
                    $categories = \App\Models\Categorie::all();
                @endphp
                @foreach($categories as $category)
                    <li class="me-2 me-md-4">
                        <a href="{{ route('ecommerce.categories.show', ['slug' => $category->slug]) }}"
                           class="text-white text-decoration-none fw-semibold px-3 py-1 rounded-pill hover-bg-warning transition"
                           data-testid="category-link-{{ $category->slug }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</header>

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
            searchResults.classList.add('d-none');
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
                                <a href="${item.url}" class="d-block px-4 py-2 text-decoration-none text-dark hover-bg-light">
                                    <img src="${item.image || '{{ asset('assets/img/examples/article_placeholder_thumb.jpg') }}'}" alt="" width="40" height="40" class="me-2 rounded">
                                    <span>${item.name}</span>
                                </a>
                            `;
                            searchResults.innerHTML += resultItem;
                        });
                        // Ajout du lien "Voir tous les résultats"
                        searchResults.innerHTML += `<a href="/shop/articles?search=${query}" class="d-block text-center fw-bold p-2 bg-light text-primary text-decoration-none">Voir tous les résultats</a>`;
                    } else {
                        searchResults.innerHTML = '<div class="p-3 text-muted text-center">Aucun article ne correspond à votre recherche.</div>';
                    }
                    searchResults.classList.remove('d-none');
                })
                .catch(error => console.error('Erreur de recherche:', error));
        }, 300); // Délai de 300ms avant de lancer la recherche
    });

    // Cacher les résultats si on clique en dehors
    document.addEventListener('click', function(event) {
        const searchContainer = document.querySelector('.position-relative');
        if (!searchContainer.contains(event.target)) {
            searchResults.classList.add('d-none');
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
