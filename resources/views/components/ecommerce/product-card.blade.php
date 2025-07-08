{{--
  Composant: ProductCard
  Description: Affiche une carte pour un produit.
  Props:
    - product (object): L'objet produit contenant les informations (id, name, image, price, oldPrice (optionnel), slug, categoryName (optionnel))
--}}

@props(['product'])

<div class="group relative bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition-shadow duration-300 ease-in-out">
  <div class="aspect-w-1 aspect-h-1 bg-gray-50 overflow-hidden">
    {{-- Image du produit --}}
    <img src="{{ $product['image'] ?? 'https://placehold.co/400x400/F3F4F6/9CA3AF?text=Produit' }}"
         alt="Image de {{ $product['name'] ?? 'Nom du produit' }}"
         class="w-full h-full object-cover object-center group-hover:opacity-80 transition-opacity duration-300">
    {{-- Badge de promotion (optionnel) --}}
    @if(isset($product['badge']))
      <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded">{{ $product['badge'] }}</span>
    @endif
  </div>
  <div class="p-4">
    {{-- Catégorie du produit (optionnel) --}}
    @if(isset($product['categoryName']))
      <p class="text-xs text-gray-500 mb-1">{{ $product['categoryName'] }}</p>
    @endif
    {{-- Nom du produit --}}
    <h3 class="text-base font-semibold text-gray-800 mb-2">
      <a href="{{ url('/produit/' . ($product['slug'] ?? '#')) }}" class="hover:text-blue-600 transition-colors duration-300">
        <span aria-hidden="true" class="absolute inset-0"></span>
        {{ $product['name'] ?? 'Nom du Produit Placeholder' }}
      </a>
    </h3>
    {{-- Prix du produit --}}
    <div class="flex items-baseline justify-between">
      <p class="text-lg font-bold text-blue-600">
        {{ number_format($product['price'] ?? 0, 2, ',', ' ') }} €
      </p>
      {{-- Ancien prix (si en promotion) --}}
      @if(isset($product['oldPrice']))
        <p class="text-sm text-gray-400 line-through ml-2">
          {{ number_format($product['oldPrice'], 2, ',', ' ') }} €
        </p>
      @endif
    </div>
    {{-- Bouton Ajouter au panier --}}
    <div class="mt-4">
      <button
        type="button"
        class="w-full relative flex items-center justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-300"
        onclick="addToCart({{ $product['id'] ?? 0 }})" {{-- Placeholder pour la fonction JS --}}
      >
        Ajouter au panier
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
          <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
        </svg>
      </button>
      {{-- Script simple pour la démo du clic --}}
      <script>
        if (typeof addToCart !== 'function') {
          function addToCart(productId) {
            console.log('Produit ajouté au panier (ID): ' + productId);
            // Ici, vous intégreriez la logique d'ajout au panier (ex: appel AJAX)
            alert('Produit ' + productId + ' ajouté au panier (simulation).');
          }
        }
      </script>
    </div>
  </div>
</div>
