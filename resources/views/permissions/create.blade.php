@extends('layouts.app')

{{-- Section pour le titre de la page --}}
@section('title', 'Créer une Nouvelle Permission')

{{-- Section pour le contenu principal de la page --}}
@section('contenus')

{{-- En-tête de la page avec titre et fil d'Ariane --}}
<div class="page-header">
    <h3 class="fw-bold mb-3">Gestion des Accès</h3>
    <ul class="breadcrumbs mb-3">
        <li class="nav-home">
            <a href="{{ route('accueil') }}">
                <i class="icon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="{{ route('permissions.index') }}">Permissions</a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="#">Créer une Permission</a>
        </li>
    </ul>
</div>

{{-- Conteneur principal pour le formulaire de création de permission --}}
<div class="row">
    <div class="col-md-12">
        {{-- Carte KaiAdmin pour le formulaire --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">Formulaire de Création de Permission</div>
                <div class="card-category">Définissez un nom unique pour la nouvelle permission. Le guard par défaut est `{{ config('auth.defaults.guard') }}`.</div>
            </div>
            <div class="card-body">
                {{-- Affichage des erreurs de validation générales --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Erreur !</strong> Veuillez corriger les erreurs ci-dessous.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Formulaire de création de permission --}}
                <form action="{{ route('permissions.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    {{-- Champ Nom de la permission --}}
                    <div class="form-group">
                        <label for="name">Nom de la permission <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                               required value="{{ old('name') }}" placeholder="ex: articles-creer">
                        {{-- Message d'aide pour le format du nom --}}
                        <small class="form-text text-muted">
                            Utilisez un format comme `nomdelentite-action` (par exemple, `articles-lire`, `utilisateurs-modifier`). Uniquement des minuscules, chiffres et tirets.
                        </small>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="invalid-feedback">Le nom de la permission est requis.</div>
                    </div>

                    {{-- Section des actions du formulaire --}}
                    <div class="card-action text-end">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Créer la Permission
                        </button>
                        <a href="{{ route('permissions.index') }}" class="btn btn-danger">
                            <i class="fas fa-times"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Section pour les scripts JavaScript spécifiques à cette page --}}
@push('scripts')
<script>
    // La validation Bootstrap est déjà gérée globalement dans layouts.app.blade.php.
    // Ajout d'une validation de pattern simple pour le nom de la permission si besoin.
    // document.getElementById('name').addEventListener('input', function (event) {
    //     // Autorise les minuscules, chiffres, et tirets.
    //     const pattern = /^[a-z0-9-]+$/;
    //     if (!pattern.test(event.target.value)) {
    //         // Peut-être afficher un message d'erreur personnalisé ou simplement laisser la validation HTML5 pattern
    //     }
    // });
</script>
@endpush
