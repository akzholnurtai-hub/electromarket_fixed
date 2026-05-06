@extends('layout')

@section('content')

<style>
/* ✅ Media Queries — login формасы (Slide 17) */
@media (max-width: 576px) {
    .login-card {
        margin: 0 10px;
    }
}
</style>

{{-- ✅ % width: col-md-4 = ~33%, col-sm-8 = ~66%, col-12 = 100% (Slide 7) --}}
<div class="row justify-content-center mt-5">

    <div class="col-12 col-sm-8 col-md-5 col-lg-4 login-card">

        <div class="card p-4">

            <h3 class="text-center mb-3">
                {{ __('lang.login') }}
            </h3>

            <form method="POST" action="/login">

                @csrf

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

                {{-- ✅ w-100 = width: 100% (Slide 7) --}}
                <button class="btn btn-dark w-100">
                    {{ __('lang.login') }}
                </button>

            </form>

            @if(session('message'))

                <div class="alert alert-danger mt-3">
                    {{ session('message') }}
                </div>

            @endif

        </div>

    </div>

</div>

@endsection
