@extends('layout')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-7">

        {{-- Профиль карточкасы --}}
        <div class="card p-4 text-center mb-4">
            <div style="font-size:60px;">👤</div>
            <h3 class="mt-2 fw-bold">{{ $user->name }}</h3>
            <p class="text-muted">{{ $user->email }}</p>
            <div class="mb-3">
                <strong>{{ __('lang.role') }}:</strong>
                <span class="badge bg-primary ms-1">
                    {{ $user->getRoleNames()->first() ?? 'N/A' }}
                </span>
            </div>
            <div class="d-flex gap-2 justify-content-center flex-wrap">
                <a href="/products" class="btn btn-outline-dark">🛍️ {{ __('lang.products') }}</a>
                <a href="/cart" class="btn btn-outline-success">🛒 {{ __('lang.cart') }}</a>
                <a href="/logout" class="btn btn-dark">{{ __('lang.logout') }}</a>
            </div>
        </div>

        {{-- Тапсырыстар тарихы --}}
        <h5 class="fw-bold mb-3">📦 {{ __('lang.my_orders') }}</h5>

        @if($orders->isEmpty())
            <div class="alert alert-info">{{ __('lang.no_orders_yet') }}</div>
        @else
            @foreach($orders as $order)
                <div class="card p-3 mb-3">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <strong>{{ __('lang.order') }} #{{ $order->id }}</strong>
                            <span class="text-muted ms-2">{{ $order->created_at->format('d.m.Y') }}</span>
                        </div>
                        @php
                            $badge = match($order->status) {
                                'pending'    => 'warning',
                                'processing' => 'info',
                                'delivered'  => 'success',
                                'cancelled'  => 'danger',
                                default      => 'secondary'
                            };
                        @endphp
                        <span class="badge bg-{{ $badge }}">{{ $order->status }}</span>
                    </div>
                    <hr class="my-2">
                    <div class="d-flex justify-content-between">
                        <span>{{ $order->city }}, {{ $order->address }}</span>
                        <strong>{{ number_format($order->total_price, 0, '.', ' ') }} тг</strong>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</div>

@endsection
