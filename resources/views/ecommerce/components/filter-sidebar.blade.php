@props(['categories'])

<div class="card filter-sidebar">
    <div class="card-header">
        <h5 class="card-title mb-0">Filtrer les Produits</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('ecommerce.products.filter') }}" method="GET">
            <!-- Filtre par Catégorie -->
            <div class="mb-3">
                <label for="category_filter_sidebar" class="form-label fw-bold">Catégories</label>
                <select name="category" id="category_filter_sidebar" class="form-select form-select-sm">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filtre par Prix -->
            <div class="mb-3">
                <label class="form-label fw-bold">Gamme de Prix</label>
                <div class="row g-2">
                    <div class="col">
                        <input type="number" name="min_price" class="form-control form-control-sm" placeholder="Min €" value="{{ request('min_price') }}" min="0">
                    </div>
                    <div class="col">
                        <input type="number" name="max_price" class="form-control form-control-sm" placeholder="Max €" value="{{ request('max_price') }}" min="0">
                    </div>
                </div>
            </div>

            <!-- Filtre par Disponibilité -->
            <div class="mb-3">
                <label class="form-label fw-bold">Disponibilité</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="in_stock" id="in_stock_filter" value="1" {{ request('in_stock') ? 'checked' : '' }}>
                    <label class="form-check-label" for="in_stock_filter">
                        En stock uniquement
                    </label>
                </div>
            </div>

            <!-- Tri -->
            <div class="mb-3">
                <label for="sort_by_filter_sidebar" class="form-label fw-bold">Trier par</label>
                <select name="sort_by" id="sort_by_filter_sidebar" class="form-select form-select-sm">
                    <option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>Nouveautés</option>
                    <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Prix Croissant</option>
                    <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Prix Décroissant</option>
                    <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Nom A-Z</option>
                    <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Nom Z-A</option>
                </select>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-sm">Appliquer les Filtres</button>
                @if(request()->hasAny(['category', 'min_price', 'max_price', 'in_stock', 'sort_by']))
                <a href="{{ route('ecommerce.products.filter') }}" class="btn btn-outline-secondary btn-sm mt-2">Réinitialiser les Filtres</a>
                @endif
            </div>
        </form>
    </div>
</div>
