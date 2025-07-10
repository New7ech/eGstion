{{-- Ce footer est conçu pour être inclus dans `ecommerce.layouts.app` --}}
{{-- Il utilise TailwindCSS pour le style, en accord avec les autres sections de la page d'accueil. --}}
<footer class="bg-gray-800 text-gray-300 pt-12 pb-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">

            {{-- Colonne 1: Logo et description --}}
            <div>
                <h5 class="text-xl font-bold text-white mb-4">[Nom de la Boutique]</h5>
                <p class="text-sm leading-relaxed">
                    Votre destination unique pour des produits de qualité supérieure. Nous nous engageons à vous offrir la meilleure expérience d'achat en ligne.
                </p>
                {{-- Icônes Réseaux Sociaux (Heroicons) --}}
                <div class="mt-6 flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300" aria-label="Facebook">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300" aria-label="Instagram">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2.014a.828.828 0 01.557 0l6.427 2.963c.31.144.557.478.557.846v5.09c0 .368-.247.702-.557.846l-6.427 2.963a.828.828 0 01-.557 0l-6.427-2.963a.828.828 0 01-.557-.846v-5.09c0-.368.247-.702.557-.846L12.315 2.014zM12 6.75a5.25 5.25 0 100 10.5 5.25 5.25 0 000-10.5zm0 8.25a3 3 0 100-6 3 3 0 000 6zm6.75-9.75a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z" clip-rule="evenodd" /></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300" aria-label="Twitter">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                    </a>
                </div>
            </div>

            {{-- Colonne 2: Liens Rapides --}}
            <div>
                <h5 class="text-xl font-bold text-white mb-4">Liens Rapides</h5>
                <ul class="space-y-2">
                    <li><a href="{{ route('ecommerce.home') }}" class="hover:text-white transition-colors duration-300">Accueil</a></li>
                    <li><a href="{{ route('produits.index') }}" class="hover:text-white transition-colors duration-300">Produits</a></li> {{-- Assurez-vous que cette route existe --}}
                    <li><a href="{{ route('about') }}" class="hover:text-white transition-colors duration-300">À Propos</a></li> {{-- Assurez-vous que cette route existe --}}
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors duration-300">Contact</a></li> {{-- Assurez-vous que cette route existe --}}
                </ul>
            </div>

            {{-- Colonne 3: Service Client --}}
            <div>
                <h5 class="text-xl font-bold text-white mb-4">Service Client</h5>
                <ul class="space-y-2">
                    <li><a href="{{ route('faq') }}" class="hover:text-white transition-colors duration-300">FAQ</a></li> {{-- Assurez-vous que cette route existe --}}
                    <li><a href="{{ route('cgv') }}" class="hover:text-white transition-colors duration-300">Conditions Générales de Vente</a></li> {{-- Assurez-vous que cette route existe --}}
                    <li><a href="{{ route('privacy.policy') }}" class="hover:text-white transition-colors duration-300">Politique de Confidentialité</a></li> {{-- Assurez-vous que cette route existe --}}
                </ul>
            </div>

            {{-- Colonne 4: Contact Info --}}
            <div>
                <h5 class="text-xl font-bold text-white mb-4">Contactez-Nous</h5>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                        <span>123 Rue Fictive, 75000 Paris, France</span>
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 flex-shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" /></svg>
                        <span>+33 1 23 45 67 89</span>
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 flex-shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                        <span>contact@votreboutique.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="border-gray-700 my-8">

        <div class="text-center text-sm">
            <p>&copy; {{ date('Y') }} [Nom de la Boutique]. Tous droits réservés.</p>
            <p class="mt-1">Propulsé avec <span class="text-red-500">&hearts;</span> par KaiAdmin & Laravel. Adapté par Jules.</p>
        </div>
    </div>
</footer>
