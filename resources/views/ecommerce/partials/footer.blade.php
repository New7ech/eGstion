<footer class="footer ecommerce-footer mt-auto py-3 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h5 class="text-uppercase mb-3">Gestlog E-Commerce</h5>
                <p class="text-muted">
                    Votre solution de gestion et d'achat en ligne.
                    Qualité et service à portée de clic.
                </p>
                <ul class="list-inline mt-3">
                    <li class="list-inline-item"><a href="#" class="text-muted"><i class="fab fa-facebook fa-lg"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="text-muted"><i class="fab fa-twitter fa-lg"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="text-muted"><i class="fab fa-instagram fa-lg"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="text-muted"><i class="fab fa-linkedin fa-lg"></i></a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h5 class="text-uppercase mb-3">Liens Rapides</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('ecommerce.home') }}" class="text-muted">Accueil Boutique</a></li>
                    <li><a href="#" class="text-muted">Tous les Produits</a></li>
                    <li><a href="#" class="text-muted">Promotions</a></li>
                    <li><a href="#" class="text-muted">Mon Panier</a></li>
                    <li><a href="#" class="text-muted">Suivre ma Commande</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h5 class="text-uppercase mb-3">Service Client</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-muted">Contactez-nous</a></li>
                    <li><a href="#" class="text-muted">FAQ</a></li>
                    <li><a href="#" class="text-muted">Politique de Retour</a></li>
                    <li><a href="#" class="text-muted">Conditions Générales de Vente</a></li>
                    <li><a href="#" class="text-muted">Politique de Confidentialité</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="text-uppercase mb-3">Contact Info</h5>
                <ul class="list-unstyled text-muted">
                    <li><i class="fas fa-map-marker-alt me-2"></i> 123 Rue de l'Exemple, Ville, Pays</li>
                    <li><i class="fas fa-phone me-2"></i> +33 1 23 45 67 89</li>
                    <li><i class="fas fa-envelope me-2"></i> contact@gestlogshop.com</li>
                </ul>
            </div>
        </div>
        <hr class="my-3">
        <div class="row">
            <div class="col-md-6">
                <p class="text-muted mb-0">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Gestlog') }}. Tous droits réservés.
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                {{-- <img src="{{ asset('assets/img/payments.png') }}" alt="Moyens de paiement" height="30"> --}}
                <p class="text-muted mb-0">Propulsé par KaiAdmin & Laravel</p>
            </div>
        </div>
    </div>
</footer>
