@extends('ecommerce.layouts.app')

@section('title', 'Confirmation de Commande')

@section('content')
<div class="page-inner-ecommerce confirmation-page py-5 text-center">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <i class="fas fa-check-circle fa-5x text-success mb-4"></i>
                <h1 class="mb-3">Merci pour votre commande !</h1>
                <p class="lead">Votre commande a été passée avec succès.</p>

                @if(isset($order))
                    <p>Votre numéro de commande est : <strong class="text-primary">{{ $order->order_number }}</strong></p>
                    <p>Un e-mail de confirmation vous a été envoyé à l'adresse : <strong>{{ $order->customer_email }}</strong> avec les détails de votre commande.</p>

                    <div class="order-summary my-4 p-4 bg-light rounded text-start">
                        <h4 class="mb-3">Récapitulatif de la commande :</h4>
                        <ul class="list-unstyled">
                            <li><strong>Nom du client :</strong> {{ $order->customer_name }}</li>
                            <li><strong>Adresse de livraison :</strong>
                                @php
                                    $address = json_decode($order->shipping_address);
                                @endphp
                                {{ $address->line1 ?? '' }}
                                {{ isset($address->line2) && $address->line2 ? ', ' . $address->line2 : '' }},
                                {{ $address->postal_code ?? '' }} {{ $address->city ?? '' }},
                                {{ $address->country ?? '' }}
                            </li>
                            <li><strong>Montant total :</strong> {{ number_format($order->total_amount, 2, ',', ' ') }} €</li>
                            <li><strong>Mode de paiement :</strong>
                                @if($order->payment_method == 'cash_on_delivery')
                                    Paiement à la livraison
                                @else
                                    {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                                @endif
                            </li>
                            <li><strong>Statut de la commande :</strong> <span class="badge bg-info">{{ ucfirst($order->status) }}</span></li>
                        </ul>
                        <h5 class="mt-3">Articles commandés :</h5>
                        <ul class="list-group">
                            @foreach($order->items as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $item->product_name }} (x{{ $item->quantity }})</span>
                                    <span>{{ number_format($item->total_price, 2, ',', ' ') }} €</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <p>Vous pouvez suivre l'état de votre commande ici :</p>
                    <a href="{{ route('ecommerce.order.track', ['order_number' => $order->order_number, 'email' => $order->customer_email]) }}" class="btn btn-info">
                        <i class="fas fa-truck me-1"></i> Suivre ma commande
                    </a>
                @else
                    <p class="text-danger">Impossible de charger les détails de la commande. Veuillez vérifier vos e-mails ou nous contacter.</p>
                @endif

                <hr class="my-4">

                <p>Merci de faire confiance à {{ config('app.name', 'Gestlog') }}.</p>
                <a href="{{ route('ecommerce.home') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-arrow-left me-1"></i> Retourner à la boutique
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .confirmation-page .card {
        max-width: 700px;
        margin: auto;
    }
    .order-summary {
        border: 1px solid #eee;
    }
</style>
@endpush
