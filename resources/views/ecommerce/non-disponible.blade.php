@extends('ecommerce.layouts.app') {{-- Assurez-vous que ce layout existe --}}

@section('title', 'Contenu Non Disponible')

@section('content')
<main class="page-inner-ecommerce placeholder-page section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="icon-wrapper mb-4">
                    {{-- Vous pouvez utiliser une icône différente pour "non disponible" --}}
                    <i class="fas fa-exclamation-triangle fa-5x text-warning"></i>
                </div>
                <h1 class="display-4">Contenu Non Disponible</h1>
                <p class="lead text-muted">
                    Désolé, la page ou la ressource que vous recherchez n'est actuellement pas disponible.
                </p>
                <p class="mb-4">
                    Cela peut être dû à une maintenance, une mise à jour, ou le contenu a été déplacé ou supprimé.
                    Nous vous prions de nous excuser pour ce désagrément.
                </p>

                <div class="mt-4">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-2 mb-2">
                        <i class="fas fa-arrow-left me-2"></i> Page Précédente
                    </a>
                    <a href="{{ route('ecommerce.home') }}" class="btn btn-primary mb-2">
                        <i class="fas fa-home me-2"></i> Retour à l'Accueil
                    </a>
                </div>

                {{-- Section d'aide ou contact (optionnel) --}}
                <div class="help-section mt-5 border-top pt-4">
                    <p class="text-muted">Si vous pensez qu'il s'agit d'une erreur, ou si vous ne trouvez pas ce que vous cherchez, n'hésitez pas à nous contacter :</p>
                    {{-- Remplacez '#' par la route de votre page de contact si elle existe --}}
                    <a href="#" class="btn btn-info">
                        <i class="fas fa-envelope me-2"></i> Nous Contacter
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('styles')
<style>
    /* Styles spécifiques si nécessaire, peuvent être partagés avec en-cours.blade.php */
    .placeholder-page .icon-wrapper i.fa-exclamation-triangle {
        /* Animation spécifique si différente de fa-tools */
         animation: pulseIcon 1.5s infinite ease-in-out;
    }

    @keyframes pulseIcon {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
</style>
@endpush

@push('scripts')
<script>
   console.log("Page 'Contenu non disponible' chargée.");
   // JS simple pour consigne:
   // alert("Le contenu que vous cherchez n'est pas disponible. (Message JS)");
</script>
@endpush
