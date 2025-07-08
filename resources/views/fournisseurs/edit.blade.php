@extends('layouts.app')

{{-- Section pour le titre de la page --}}
@section('title', "Modifier le Fournisseur : " . $fournisseur->name)

{{-- Section pour le contenu principal de la page --}}
@section('contenus')

{{-- En-tête de la page avec titre et fil d'Ariane --}}
<div class="page-header">
    <h3 class="fw-bold mb-3">Gestion des Fournisseurs</h3>
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
            <a href="{{ route('fournisseurs.index') }}">Fournisseurs</a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="#">Modifier : {{ Str::limit($fournisseur->name, 30) }}</a>
        </li>
    </ul>
</div>

{{-- Conteneur principal pour le formulaire de modification de fournisseur --}}
<div class="row">
    <div class="col-md-12">
        {{-- Carte KaiAdmin pour le formulaire --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">Formulaire de Modification de Fournisseur</div>
                <div class="card-category">Modifiez les informations du fournisseur "{{ $fournisseur->name }}" ci-dessous.</div>
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

                {{-- Formulaire de modification de fournisseur --}}
                <form action="{{ route('fournisseurs.update', $fournisseur->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    {{-- Ligne pour Nom du contact et Nom de l'entreprise --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nom du contact <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                       required value="{{ old('name', $fournisseur->name) }}" placeholder="Nom et prénom du contact">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <div class="invalid-feedback">Le nom du contact est requis.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nom_entreprise">Nom de l'entreprise <span class="text-danger">*</span></label>
                                <input type="text" name="nom_entreprise" id="nom_entreprise" class="form-control @error('nom_entreprise') is-invalid @enderror"
                                       required value="{{ old('nom_entreprise', $fournisseur->nom_entreprise) }}" placeholder="Raison sociale de l'entreprise">
                                @error('nom_entreprise') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <div class="invalid-feedback">Le nom de l'entreprise est requis.</div>
                            </div>
                        </div>
                    </div>

                    {{-- Champ Description --}}
                    <div class="form-group">
                        <label for="description">Description / Activité</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                  rows="3" placeholder="Brève description du fournisseur ou de son activité principale">{{ old('description', $fournisseur->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Champ Adresse --}}
                    <div class="form-group">
                        <label for="adresse">Adresse postale <span class="text-danger">*</span></label>
                        <input type="text" name="adresse" id="adresse" class="form-control @error('adresse') is-invalid @enderror"
                               required value="{{ old('adresse', $fournisseur->adresse) }}" placeholder="Numéro, rue, complément d'adresse">
                        @error('adresse') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="invalid-feedback">L'adresse est requise.</div>
                    </div>

                    {{-- Ligne pour Téléphone et Email --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telephone">Téléphone <span class="text-danger">*</span></label>
                                <input type="tel" name="telephone" id="telephone" class="form-control @error('telephone') is-invalid @enderror"
                                       required value="{{ old('telephone', $fournisseur->telephone) }}" placeholder="Numéro de téléphone">
                                @error('telephone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <div class="invalid-feedback">Le numéro de téléphone est requis.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Adresse Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                       required value="{{ old('email', $fournisseur->email) }}" placeholder="example@domaine.com">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <div class="invalid-feedback">Une adresse email valide est requise.</div>
                            </div>
                        </div>
                    </div>

                    {{-- Ligne pour Ville et Pays --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ville">Ville <span class="text-danger">*</span></label>
                                <input type="text" name="ville" id="ville" class="form-control @error('ville') is-invalid @enderror"
                                       required value="{{ old('ville', $fournisseur->ville) }}" placeholder="Ville">
                                @error('ville') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <div class="invalid-feedback">La ville est requise.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pays">Pays <span class="text-danger">*</span></label>
                                <input type="text" name="pays" id="pays" class="form-control @error('pays') is-invalid @enderror"
                                       required value="{{ old('pays', $fournisseur->pays) }}" placeholder="Pays">
                                @error('pays') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <div class="invalid-feedback">Le pays est requis.</div>
                            </div>
                        </div>
                    </div>

                    {{-- Section des actions du formulaire --}}
                    <div class="card-action text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Mettre à Jour le Fournisseur
                        </button>
                        <a href="{{ route('fournisseurs.index') }}" class="btn btn-secondary">
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
