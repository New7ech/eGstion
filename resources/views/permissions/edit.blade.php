@extends('layouts.app')

{{-- Section pour le titre de la page --}}
@section('title', "Modifier la Permission : " . $permission->name)

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
            <a href="#">Modifier : {{ Str::limit($permission->name, 40) }}</a>
        </li>
    </ul>
</div>

{{-- Conteneur principal pour le formulaire de modification de permission --}}
<div class="row">
    <div class="col-md-12">
        {{-- Carte KaiAdmin pour le formulaire --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">Formulaire de Modification de Permission</div>
                <div class="card-category">Modifiez le nom de la permission "{{ $permission->name }}". Le guard est `{{ $permission->guard_name }}`.</div>
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

                {{-- Formulaire de modification de permission --}}
                <form action="{{ route('permissions.update', $permission->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    {{-- Champ Nom de la permission --}}
                    <div class="form-group">
                        <label for="name">Nom de la permission <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                               required value="{{ old('name', $permission->name) }}" placeholder="ex: articles-creer">
                        <small class="form-text text-muted">
                            Utilisez un format comme `nomdelentite-action` (par exemple, `articles-lire`, `utilisateurs-modifier`). Uniquement des minuscules, chiffres et tirets.
                        </small>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="invalid-feedback">Le nom de la permission est requis.</div>
                    </div>

                    {{-- Section des actions du formulaire --}}
                    <div class="card-action text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Mettre à Jour la Permission
                        </button>
                        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">
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
</script>
@endpush
