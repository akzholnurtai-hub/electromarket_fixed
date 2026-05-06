@extends('layout')

@section('content')

<style>
@media (max-width: 576px) {
    .checkout-summary { margin-top: 20px; }
}
</style>

<h2 class="fw-bold mb-4">💳 {{ __('lang.checkout') }}</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-4">

    {{-- Жеткізу деректерін енгізу формасы --}}
    <div class="col-12 col-lg-7">
        <div class="card p-4">

            <h5 class="fw-bold mb-3">📦 {{ __('lang.delivery_details') }}</h5>

            <form method="POST" action="/checkout">
                @csrf

                <div class="mb-3">
                    <label class="form-label">{{ __('lang.full_name') }}</label>
                    <input type="text" name="full_name" class="form-control"
                        value="{{ old('full_name', Auth::user()->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('lang.phone') }}</label>
                    <input type="text" name="phone" class="form-control"
                        placeholder="+7 (777) 000-00-00" value="{{ old('phone') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('lang.city') }}</label>
                    <input type="text" name="city" class="form-control"
                        placeholder="{{ __('lang.city') }}" value="{{ old('city') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('lang.address') }}</label>
                    <textarea name="address" class="form-control" rows="2"
                        placeholder="{{ __('lang.address_placeholder') }}" required>{{ old('address') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('lang.payment_method') }}</label>
                    <select name="payment_method" class="form-select">
                        <option value="cash">💵 {{ __('lang.pay_cash') }}</option>
                        <option value="card">💳 {{ __('lang.pay_card') }}</option>
                        <option value="online">📱 {{ __('lang.pay_online') }}</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success w-100 mt-2" style="font-size:18px;">
                    ✅ {{ __('lang.place_order') }}
                </button>

            </form>
        </div>
    </div>

    {{-- Тапсырыс қорытындысы --}}
    <div class="col-12 col-lg-5 checkout-summary">
        <div class="card p-4">

            <h5 class="fw-bold mb-3">🧾 {{ __('lang.order_summary') }}</h5>

            @foreach($cartItems as $item)
                <div class="d-flex justify-content-between mb-2">
                    <span>
                        {{ $item->product->name }}
                        <span class="text-muted">×{{ $item->quantity }}</span>
                    </span>
                    <strong>{{ number_format($item->product->price * $item->quantity, 0, '.', ' ') }} тг</strong>
                </div>
            @endforeach

            <hr>

            <div class="d-flex justify-content-between">
                <h5>{{ __('lang.total') }}</h5>
                <h5 class="text-success">{{ number_format($total, 0, '.', ' ') }} тг</h5>
            </div>

            <a href="/cart" class="btn btn-outline-secondary btn-sm mt-3">
                ← {{ __('lang.edit_cart') }}
            </a>

        </div>
    </div>

</div>

@endsection
