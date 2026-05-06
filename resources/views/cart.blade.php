@extends('layout')

@section('content')

<style>
.cart-img {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 10px;
}

@media (max-width: 576px) {
    .cart-img {
        width: 50px;
        height: 50px;
    }
    .cart-row td {
        font-size: 13px;
    }
}
</style>

<h2 class="fw-bold mb-4">🛒 {{ __('lang.cart') }}</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($cartItems->isEmpty())

    <div class="card p-5 text-center">
        <span style="font-size:60px;">🛒</span>
        <h4 class="mt-3">{{ __('lang.cart_empty') }}</h4>
        <a href="/products" class="btn btn-dark mt-3">
            {{ __('lang.go_shopping') }}
        </a>
    </div>

@else

    <div class="card p-3 p-md-4">

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>{{ __('lang.product') }}</th>
                        <th>{{ __('lang.price') }}</th>
                        <th>{{ __('lang.quantity') }}</th>
                        <th>{{ __('lang.subtotal') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                @foreach($cartItems as $item)
                    <tr class="cart-row">
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @if($item->product->image)
                                    <img src="{{ asset($item->product->image) }}" class="cart-img" alt="{{ $item->product->name }}">
                                @else
                                    <span style="font-size:40px;">📦</span>
                                @endif
                                <div>
                                    <strong>{{ $item->product->name }}</strong>
                                </div>
                            </div>
                        </td>
                        <td>{{ number_format($item->product->price, 0, '.', ' ') }} тг</td>
                        <td>
                            <form method="POST" action="/cart/update/{{ $item->id }}" class="d-flex align-items-center gap-2">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                    min="0" class="form-control" style="width:70px;">
                                <button class="btn btn-sm btn-outline-secondary">↻</button>
                            </form>
                        </td>
                        <td>{{ number_format($item->product->price * $item->quantity, 0, '.', ' ') }} тг</td>
                        <td>
                            <form method="POST" action="/cart/remove/{{ $item->id }}">
                                @csrf
                                <button class="btn btn-sm btn-danger">✕</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mt-3">
            <h4 class="fw-bold">
                {{ __('lang.total') }}: {{ number_format($total, 0, '.', ' ') }} тг
            </h4>
            <div class="d-flex gap-2">
                <a href="/products" class="btn btn-outline-secondary">
                    ← {{ __('lang.continue_shopping') }}
                </a>
                <a href="/checkout" class="btn btn-success">
                    💳 {{ __('lang.checkout') }}
                </a>
            </div>
        </div>

    </div>

@endif

@endsection
