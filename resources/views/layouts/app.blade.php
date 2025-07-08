<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ config('app.name', 'Gestion de Stock et Facturation') }} - @yield('title', 'Tableau de bord')</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="{{ asset('assets/img/kaiadmin/favicon..ico') }}"
      type="image/x-icon"
    />
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
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />

    <!-- CSS Just for demo purpose, dont include it in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      @include('layouts.sidebar')
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            @include('layouts.logoheader')
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          @include('layouts.navhead')
          <!-- End Navbar -->
        </div>

        <div class="container">
          <div class="page-inner">
            @yield('contenus')
          </div>
        </div>

        @include('layouts.footer')
      </div>
    </div>

    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    {{-- <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script> --}}

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/js/setting-demo.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/demo.js') }}"></script> --}} <!-- Décommenter si des fonctions de demo.js sont activement utilisées, sinon, il est préférable de le garder commenté pour la production -->

    <script>
      // Scripts généraux pour l'application

      // Initialisation de la validation Bootstrap pour les formulaires ayant la classe 'needs-validation'
      // Ce script est auto-exécutant et applique les styles de validation Bootstrap.
      (() => {
        'use strict'
        // Sélectionne tous les formulaires qui nécessitent une validation.
        const forms = document.querySelectorAll('.needs-validation')

        // Boucle sur chaque formulaire pour ajouter un écouteur d'événement 'submit'.
        Array.from(forms).forEach(form => {
          form.addEventListener('submit', event => {
            // Si le formulaire n'est pas valide selon les règles HTML5 et Bootstrap.
            if (!form.checkValidity()) {
              event.preventDefault() // Empêche la soumission du formulaire.
              event.stopPropagation() // Arrête la propagation de l'événement.
            }
            // Ajoute la classe 'was-validated' pour afficher les messages de validation.
            form.classList.add('was-validated')
          }, false)
        })
      })();

      // Les scripts pour les graphiques Sparkline (lineChart, lineChart2, lineChart3)
      // sont conservés ici car ils font partie du layout de base du template KaiAdmin.
      // S'ils ne sont pas utilisés sur toutes les pages, envisagez de les déplacer
      // vers les sections @push('scripts') des vues spécifiques qui les utilisent.
      // Pour l'instant, nous les laissons, car ils pourraient être utilisés par le tableau de bord principal (`accueil`).

      // Exemple de graphique Sparkline 1
      if ($("#lineChart").length) { // Vérifie si l'élément existe avant d'initialiser
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
          type: "line",
          height: "70",
          width: "100%",
          lineWidth: "2",
          lineColor: "#177dff",
          fillColor: "rgba(23, 125, 255, 0.14)",
        });
      }

      // Exemple de graphique Sparkline 2
      if ($("#lineChart2").length) { // Vérifie si l'élément existe avant d'initialiser
        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
          type: "line",
          height: "70",
          width: "100%",
          lineWidth: "2",
          lineColor: "#f3545d",
          fillColor: "rgba(243, 84, 93, .14)",
        });
      }

      // Exemple de graphique Sparkline 3
      if ($("#lineChart3").length) { // Vérifie si l'élément existe avant d'initialiser
        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
          type: "line",
          height: "70",
          width: "100%",
          lineWidth: "2",
          lineColor: "#ffa534",
          fillColor: "rgba(255, 165, 52, .14)",
        });
      }
    </script>

    {{-- Empilement pour les scripts spécifiques à chaque page --}}
    {{-- Les vues enfants peuvent pousser des scripts ici en utilisant @push('scripts') --}}
    @stack('scripts')

  </body>
</html>
