@extends('ecommerce.layouts.app') {{-- Assurez-vous que ce layout existe --}}

@section('title', 'Finaliser ma Commande')

@section('content')
<main class="page-inner-ecommerce checkout-page section-padding">
    <div class="container">
        <header class="section-header text-center mb-5">
            <h1 class="section-title">Finalisation de la Commande</h1>
            <p class="section-tagline">Veuillez vérifier vos informations et procéder au paiement.</p>
        </header>

        @if(isset($panierItems) && count($panierItems) > 0)
            <form action="{{ route('ecommerce.commande.process') }}" method="POST" id="checkout-form">
                @csrf
                <div class="row">
                    <!-- Colonne Informations Client -->
                    <div class="col-lg-7 mb-4 mb-lg-0">
                        <section class="checkout-section p-4 border rounded">
                            <h3 class="section-subtitle mb-4">Vos Informations</h3>

                            {{-- Champ Nom Complet --}}
                            <div class="mb-3">
                                <label for="nom_complet" class="form-label">Nom complet <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nom_complet" name="nom_complet" required>
                            </div>

                            {{-- Champ Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse e-mail <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            {{-- Champ Adresse de Livraison --}}
                            <div class="mb-3">
                                <label for="adresse_livraison" class="form-label">Adresse de livraison <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="adresse_livraison" name="adresse_livraison" rows="3" required></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="ville" class="form-label">Ville <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="ville" name="ville" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="code_postal" class="form-label">Code Postal <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="code_postal" name="code_postal" required>
                                </div>
                            </div>
                             <div class="mb-3">
                                <label for="pays" class="form-label">Pays <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="pays" name="pays" value="France" required> {{-- Valeur par défaut exemple --}}
                            </div>


                            {{-- Champ Informations de Paiement (Simplifié) --}}
                            <h4 class="mt-4 mb-3">Informations de Paiement (Simulation)</h4>
                            <div class="mb-3">
                                <label for="nom_carte" class="form-label">Nom sur la carte <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nom_carte" name="payment_details[card_name]" value="Test User" required>
                            </div>
                            <div class="mb-3">
                                <label for="num_carte" class="form-label">Numéro de carte <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="num_carte" name="payment_details[card_number]" value="0000111122223333" required placeholder="0000 0000 0000 0000">
                            </div>
                            <div class="row">
                                <div class="col-md-7 mb-3">
                                    <label for="date_exp" class="form-label">Date d'expiration (MM/AA) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="date_exp" name="payment_details[expiry_date]" value="12/25" required placeholder="MM/AA">
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label for="cvc" class="form-label">CVC <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="cvc" name="payment_details[cvc]" value="123" required placeholder="123">
                                </div>
                            </div>
                            <p class="text-muted small">Ceci est une simulation. Aucune transaction réelle ne sera effectuée.</p>
                        </section>
                    </div>

                    <!-- Colonne Récapitulatif Commande -->
                    <div class="col-lg-5">
                        <aside class="checkout-summary-aside p-4 border rounded sticky-top" style="top: 20px;">
                            <h3 class="section-subtitle mb-4">Récapitulatif de votre Commande</h3>
                            @if(isset($panierItems) && count($panierItems) > 0)
                                <ul class="list-group list-group-flush mb-3">
                                    @php $totalGeneral = 0; @endphp
                                    @foreach($panierItems as $id => $item)
                                        @php
                                            $totalItem = ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
                                            $totalGeneral += $totalItem;
                                        @endphp
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            <div>
                                                {{ $item['name'] ?? 'Produit' }}
                                                <small class="d-block text-muted">Quantité: {{ $item['quantity'] ?? 1 }}</small>
                                            </div>
                                            <span class="text-muted">{{ number_format($totalItem, 2, ',', ' ') }} €</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <hr>
                                <div class="d-flex justify-content-between h5 fw-bold mb-4">
                                    <span>Total à Payer :</span>
                                    <span>{{ number_format($totalGeneral, 2, ',', ' ') }} €</span>
                                </div>
                                <input type="hidden" name="total_commande" value="{{ $totalGeneral }}">

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-lock me-2"></i> Payer et Confirmer la Commande
                                    </button>
                                </div>
                                <p class="text-center text-muted small mt-3">
                                    En cliquant sur "Payer", vous confirmez votre commande.
                                </p>
                            @else
                                <p>Votre panier est vide. Impossible de finaliser la commande.</p>
                                <a href="{{ route('ecommerce.articles.index') }}" class="btn btn-secondary">Retourner aux articles</a>
                            @endif
                        </aside>
                    </div>
                </div>
            </form>
        @else
            <div class="text-center py-5">
                <i class="fas fa-exclamation-circle fa-4x text-muted mb-3"></i>
                <h4 class="mb-3">Votre panier est vide.</h4>
                <p class="text-muted mb-4">Vous ne pouvez pas finaliser une commande sans article dans votre panier.</p>
                <a href="{{ route('ecommerce.articles.index') }}" class="btn btn-primary">
                    <i class="fas fa-store me-2"></i> Découvrir nos articles
                </a>
            </div>
        @endif
    </div>
</main>
@endsection

@push('scripts')
<script>
    document.getElementById('checkout-form')?.addEventListener('submit', function(e) {
        // Validation JS simple (optionnelle, Laravel s'en charge côté serveur)
        var nomComplet = document.getElementById('nom_complet').value;
        if(nomComplet.trim() === "") {
            alert("Veuillez entrer votre nom complet.");
            // e.preventDefault(); // Empêche la soumission
            // return;
        }
        // ... autres validations si besoin ...

        // Pour la consigne JS simple:
        // alert('La commande va être traitée. (Simulation côté client)');
        // Pas de e.preventDefault() ici pour laisser le formulaire se soumettre normalement.
    });
</script>
@endpush
