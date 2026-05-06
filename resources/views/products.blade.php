@extends('layout')

@section('content')

<style>
.page-title {
    font-size: clamp(22px, 4vw, 36px);
}
.product-img {
    width: 100%;
    max-width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 15px;
}
@media (max-width: 576px) {
    .product-card-title { font-size: 14px; }
    .product-img { height: 160px; }
}
</style>

<h2 class="mb-4 page-title">🛍️ {{ __('lang.products') }}</h2>

@role('admin|manager')
    <a href="/products/create" class="btn btn-primary mb-3">
        ➕ {{ __('lang.add_product') }}
    </a>
@endrole

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($products->isEmpty())
    <div class="alert alert-info text-center">
        <span style="font-size:50px;">📦</span>
        <p class="mt-2">{{ __('lang.no_products') }}</p>
    </div>
@endif

<div class="row g-4">
@foreach($products as $product)

    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="card p-3 text-center h-100 d-flex flex-column">

            @if($product->image)
                <a href="/products/{{ $product->id }}">
                    <img src="{{ asset($product->image) }}" class="product-img mb-2" alt="{{ $product->name }}">
                </a>
            @endif

            <h5 class="product-card-title">
                <a href="/products/{{ $product->id }}" class="text-dark text-decoration-none">
                    {{ $product->name }}
                </a>
            </h5>

            <p class="text-success fw-bold">
                {{ number_format($product->price, 0, '.', ' ') }} тг
            </p>

            <div class="mt-auto d-flex flex-column gap-2">

                <a href="/products/{{ $product->id }}" class="btn btn-outline-dark btn-sm">
                    👁️ {{ __('lang.view') }}
                </a>

                @auth
                    <form method="POST" action="/cart/add">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button class="btn btn-success w-100 btn-sm">
                            🛒 {{ __('lang.add_to_cart') }}
                        </button>
                    </form>
                @endauth

                @role('admin|manager')
                    <form method="POST" action="/products/{{ $product->id }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm w-100">
                            🗑️ {{ __('lang.delete') }}
                        </button>
                    </form>
                @endrole

            </div>
        </div>
    </div>

@endforeach
</div>

@endsection
