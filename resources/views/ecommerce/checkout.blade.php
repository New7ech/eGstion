@extends('ecommerce.layouts.app')

@section('title', 'Passer la Commande')

@section('content')
<div class="page-inner-ecommerce checkout-page py-5">
    <h1 class="text-center mb-5">Finaliser ma Commande</h1>

    <form action="{{ route('ecommerce.checkout.process') }}" method="POST" id="checkout-form" class="needs-validation" novalidate>
        @csrf
        <div class="row g-5">
            <!-- Colonne Informations Client et Livraison -->
            <div class="col-md-7 col-lg-7 order-md-first">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informations de Livraison</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="customer_name" class="form-label">Nom complet <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer votre nom complet.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="customer_email" class="form-label">Adresse e-mail <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="customer_email" name="customer_email" value="{{ old('customer_email') }}" placeholder="you@example.com" required>
                                <div class="invalid-feedback">
                                    Une adresse e-mail valide est requise.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="customer_phone" class="form-label">Téléphone <span class="text-muted">(Optionnel)</span></label>
                                <input type="tel" class="form-control" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" placeholder="0612345678">
                            </div>

                            <div class="col-12">
                                <label for="shipping_address_line1" class="form-label">Adresse (Ligne 1) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="shipping_address_line1" name="shipping_address_line1" value="{{ old('shipping_address_line1') }}" placeholder="1234 Rue Principale" required>
                                <div class="invalid-feedback">
                                    L'adresse de livraison est requise.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="shipping_address_line2" class="form-label">Adresse (Ligne 2) <span class="text-muted">(Optionnel)</span></label>
                                <input type="text" class="form-control" id="shipping_address_line2" name="shipping_address_line2" value="{{ old('shipping_address_line2') }}" placeholder="Appartement, étage, etc.">
                            </div>

                            <div class="col-md-5">
                                <label for="shipping_address_postal_code" class="form-label">Code Postal <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="shipping_address_postal_code" name="shipping_address_postal_code" value="{{ old('shipping_address_postal_code') }}" required>
                                <div class="invalid-feedback">
                                    Le code postal est requis.
                                </div>
                            </div>

                            <div class="col-md-7">
                                <label for="shipping_address_city" class="form-label">Ville <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="shipping_address_city" name="shipping_address_city" value="{{ old('shipping_address_city') }}" required>
                                <div class="invalid-feedback">
                                    La ville est requise.
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="shipping_address_country" class="form-label">Pays <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="shipping_address_country" name="shipping_address_country" value="{{ old('shipping_address_country', 'France') }}" required>
                                {{-- Ou utiliser un select si liste de pays prédéfinie --}}
                                <div class="invalid-feedback">
                                    Le pays est requis.
                                </div>
                            </div>
                             <div class="col-12">
                                <label for="notes" class="form-label">Notes de commande <span class="text-muted">(Optionnel)</span></label>
                                <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Instructions spéciales pour la livraison...">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        <hr class="my-4">
                        {{-- Section Paiement (simplifiée pour paiement à la livraison) --}}
                        <h4 class="mb-3">Paiement</h4>
                        <div class="my-3">
                            <div class="form-check">
                                <input id="cash_on_delivery" name="payment_method" type="radio" class="form-check-input" value="cash_on_delivery" checked required>
                                <label class="form-check-label" for="cash_on_delivery">Paiement à la livraison</label>
                            </div>
                            {{-- Autres options de paiement à ajouter ici --}}
                            {{-- <div class="form-check">
                                <input id="credit" name="paymentMethod" type="radio" class="form-check-input" required>
                                <label class="form-check-label" for="credit">Carte de crédit</label>
                            </div> --}}
                        </div>
                        <p class="text-muted small">Vous paierez votre commande en espèces ou par carte (selon disponibilité du livreur) au moment de la réception de vos articles.</p>

                    </div>
                </div>
            </div>

            <!-- Colonne Récapitulatif Panier -->
            <div class="col-md-5 col-lg-5 order-md-last">
                <div class="card sticky-top" style="top: 80px;"> {{-- sticky-top pour que le récap suive le scroll --}}
                    <div class="card-header">
                        <h4 class="d-flex justify-content-between align-items-center mb-0">
                            <span class="text-primary">Votre Panier</span>
                            <span class="badge bg-primary rounded-pill">{{ count($cartItems) }}</span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group mb-3">
                            @php $calculatedTotal = 0; @endphp
                            @foreach($cartItems as $item)
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <div>
                                        <h6 class="my-0">{{ $item['name'] }}</h6>
                                        <small class="text-muted">Quantité: {{ $item['quantity'] }}</small>
                                    </div>
                                    <span class="text-muted">{{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} €</span>
                                </li>
                                @php $calculatedTotal += $item['price'] * $item['quantity']; @endphp
                            @endforeach

                            {{-- Frais de livraison (exemple statique) --}}
                            @php
                                $shippingCost = 5.00; // Exemple, à rendre dynamique
                                $grandTotal = $calculatedTotal + $shippingCost;
                            @endphp
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Sous-total (TTC)</span>
                                <strong>{{ number_format($calculatedTotal, 2, ',', ' ') }} €</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Frais de livraison</span>
                                <strong>{{ number_format($shippingCost, 2, ',', ' ') }} €</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <span class="fw-bold">Total (TTC)</span>
                                <strong class="fw-bold fs-5">{{ number_format($grandTotal, 2, ',', ' ') }} €</strong>
                            </li>
                        </ul>
                        {{-- Champ caché pour le total, même si calculé côté serveur, par sécurité --}}
                        <input type="hidden" name="total_amount_check" value="{{ $grandTotal }}">
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary btn-lg w-100" type="submit">
                            <i class="fas fa-shield-alt me-2"></i> Confirmer et Payer à la Livraison
                        </button>
                         <p class="text-muted small mt-2 text-center">En cliquant sur ce bouton, vous confirmez votre commande et acceptez nos <a href="#">Conditions Générales de Vente</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    .checkout-page .card {
        margin-bottom: 1.5rem;
    }
</style>
@endpush

@push('scripts')
<script>
// Script de validation Bootstrap standard (déjà dans le layout principal, mais on le garde ici pour référence si besoin d'ajustements spécifiques)
(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
})()
</script>
@endpush
