@php
    $panierItems = session()->get('panier', []);
    $totalGeneral = 0;
@endphp

@if(count($panierItems) > 0)
    <ul class="mini-cart-list">
        @foreach($panierItems as $id => $item)
            @php
                $totalGeneral += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
            @endphp
            <li class="mini-cart-item">
                <a href="{{ route('ecommerce.articles.show', ['slug' => $item['slug']]) }}" class="mini-cart-item-link">
                    <img src="{{ $item['image_url'] ?? asset('assets/img/examples/article_placeholder_thumb.jpg') }}" alt="{{ $item['name'] }}" class="mini-cart-item-img">
                    <div class="mini-cart-item-details">
                        <span class="mini-cart-item-name">{{ Str::limit($item['name'], 25) }}</span>
                        <span class="mini-cart-item-price">{{ $item['quantity'] }} x {{ number_format($item['price'], 2, ',', ' ') }} €</span>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
    <div class="mini-cart-footer">
        <div class="mini-cart-total">
            <strong>Total:</strong>
            <span>{{ number_format($totalGeneral, 2, ',', ' ') }} €</span>
        </div>
        <div class="mini-cart-actions">
            <a href="{{ route('ecommerce.panier.index') }}" class="btn btn-outline-primary btn-sm">Voir le panier</a>
            <a href="{{ route('ecommerce.commande.checkout') }}" class="btn btn-primary btn-sm">Commander</a>
        </div>
    </div>
@else
    <div class="mini-cart-empty">
        <p>Votre panier est vide.</p>
    </div>
@endif
