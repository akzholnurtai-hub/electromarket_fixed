@extends('layout')

@section('content')

<style>
.detail-img {
    width: 100%;
    max-width: 100%;
    height: 380px;
    object-fit: cover;
    border-radius: 20px;
}
@media (max-width: 576px) {
    .detail-img { height: 220px; }
}
</style>

<div class="row g-4">

    {{-- Өнім суреті --}}
    <div class="col-12 col-md-6">
        @if($product->image)
            <img src="{{ asset($product->image) }}" class="detail-img shadow" alt="{{ $product->name }}">
        @else
            <div class="bg-secondary d-flex align-items-center justify-content-center detail-img text-white rounded">
                <span style="font-size:80px;">📦</span>
            </div>
        @endif
    </div>

    {{-- Өнім ақпараты --}}
    <div class="col-12 col-md-6">
        <div class="card p-4 h-100">

            <h2 class="fw-bold">{{ $product->name }}</h2>

            <h3 class="text-success mt-3">
                {{ number_format($product->price, 0, '.', ' ') }} тг
            </h3>

            @if($product->description)
                <p class="text-muted mt-3">{{ $product->description }}</p>
            @endif

            <hr>

            @auth
                <form method="POST" action="/cart/add">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button class="btn btn-success w-100 mb-2" style="font-size:18px;">
                        🛒 {{ __('lang.add_to_cart') }}
                    </button>
                </form>

                <a href="/checkout" class="btn btn-warning w-100">
                    ⚡ {{ __('lang.order_now') }}
                </a>

                @role('admin|manager')
                    <form method="POST" action="/products/{{ $product->id }}" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            🗑️ {{ __('lang.delete') }}
                        </button>
                    </form>
                @endrole

            @endauth

            @guest
                <a href="/login" class="btn btn-dark w-100">
                    🔒 {{ __('lang.login') }}
                </a>
            @endguest

            <div class="mt-3">
                <a href="/products" class="btn btn-outline-secondary btn-sm">
                    ← {{ __('lang.back') }}
                </a>
            </div>

        </div>
    </div>

</div>

@if(session('success'))
    <div class="alert alert-success mt-3">{{ session('success') }}</div>
@endif

@endsection
