@extends('ecommerce.layouts.app')

@section('title', 'Statut de votre Commande ' . $order->order_number)

@section('content')
<div class="page-inner-ecommerce order-status-page py-5">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title mb-0">Statut de la Commande : <span class="text-primary">{{ $order->order_number }}</span></h1>
            </div>
            <div class="card-body">
                @if(isset($order))
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h4>Informations Générales</h4>
                            <ul class="list-unstyled">
                                <li><strong>Date de la commande :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</li>
                                <li><strong>Nom du client :</strong> {{ $order->customer_name }}</li>
                                <li><strong>E-mail :</strong> {{ $order->customer_email }}</li>
                                <li><strong>Montant total :</strong> {{ number_format($order->total_amount, 2, ',', ' ') }} €</li>
                                <li><strong>Mode de paiement :</strong>
                                    @if($order->payment_method == 'cash_on_delivery')
                                        Paiement à la livraison
                                    @else
                                        {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Adresse de Livraison</h4>
                             @php
                                $address = json_decode($order->shipping_address);
                            @endphp
                            <p>
                                {{ $address->line1 ?? '' }}<br>
                                @if(isset($address->line2) && $address->line2)
                                    {{ $address->line2 }}<br>
                                @endif
                                {{ $address->postal_code ?? '' }} {{ $address->city ?? '' }}<br>
                                {{ $address->country ?? '' }}
                            </p>
                        </div>
                    </div>

                    <h4>Statut Actuel : <span class="badge bg-primary fs-6">{{ ucfirst($order->status) }}</span></h4>
                    <div class="progress my-3" style="height: 25px;">
                        @php
                            $statusSteps = ['pending' => 25, 'processing' => 50, 'shipped' => 75, 'delivered' => 100, 'cancelled' => 0];
                            $currentProgress = $statusSteps[strtolower($order->status)] ?? 0;
                            $progressColor = 'bg-primary';
                            if(strtolower($order->status) == 'cancelled') $progressColor = 'bg-danger';
                            if(strtolower($order->status) == 'delivered') $progressColor = 'bg-success';
                        @endphp
                        <div class="progress-bar {{ $progressColor }} progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $currentProgress }}%;" aria-valuenow="{{ $currentProgress }}" aria-valuemin="0" aria-valuemax="100">{{ ucfirst($order->status) }}</div>
                    </div>

                    {{-- Détail des étapes (exemple) --}}
                    <ul class="list-group list-group-flush order-status-timeline">
                        <li class="list-group-item {{ in_array(strtolower($order->status), ['pending', 'processing', 'shipped', 'delivered']) ? 'completed' : '' }}">
                            <i class="fas fa-hourglass-start me-2"></i> Commande Reçue (En attente de traitement)
                            @if(strtolower($order->status) == 'pending') <span class="text-muted float-end">En cours...</span> @endif
                        </li>
                        <li class="list-group-item {{ in_array(strtolower($order->status), ['processing', 'shipped', 'delivered']) ? 'completed' : '' }}">
                            <i class="fas fa-cogs me-2"></i> En Cours de Préparation
                             @if(strtolower($order->status) == 'processing') <span class="text-muted float-end">En cours...</span> @endif
                        </li>
                        <li class="list-group-item {{ in_array(strtolower($order->status), ['shipped', 'delivered']) ? 'completed' : '' }}">
                            <i class="fas fa-truck me-2"></i> Expédiée
                             @if(strtolower($order->status) == 'shipped') <span class="text-muted float-end">En cours...</span> @endif
                        </li>
                        <li class="list-group-item {{ strtolower($order->status) == 'delivered' ? 'completed' : '' }}">
                            <i class="fas fa-check-circle me-2"></i> Livrée
                             @if(strtolower($order->status) == 'delivered') <span class="text-success float-end">Terminé</span> @endif
                        </li>
                         @if(strtolower($order->status) == 'cancelled')
                         <li class="list-group-item cancelled">
                            <i class="fas fa-times-circle me-2"></i> Annulée
                            <span class="text-danger float-end">Commande annulée</span>
                        </li>
                        @endif
                    </ul>


                    <h4 class="mt-5">Articles de votre commande :</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th class="text-center">Quantité</th>
                                    <th class="text-end">Prix Unitaire</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">{{ number_format($item->price, 2, ',', ' ') }} €</td>
                                    <td class="text-end">{{ number_format($item->total_price, 2, ',', ' ') }} €</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('ecommerce.home') }}" class="btn btn-outline-secondary me-2">
                            <i class="fas fa-arrow-left me-1"></i> Retour à la boutique
                        </a>
                        <a href="{{ route('ecommerce.order.track') }}" class="btn btn-info">
                            <i class="fas fa-search me-1"></i> Suivre une autre commande
                        </a>
                    </div>

                @else
                    {{-- Ce cas ne devrait pas être atteint si le contrôleur gère bien la non-existence de la commande --}}
                    <p class="alert alert-danger">Les informations de cette commande ne sont pas disponibles.</p>
                     <div class="text-center mt-3">
                         <a href="{{ route('ecommerce.order.track') }}" class="btn btn-primary">
                            <i class="fas fa-search me-1"></i> Essayer une autre recherche
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .order-status-timeline .list-group-item {
        border-left: 3px solid #eee;
        padding-left: 1.5rem;
        position: relative;
    }
    .order-status-timeline .list-group-item i {
        color: #adb5bd; /* Gris par défaut */
    }
    .order-status-timeline .list-group-item.completed {
        border-left-color: var(--bs-success); /* Vert pour complété */
    }
    .order-status-timeline .list-group-item.completed i {
        color: var(--bs-success);
    }
     .order-status-timeline .list-group-item.cancelled {
        border-left-color: var(--bs-danger); /* Rouge pour annulé */
    }
    .order-status-timeline .list-group-item.cancelled i {
        color: var(--bs-danger);
    }

    /* Ajout d'un point sur la timeline */
    .order-status-timeline .list-group-item::before {
        content: "";
        position: absolute;
        left: -8px; /* Ajuster pour centrer sur la bordure */
        top: 50%;
        transform: translateY(-50%);
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #eee;
        border: 2px solid #fff;
    }
    .order-status-timeline .list-group-item.completed::before {
        background-color: var(--bs-success);
    }
    .order-status-timeline .list-group-item.cancelled::before {
        background-color: var(--bs-danger);
    }
</style>
@endpush
