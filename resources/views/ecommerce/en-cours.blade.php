@extends('ecommerce.layouts.app') {{-- Assurez-vous que ce layout existe --}}

@section('title', 'Page en Construction')

@section('content')
<main class="page-inner-ecommerce placeholder-page section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="icon-wrapper mb-4">
                    <i class="fas fa-tools fa-5x text-primary"></i>
                </div>
                <h1 class="display-4">Page en Construction</h1>
                <p class="lead text-muted">
                    Nous travaillons actuellement sur cette section pour vous offrir la meilleure expérience possible.
                </p>
                <p class="mb-4">
                    Cette page sera bientôt disponible avec de nouvelles fonctionnalités et informations. Merci de votre patience !
                </p>

                {{-- Compte à rebours (optionnel, purement visuel en JS) --}}
                {{-- <div id="countdown" class="h4 my-4"></div> --}}

                <div class="mt-4">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-2 mb-2">
                        <i class="fas fa-arrow-left me-2"></i> Page Précédente
                    </a>
                    <a href="{{ route('ecommerce.home') }}" class="btn btn-primary mb-2">
                        <i class="fas fa-home me-2"></i> Retour à l'Accueil
                    </a>
                </div>

                {{-- Liens vers les réseaux sociaux ou formulaire de contact (optionnel) --}}
                {{-- <div class="social-links mt-5">
                    <p>Suivez-nous pour les mises à jour :</p>
                    <a href="#" class="btn btn-link"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="#" class="btn btn-link"><i class="fab fa-twitter fa-2x"></i></a>
                    <a href="#" class="btn btn-link"><i class="fab fa-instagram fa-2x"></i></a>
                </div> --}}

            </div>
        </div>
    </div>
</main>
@endsection

@push('styles')
<style>
    .placeholder-page .icon-wrapper {
        animation: bounceIcon 2s infinite;
    }
    @keyframes bounceIcon {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-20px);
        }
        60% {
            transform: translateY(-10px);
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Script simple pour la page "en cours"
    // Par exemple, un compte à rebours factice (si vous ajoutez le div#countdown)
    /*
    function startCountdown() {
        var countDownDate = new Date(Date.now() + 3 * 24 * 60 * 60 * 1000).getTime(); // 3 jours à partir de maintenant
        var countdownElement = document.getElementById("countdown");

        if(!countdownElement) return;

        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownElement.innerHTML = days + "j " + hours + "h "
            + minutes + "m " + seconds + "s ";

            if (distance < 0) {
                clearInterval(x);
                countdownElement.innerHTML = "Bientôt disponible !";
            }
        }, 1000);
    }
    document.addEventListener('DOMContentLoaded', startCountdown);
    */
   console.log("Page 'En cours de construction' chargée.");
   // JS simple pour consigne:
   // alert("Cette page est en cours de construction. Revenez bientôt ! (Message JS)");
</script>
@endpush
