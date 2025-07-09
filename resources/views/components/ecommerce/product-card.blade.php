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
    {{-- Badge de promotion (optionnel) - Adapté pour est_en_promotion --}}
    @if(isset($product->est_en_promotion) && $product->est_en_promotion)
      <span class="absolute top-3 left-3 bg-red-500 text-white text-xs font-semibold px-2.5 py-1 rounded-full z-10">PROMO</span>
    @elseif(isset($product['badge'])) {{-- Fallback pour la prop 'badge' existante si besoin --}}
      <span class="absolute top-3 left-3 bg-red-500 text-white text-xs font-semibold px-2.5 py-1 rounded-full z-10">{{ $product['badge'] }}</span>
    @endif
  </div>
  <div class="p-4 flex flex-col flex-grow"> {{-- Ajout de flex flex-col flex-grow pour aligner le bouton en bas --}}
    {{-- Catégorie du produit (optionnel) --}}
    @if(isset($product->categoryName) || isset($product['categoryName'])) {{-- Supporte objet ou array --}}
      <p class="text-xs text-gray-500 mb-1">{{ $product->categoryName ?? $product['categoryName'] }}</p>
    @endif

    {{-- Nom du produit --}}
    <h3 class="text-base font-semibold text-gray-800 mb-2 flex-grow"> {{-- flex-grow pour pousser le prix/bouton en bas si noms de tailles variables --}}
      <a href="{{ url('/produit/' . ($product->slug ?? $product['slug'] ?? '#')) }}" class="hover:text-blue-600 transition-colors duration-300">
        <span aria-hidden="true" class="absolute inset-0"></span>
        {{ $product->name ?? $product['name'] ?? 'Nom du Produit Placeholder' }}
      </a>
    </h3>

    {{-- Prix du produit --}}
    <div class="flex items-center justify-between mb-3">
      <p class="text-lg font-bold {{ (isset($product->est_en_promotion) && $product->est_en_promotion) || isset($product['oldPrice']) ? 'text-red-600' : 'text-blue-600' }}">
        {{ number_format($product->price ?? $product['price'] ?? 0, 2, ',', ' ') }} €
      </p>
      {{-- Ancien prix (si en promotion) --}}
      @if(isset($product->oldPrice) || isset($product['oldPrice']))
        <p class="text-sm text-gray-400 line-through ml-2">
          {{ number_format($product->oldPrice ?? $product['oldPrice'], 2, ',', ' ') }} €
        </p>
      @endif
    </div>

    {{-- Bouton Ajouter au panier --}}
    <div class="mt-auto"> {{-- mt-auto pour pousser le bouton en bas si la carte a une hauteur fixe ou si le contenu au dessus ne remplit pas tout --}}
      <button
        type="button"
        class="w-full relative flex items-center justify-center rounded-md border border-transparent bg-blue-600 py-2.5 px-4 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300 ease-in-out transform group-hover:scale-105"
        {{-- Assumant que l'ID du produit est disponible soit comme $product->id ou $product['id'] --}}
        onclick="addToCart({{ $product->id ?? $product['id'] ?? 0 }})"
      >
        Ajouter au panier
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300" viewBox="0 0 20 20" fill="currentColor">
          <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
        </svg>
      </button>
      {{-- Le script addToCart est conservé tel quel, en s'assurant qu'il ne soit pas dupliqué si plusieurs cartes sont sur la page.
           Idéalement, cette fonction serait dans un fichier JS global et non répétée ici.
           Pour l'instant, on la garde car la structure du projet n'est pas entièrement connue. --}}
      @once
      <script>
        if (typeof addToCart !== 'function') {
          function addToCart(productId) {
            console.log('Produit ajouté au panier (ID): ' + productId);
            // Ici, vous intégreriez la logique d'ajout au panier (ex: appel AJAX)
            // Exemple: document.dispatchEvent(new CustomEvent('add-to-cart', { detail: { productId: productId } }));
            alert('Produit ' + productId + ' ajouté au panier (simulation).');
          }
        }
      </script>
      @endonce
    </div>
  </div>
</div>
