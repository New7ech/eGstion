{{--
  Composant: ProductCard (Version Bootstrap/KaiAdmin)
  Description: Affiche une carte pour un produit.
  Props:
    - product (object): L'objet produit contenant les informations
                        (id, name, image_url, price, old_price (optionnel), slug,
                         category_name (optionnel), est_en_promotion (optionnel))
--}}

@props(['product'])

<div class="card product-card h-100 shadow-sm">
    <div class="position-relative">
        {{-- Image du produit --}}
        <a href="{{ route('ecommerce.product', ['slug' => $product->slug ?? $product['slug'] ?? '#']) }}">
            <img src="{{ $product->image_url ?? $product['image_url'] ?? asset('assets/img/examples/product_placeholder.jpg') }}"
                 alt="Image de {{ $product->name ?? $product['name'] ?? 'Nom du produit' }}"
                 class="card-img-top product-card-img">
        </a>

        {{-- Badge de promotion (optionnel) --}}
        @if(isset($product->est_en_promotion) && $product->est_en_promotion)
            <span class="badge bg-danger position-absolute top-0 start-0 m-2">PROMO</span>
        @elseif(isset($product['badge_text']) && $product['badge_text']) {{-- Fallback pour un texte de badge custom --}}
            <span class="badge bg-danger position-absolute top-0 start-0 m-2">{{ $product['badge_text'] }}</span>
        @endif
    </div>

    <div class="card-body d-flex flex-column">
        {{-- Catégorie du produit (optionnel) --}}
        @if(isset($product->category_name) || isset($product['category_name']))
            <p class="card-text text-muted small mb-1">{{ $product->category_name ?? $product['category_name'] }}</p>
        @endif

        {{-- Nom du produit --}}
        <h5 class="card-title fs-6 fw-medium mb-2 flex-grow-1">
            <a href="{{ route('ecommerce.product', ['slug' => $product->slug ?? $product['slug'] ?? '#']) }}" class="text-dark text-decoration-none product-title-link">
                {{ $product->name ?? $product['name'] ?? 'Nom du Produit Placeholder' }}
            </a>
        </h5>

        {{-- Prix du produit --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="card-text fs-5 fw-bold mb-0 @if(isset($product->old_price) || (isset($product->est_en_promotion) && $product->est_en_promotion)) text-danger @else text-primary @endif">
                {{ number_format($product->price ?? $product['price'] ?? 0, 2, ',', ' ') }} €
            </p>
            {{-- Ancien prix (si en promotion) --}}
            @if(isset($product->old_price) && $product->old_price > ($product->price ?? $product['price'] ?? 0))
                <p class="card-text text-muted text-decoration-line-through small mb-0 ms-2">
                    {{ number_format($product->old_price, 2, ',', ' ') }} €
                </p>
            @endif
        </div>

        {{-- Bouton Ajouter au panier --}}
        <div class="mt-auto">
            <button
                type="button"
                class="btn btn-primary w-100 add-to-cart-btn"
                onclick="addToCart({{ $product->id ?? $product['id'] ?? 0 }})"
                title="Ajouter {{ $product->name ?? $product['name'] ?? 'ce produit' }} au panier">
                <i class="fas fa-shopping-cart me-1"></i> {{-- KaiAdmin utilise Font Awesome --}}
                Ajouter au panier
            </button>
        </div>
    </div>
</div>

{{-- Script pour la simulation d'ajout au panier (si non déjà global) --}}
@once
    @push('scripts')
    <script>
        if (typeof addToCart !== 'function') {
            function addToCart(productId) {
                console.log('Produit ajouté au panier (ID): ' + productId);
                // Ici, vous intégreriez la logique d'ajout au panier (ex: appel AJAX)
                // Pour la démo, une simple alerte ou un appel à swal si disponible
                if(typeof swal === 'function') {
                    swal({
                        title: "Ajouté !",
                        text: "Produit " + productId + " ajouté au panier (simulation).",
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: "btn btn-success"
                            }
                        }
                    });
                } else {
                    alert('Produit ' + productId + ' ajouté au panier (simulation).');
                }
            }
        }
    </script>
    @endpush
@endonce

{{-- Styles spécifiques pour la carte produit si nécessaire --}}
@once
    @push('styles')
    <style>
        .product-card-img {
            height: 200px; /* Hauteur fixe pour les images de produit */
            object-fit: cover; /* Assure que l'image couvre la zone sans être déformée */
            transition: transform 0.3s ease-in-out;
        }
        .product-card:hover .product-card-img {
            transform: scale(1.05); /* Léger zoom sur l'image au survol de la carte */
        }
        .product-title-link:hover {
            color: var(--bs-primary) !important; /* Utilise la variable de couleur primaire de Bootstrap/KaiAdmin */
        }
        .add-to-cart-btn {
            transition: background-color 0.2s ease-in-out, transform 0.1s ease-in-out;
        }
        .add-to-cart-btn:hover {
            /* La couleur de survol est gérée par Bootstrap, mais on peut ajouter un effet */
            transform: translateY(-1px);
        }
        .add-to-cart-btn:active {
            transform: translateY(0px);
        }
    </style>
    @endpush
@endonce
