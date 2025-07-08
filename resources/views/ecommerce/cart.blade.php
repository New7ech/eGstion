@extends('ecommerce.layouts.app')

@section('title', 'Votre Panier d\'Achat')

@section('content')
<div class="page-inner-ecommerce cart-page py-5">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title mb-0">Votre Panier</h1>
        </div>
        <div class="card-body">
            @if(isset($cartItems) && count($cartItems) > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" colspan="2">Produit</th>
                                <th scope="col" class="text-center">Prix Unitaire</th>
                                <th scope="col" class="text-center">Quantité</th>
                                <th scope="col" class="text-center">Total</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                                <tr>
                                    <td style="width: 100px;">
                                        <a href="{{ route('ecommerce.product.show', $item['slug']) }}">
                                            <img src="{{ $item['image_url'] ?? asset('assets/img/examples/product-default-thumb.jpg') }}"
                                                 alt="{{ $item['name'] }}" class="img-fluid rounded" style="max-height: 75px; object-fit: cover;">
                                        </a>
                                    </td>
                                    <td>
                                        <h5 class="mb-0 fs-6">
                                            <a href="{{ route('ecommerce.product.show', $item['slug']) }}" class="text-dark text-decoration-none">{{ $item['name'] }}</a>
                                        </h5>
                                        {{-- <small class="text-muted">SKU: XYZ123</small> --}}
                                    </td>
                                    <td class="text-center">
                                        {{ number_format($item['price'], 2, ',', ' ') }} €
                                    </td>
                                    <td class="text-center" style="min-width: 150px;">
                                        <form action="{{ route('ecommerce.cart.update') }}" method="POST" class="d-inline-flex align-items-center cart-update-form">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm text-center me-2" style="width: 70px;">
                                            <button type="submit" class="btn btn-outline-primary btn-sm" title="Mettre à jour">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center fw-bold">
                                        {{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} €
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('ecommerce.cart.remove') }}" method="POST" class="cart-remove-form">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                            <button type="submit" class="btn btn-danger btn-sm" title="Supprimer l'article">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <a href="{{ route('ecommerce.home') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Continuer mes achats
                        </a>
                        <form action="{{ route('ecommerce.cart.clear') }}" method="POST" class="d-inline-block ms-2 cart-clear-form">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="fas fa-times-circle me-1"></i> Vider le panier
                            </button>
                        </form>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="cart-summary mt-3 mt-md-0">
                            <h4>Récapitulatif du panier</h4>
                            <p class="fs-5">Sous-total : <span class="fw-bold">{{ number_format($total, 2, ',', ' ') }} €</span></p>
                            <p class="text-muted small">Taxes et frais de livraison calculés à l'étape suivante.</p>
                            <a href="{{ route('ecommerce.checkout.index') }}" class="btn btn-primary btn-lg w-100">
                                Passer la commande <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

            @else
                <div class="text-center py-5">
                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                    <h4 class="mb-3">Votre panier est vide.</h4>
                    <p class="text-muted">Parcourez nos produits et trouvez votre bonheur !</p>
                    <a href="{{ route('ecommerce.home') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-store me-1"></i> Aller à la boutique
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Confirmation avant de vider le panier
    const clearCartForms = document.querySelectorAll('.cart-clear-form');
    clearCartForms.forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            swal({
                title: "Vider le panier ?",
                text: "Êtes-vous sûr de vouloir supprimer tous les articles de votre panier ?",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "Annuler",
                        visible: true,
                        className: "btn btn-secondary",
                    },
                    confirm: {
                        text: "Oui, vider",
                        className: "btn btn-danger",
                    },
                },
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    });

    // Confirmation avant de supprimer un article (optionnel, le contrôleur gère déjà la redirection)
    // const removeForms = document.querySelectorAll('.cart-remove-form');
    // removeForms.forEach(form => {
    //     form.addEventListener('submit', function(event) {
    //         // ... logique de confirmation similaire si souhaité ...
    //     });
    // });
});
</script>
@endpush

@push('styles')
<style>
    .cart-page .table th, .cart-page .table td {
        vertical-align: middle;
    }
    .cart-page .form-control-sm {
        height: calc(1.5em + 0.5rem + 2px); /* Ajustement Bootstrap */
        padding: 0.25rem 0.5rem;
        font-size: .875rem;
    }
    .cart-summary {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 0.25rem;
    }
</style>
@endpush
