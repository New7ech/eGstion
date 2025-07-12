@extends('ecommerce.layouts.app') {{-- Assurez-vous que ce layout existe --}}

@section('title', 'Confirmation de Commande')

@section('content')
<main class="page-inner-ecommerce confirmation-page section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">

                @if(session('succes'))
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle fa-3x mb-3 text-success"></i>
                        <h1 class="display-5 mb-3">Merci ! Votre commande est confirmée.</h1>
                        <p class="lead">{{ session('succes') }}</p>
                    </div>
                @else
                    {{-- Fallback si pas de message de succès spécifique mais la page est atteinte --}}
                    <i class="fas fa-check-circle fa-3x mb-3 text-success"></i>
                    <h1 class="display-5 mb-3">Merci ! Votre commande est confirmée.</h1>
                @endif

                @if(isset($commande) && $commande)
                    <div class="order-details-summary my-4 p-4 border rounded bg-light">
                        <h4 class="mb-3">Détails de votre commande :</h4>
                        <p><strong>Numéro de commande :</strong> {{ $commande->numero_commande ?? $commande->id }}</p>
                        {{-- Vous pouvez ajouter plus de détails ici si vous les passez depuis le contrôleur --}}
                        {{-- Exemple:
                        <p><strong>Date :</strong> {{ $commande->date_creation ?? now()->format('d/m/Y') }}</p>
                        <p><strong>Montant total :</strong> {{ number_format($commande->total ?? 0, 2, ',', ' ') }} €</p>
                        --}}
                        @if(isset($commande->message))
                            <p>{{ $commande->message }}</p>
                        @endif
                    </div>
                    <p class="text-muted">Un e-mail de confirmation avec les détails de votre commande vous sera envoyé prochainement (simulation).</p>
                @else
                    <p class="text-muted">Les détails de votre commande seront bientôt disponibles ou ont été envoyés par email.</p>
                @endif

                <div class="mt-5">
                    <a href="{{ route('ecommerce.home') }}" class="btn btn-primary btn-lg me-2 mb-2">
                        <i class="fas fa-home me-2"></i> Retour à l'accueil de la boutique
                    </a>
                    <a href="{{ route('ecommerce.articles.index') }}" class="btn btn-outline-secondary btn-lg mb-2">
                        <i class="fas fa-shopping-bag me-2"></i> Continuer vos achats
                    </a>
                </div>

            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    // Effet simple pour la page de confirmation
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.querySelector('.alert-success');
        if(successAlert) {
            // Simuler un effet d'apparition
            successAlert.style.opacity = 0;
            setTimeout(() => {
                successAlert.style.transition = 'opacity 0.5s ease-in-out';
                successAlert.style.opacity = 1;
            }, 100);

            // Consigne JS: Afficher une alerte (peut être redondant avec le message de succès)
            // alert('Commande confirmée avec succès! (Message JS de la page de confirmation)');
        }
    });
</script>
@endpush
