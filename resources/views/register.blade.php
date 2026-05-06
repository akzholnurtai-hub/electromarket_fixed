@extends('layout')

@section('content')

{{-- ✅ % width: col-12 (100%) → col-sm-8 → col-md-5 (Slide 7) --}}
<div class="row justify-content-center mt-5">

    <div class="col-12 col-sm-8 col-md-5 col-lg-4">

        <div class="card p-4">

            <h3 class="text-center mb-3">
                {{ __('lang.register') }}
            </h3>

            <form method="POST" action="/register">

                @csrf

                <input
                    type="text"
                    name="fullname"
                    class="form-control mb-2"
                    placeholder="{{ __('lang.name') }}"
                >

                <input
                    type="email"
                    name="email"
                    class="form-control mb-2"
                    placeholder="{{ __('lang.email') }}"
                >

                <input
                    type="password"
                    name="password"
                    class="form-control mb-3"
                    placeholder="{{ __('lang.password') }}"
                >

                {{-- ✅ w-100 = width: 100% --}}
                <button class="btn btn-success w-100">
                    {{ __('lang.register') }}
                </button>

            </form>

        </div>

    </div>

</div>

@endsection
