<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title', config('app.name', 'Boutique en ligne')) - E-commerce</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{ asset('assets/css/fonts.min.css') }}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" /> <!-- Contient des plugins utiles comme JQVMap, Sweet Alert -->
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" /> <!-- Style de base KaiAdmin -->

    <!-- CSS Custom pour l'e-commerce si nécessaire -->
    <link rel="stylesheet" href="{{ asset('assets/css/ecommerce.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-ecommerce.css') }}"> <!-- Ajout du CSS personnalisé -->

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    @stack('styles') <!-- Pour les styles spécifiques à une page -->
</head>
<body class="ecommerce-page"> <!-- Ajout de la classe ecommerce-page -->
    <div class="wrapper ecommerce-wrapper"> <!-- Classe spécifique pour le layout e-commerce -->

        @include('ecommerce.partials.header') <!-- Header de la boutique -->

        <div class="main-panel-ecommerce"> <!-- Panneau principal simplifié pour l'e-commerce -->
            <div class="container"> <!-- Container Bootstrap pour le contenu -->
                @yield('content') <!-- Contenu principal de la page -->
            </div>
        </div>

        @include('ecommerce.partials.footer') <!-- Footer de la boutique -->

    </div> <!-- Fin .wrapper -->

    <!-- Core JS Files -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS (fonctions de base du template, peut être utile) -->
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

    <!-- Scripts JS Custom pour l'e-commerce -->
    <script src="{{ asset('assets/js/ecommerce.js') }}"></script> <!-- À créer plus tard si besoin -->

    @stack('scripts') <!-- Pour les scripts spécifiques à une page -->

    <!-- Affichage des messages flash (succès, erreur, info) -->
    @if(session('success'))
        <script>
            // Utilisation de SweetAlert pour les messages de succès
            swal("Succès!", "{{ session('success') }}", {
                icon: "success",
                buttons: {
                    confirm: {
                        className: "btn btn-success",
                    },
                },
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            // Utilisation de SweetAlert pour les messages d'erreur
            swal("Erreur!", "{{ session('error') }}", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: "btn btn-danger",
                    },
                },
            });
        </script>
    @endif

    @if(session('info'))
    <script>
        // Pour les messages d'information, on peut utiliser une notification moins intrusive
        // ou également SweetAlert selon la préférence.
        // Ici, un exemple avec SweetAlert.
        swal("Information", "{{ session('info') }}", {
            icon: "info",
            buttons: {
                confirm: {
                    className: "btn btn-info",
                },
            },
        });
    </script>
    @endif

    @if ($errors->any())
    <script>
        let errorMessages = '';
        @foreach ($errors->all() as $error)
            errorMessages += "{{ $error }}\n";
        @endforeach
        swal("Erreurs de validation", errorMessages, {
            icon: "error",
            buttons: {
                confirm: {
                    className: "btn btn-danger",
                },
            },
        });
    </script>
    @endif

<script>
    // Script global pour l'ajout au panier en AJAX
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('add-to-cart-ajax')) {
            const button = event.target;
            const articleId = button.dataset.articleId;

            // Prévenir les clics multiples
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Ajout...';

            fetch('{{ route("ecommerce.panier.ajouter") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest', // Important pour que request->ajax() fonctionne
                },
                body: JSON.stringify({
                    article_id: articleId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mettre à jour le compteur du panier
                    const cartBadge = document.querySelector('.cart-count-badge');
                    if (cartBadge) {
                        cartBadge.textContent = data.cart_count > 0 ? data.cart_count : '';
                        cartBadge.style.display = data.cart_count > 0 ? 'inline-block' : 'none';
                    }

                    // Mettre à jour le contenu du mini-panier
                    const miniCartContainer = document.getElementById('mini-cart-container');
                    if (miniCartContainer) {
                        miniCartContainer.innerHTML = data.mini_cart_html;
                    }

                    // Afficher une notification de succès
                    swal({
                        title: "Succès!",
                        text: data.message,
                        icon: "success",
                        buttons: false,
                        timer: 1500 // Disparaît après 1.5s
                    });

                } else {
                    // Gérer l'erreur (ex: stock insuffisant)
                    swal("Erreur", data.message || "Une erreur est survenue.", "error");
                }
            })
            .catch(error => {
                console.error('Erreur AJAX:', error);
                swal("Erreur", "Impossible d'ajouter l'article au panier.", "error");
            })
            .finally(() => {
                // Réactiver le bouton
                button.disabled = false;
                button.innerHTML = '<i class="fas fa-shopping-cart me-1"></i> Ajouter au panier';
            });
        }
    });
</script>
</body>
</html>
