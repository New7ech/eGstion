@extends('ecommerce.layouts.app')

@section('title', 'Suivre votre Commande')

@section('content')
<div class="page-inner-ecommerce order-status-form-page py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title mb-0 text-center">Suivre votre Commande</h1>
                    </div>
                    <div class="card-body">
                        <p class="text-center text-muted mb-4">
                            Veuillez entrer votre numéro de commande et votre adresse e-mail pour consulter le statut de votre commande.
                        </p>

                        <form action="{{ route('ecommerce.order.track') }}" method="GET" class="needs-validation" novalidate>
                            {{-- Pas besoin de @csrf pour une méthode GET --}}
                            <div class="mb-3">
                                <label for="order_number" class="form-label">Numéro de commande <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="order_number" name="order_number" value="{{ old('order_number', request()->input('order_number')) }}" placeholder="Ex: ORD-20240101-ABCDEF" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer votre numéro de commande.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse e-mail <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', request()->input('email')) }}" placeholder="you@example.com" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer l'adresse e-mail utilisée pour la commande.
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-search me-1"></i> Rechercher ma commande
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                     <a href="{{ route('ecommerce.home') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Retour à la boutique
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Script de validation Bootstrap standard
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
