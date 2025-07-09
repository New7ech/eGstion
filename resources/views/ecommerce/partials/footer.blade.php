<footer class="ecommerce-footer mt-auto py-8 md:py-12 bg-gray-800 text-gray-300">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            {{-- Colonne 1: Nom de la boutique et Réseaux Sociaux --}}
            <div class="mb-6 md:mb-0">
                <h5 class="text-xl font-semibold text-white mb-4">Gestlog E-Commerce</h5>
                <p class="text-gray-400 mb-4 text-sm">
                    Votre solution de gestion et d'achat en ligne. Qualité et service à portée de clic.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300" aria-label="Facebook">
                        {{-- Heroicon: Facebook (custom simple path) --}}
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300" aria-label="Twitter">
                        {{-- Heroicon: Twitter (custom simple path) --}}
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-.422.724-.665 1.56-.665 2.452 0 1.606.817 3.022 2.059 3.855-.758-.023-1.47-.231-2.096-.58v.06c0 2.238 1.592 4.103 3.7 4.53-.387.105-.796.16-1.21.16-.299 0-.588-.028-.87-.083.588 1.839 2.295 3.178 4.322 3.215-1.581 1.238-3.576 1.975-5.752 1.975-.375 0-.743-.022-1.107-.065 2.042 1.318 4.473 2.088 7.08 2.088 7.495 0 12.015-6.534 11.29-12.815.804-.583 1.498-1.312 2.04-2.125z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300" aria-label="Instagram">
                        {{-- Heroicon: Instagram (custom simple path) --}}
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.069-4.85.069-3.204 0-3.584-.012-4.849-.069-3.224-.148-4.771-1.664-4.919-4.919-.058-1.265-.069-1.645-.069-4.849 0-3.204.013-3.583.069-4.849.149-3.227 1.664-4.771 4.919-4.919.058-1.265.069-1.645.069-4.849zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.359 2.618 6.78 6.98 6.98 1.281.059 1.689.073 4.948.073s3.667-.014 4.947-.072c4.359-.2 6.78-2.618 6.98-6.98.059-1.281.073-1.689.073-4.948s-.014-3.667-.072-4.947c-.2-4.359-2.618-6.78-6.98-6.98-1.281-.059-1.689-.073-4.948-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.162 6.162 6.162 6.162-2.759 6.162-6.162-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4s1.791-4 4-4 4 1.79 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300" aria-label="LinkedIn">
                        {{-- Heroicon: LinkedIn (custom simple path) --}}
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.594-11.018-3.714v-2.155z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Colonne 2: Liens Rapides --}}
            <div class="mb-6 md:mb-0">
                <h5 class="text-xl font-semibold text-white mb-4">Liens Rapides</h5>
                <ul class="space-y-2">
                    <li><a href="{{ route('ecommerce.home') }}" class="text-gray-400 hover:text-white transition-colors duration-300 text-sm">Accueil Boutique</a></li>
                    <li><a href="{{ url('/produits') }}" class="text-gray-400 hover:text-white transition-colors duration-300 text-sm">Tous les Produits</a></li>
                    <li><a href="{{ url('/promotions') }}" class="text-gray-400 hover:text-white transition-colors duration-300 text-sm">Promotions</a></li>
                    <li><a href="{{ route('ecommerce.cart.index') }}" class="text-gray-400 hover:text-white transition-colors duration-300 text-sm">Mon Panier</a></li>
                    <li><a href="{{ route('ecommerce.order.track') }}" class="text-gray-400 hover:text-white transition-colors duration-300 text-sm">Suivre ma Commande</a></li>
                </ul>
            </div>

            {{-- Colonne 3: Service Client --}}
            <div class="mb-6 md:mb-0">
                <h5 class="text-xl font-semibold text-white mb-4">Service Client</h5>
                <ul class="space-y-2">
                    <li><a href="{{ url('/contact') }}" class="text-gray-400 hover:text-white transition-colors duration-300 text-sm">Contactez-nous</a></li>
                    <li><a href="{{ url('/faq') }}" class="text-gray-400 hover:text-white transition-colors duration-300 text-sm">FAQ</a></li>
                    <li><a href="{{ url('/politique-retour') }}" class="text-gray-400 hover:text-white transition-colors duration-300 text-sm">Politique de Retour</a></li>
                    <li><a href="{{ url('/cgv') }}" class="text-gray-400 hover:text-white transition-colors duration-300 text-sm">Conditions Générales de Vente</a></li>
                    <li><a href="{{ url('/confidentialite') }}" class="text-gray-400 hover:text-white transition-colors duration-300 text-sm">Politique de Confidentialité</a></li>
                </ul>
            </div>

            {{-- Colonne 4: Contact Info --}}
            <div>
                <h5 class="text-xl font-semibold text-white mb-4">Contact Info</h5>
                <ul class="space-y-3 text-gray-400 text-sm">
                    <li class="flex items-start">
                        {{-- Heroicon: MapPin --}}
                        <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.145l.002-.001L10 18.48l-.308.453a5.741 5.741 0 00.281.145l.018.008.006.003zM10 16.57c1.514 0 2.75 1.236 2.75 2.75S11.514 22 10 22s-2.75-1.236-2.75-2.75S8.486 16.57 10 16.57zM10 0C5.582 0 2 3.582 2 8c0 1.993.805 3.814 2.123 5.178L10 20l5.877-6.822C17.195 11.814 18 9.993 18 8c0-4.418-3.582-8-8-8zm0 12a4 4 0 110-8 4 4 0 010 8z" clip-rule="evenodd" /></svg>
                        <span>123 Rue de l'Exemple, 75000 Ville, Pays</span>
                    </li>
                    <li class="flex items-center">
                        {{-- Heroicon: Phone --}}
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" /></svg>
                        <span>+33 1 23 45 67 89</span>
                    </li>
                    <li class="flex items-center">
                        {{-- Heroicon: Envelope --}}
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M3 4a2 2 0 00-2 2v8a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2H3zm12 1a1 1 0 011 .883l-5.5 3.438-5.5-3.437A1 1 0 015 5h10z" /><path d="M16.5 7.534l-5.18 3.237a1.5 1.5 0 01-1.64 0L4.5 7.534V14a1 1 0 001 1h9a1 1 0 001-1V7.534z" /></svg>
                        <span>contact@gestlogshop.com</span>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="my-6 md:my-8 border-gray-700">
        <div class="sm:flex sm:justify-between sm:items-center text-center sm:text-left">
            <p class="text-sm text-gray-400 mb-4 sm:mb-0">
                &copy; {{ date('Y') }} {{ config('app.name', 'Gestlog') }}. Tous droits réservés.
            </p>
            <p class="text-sm text-gray-400">
                Propulsé avec <span class="text-red-400">&hearts;</span> par KaiAdmin & Laravel
            </p>
        </div>
    </div>
</footer>
