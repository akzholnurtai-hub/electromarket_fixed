@extends('layout')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-md-7 col-lg-6">

        <div class="card p-4">

            <h3 class="fw-bold mb-4">➕ {{ __('lang.add_product') }}</h3>

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                        <div>{{ $err }}</div>
                    @endforeach
                </div>
            @endif

            <form action="/products" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">{{ __('lang.name') }}</label>
                    <input type="text" name="name" class="form-control"
                        placeholder="{{ __('lang.name') }}" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">{{ __('lang.price') }} (тг)</label>
                    <input type="number" name="price" class="form-control"
                        placeholder="0" value="{{ old('price') }}" required min="0">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">{{ __('lang.description') }}</label>
                    <textarea name="description" class="form-control" rows="3"
                        placeholder="{{ __('lang.description') }}">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">{{ __('lang.image') }}</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-dark flex-grow-1">
                        {{ __('lang.save') }}
                    </button>
                    <a href="/products" class="btn btn-outline-secondary">
                        {{ __('lang.back') }}
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
