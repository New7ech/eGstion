@extends('ecommerce.layouts.app') {{-- Assurez-vous que ce layout existe --}}

@section('title', 'Votre Panier')

@section('content')
<main class="page-inner-ecommerce cart-page section-padding">
    <div class="container">
        <header class="section-header text-center mb-5">
            <h1 class="section-title">Votre Panier d'Achats</h1>
        </header>

        @if(session('succes'))
            <div class="alert alert-success">
                {{ session('succes') }}
            </div>
        @endif
        @if(session('erreur'))
            <div class="alert alert-danger">
                {{ session('erreur') }}
            </div>
        @endif

        @if(isset($panierItems) && count($panierItems) > 0)
            <div class="cart-items-wrapper mb-4">
                <table class="table cart-table">
                    <thead>
                        <tr>
                            <th scope="col" class="d-none d-md-table-cell">Produit</th>
                            <th scope="col"></th>
                            <th scope="col" class="text-center">Quantité</th>
                            <th scope="col" class="text-end">Prix Unitaire</th>
                            <th scope="col" class="text-end">Total</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalGeneral = 0; @endphp
                        @foreach($panierItems as $id => $item)
                            @php
                                $totalItem = ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
                                $totalGeneral += $totalItem;
                            @endphp
                            <tr>
                                <td class="d-none d-md-table-cell" style="width: 100px;">
                                    <img src="{{ $item['image_url'] ?? 'https://picsum.photos/seed/item'.$id.'/100' }}" alt="{{ $item['name'] ?? 'Produit' }}" class="img-fluid rounded" style="max-height: 75px;">
                                </td>
                                <td>
                                    <h5 class="mb-0 product-name-cart">{{ $item['name'] ?? 'Nom du produit' }}</h5>
                                    {{-- <small class="text-muted">Référence: XYZ123</small> --}}
                                </td>
                                <td class="text-center">
                                    {{-- Formulaire pour mettre à jour la quantité --}}
                                    {{-- <form action="{{ route('ecommerce.cart.update') }}" method="POST" class="d-inline-flex align-items-center">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $id }}">
                                        <input type="number" name="quantity" value="{{ $item['quantity'] ?? 1 }}" min="1" class="form-control form-control-sm" style="width: 70px;">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary ms-2" title="Mettre à jour"><i class="fas fa-sync-alt"></i></button>
                                    </form> --}}
                                    {{ $item['quantity'] ?? 1 }}
                                </td>
                                <td class="text-end">{{ number_format($item['price'] ?? 0, 2, ',', ' ') }} €</td>
                                <td class="text-end fw-bold">{{ number_format($totalItem, 2, ',', ' ') }} €</td>
                                <td class="text-center">
                                    {{-- Formulaire pour supprimer l'article --}}
                                    {{-- <form action="{{ route('ecommerce.cart.remove') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $id }}">
                                        <button type="submit" class="btn btn-sm btn-danger" title="Supprimer"><i class="fas fa-trash-alt"></i></button>
                                    </form> --}}
                                    <button onclick="alert('Fonctionnalité de suppression non implémentée pour le moment.')" class="btn btn-sm btn-danger" title="Supprimer"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row justify-content-end">
                <div class="col-md-6 col-lg-4">
                    <div class="cart-summary p-3 border rounded">
                        <h3 class="h5 mb-3">Récapitulatif</h3>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Sous-total :</span>
                            <span>{{ number_format($totalGeneral, 2, ',', ' ') }} €</span>
                        </div>
                        {{-- <div class="d-flex justify-content-between mb-2">
                            <span>Frais de livraison :</span>
                            <span>À calculer</span>
                        </div> --}}
                        <hr>
                        <div class="d-flex justify-content-between fw-bold h5 mb-3">
                            <span>Total Général :</span>
                            <span>{{ number_format($totalGeneral, 2, ',', ' ') }} €</span>
                        </div>
                        <div class="d-grid gap-2">
                            <a href="{{ route('ecommerce.commande.checkout') }}" class="btn btn-primary btn-lg">
                                Passer la Commande <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                            {{-- <form action="{{ route('ecommerce.cart.clear') }}" method="POST" class="d-grid">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger mt-2" onclick="return confirm('Voulez-vous vraiment vider votre panier ?')">Vider le Panier</button>
                            </form> --}}
                             <button onclick="alert('Fonctionnalité de vidage de panier non implémentée.')" class="btn btn-outline-danger mt-2">Vider le Panier</button>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                <h4 class="mb-3">Votre panier est actuellement vide.</h4>
                <p class="text-muted mb-4">Parcourez nos articles pour trouver votre bonheur !</p>
                <a href="{{ route('ecommerce.articles.index') }}" class="btn btn-primary">
                    <i class="fas fa-store me-2"></i> Continuer Mes Achats
                </a>
            </div>
        @endif
    </div>
</main>
@endsection

@push('scripts')
<script>
    // Si des interactions JS sont nécessaires pour le panier (ex: màj quantité en AJAX)
    // Pour l'instant, on garde simple avec des alertes pour les actions non implémentées
    // document.addEventListener('DOMContentLoaded', function() {
    //     const alertSuccess = document.querySelector('.alert-success');
    //     if(alertSuccess && alertSuccess.innerText.includes('Produit ajouté au panier !')) {
    //          // alert('Produit ajouté au panier ! (Message de la vue Panier)'); // Pour la consigne JS
    //     }
    // });
</script>
@endpush
