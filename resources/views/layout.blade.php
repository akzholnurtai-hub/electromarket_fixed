<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electro Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #eef2f7;
        }
        .navbar {
            border-radius: 0 0 15px 15px;
        }
        .card {
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .btn {
            border-radius: 10px;
        }
        .product-img {
            width: 100%;
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 15px;
        }
        .navbar-brand {
            font-size: clamp(16px, 3vw, 24px);
        }
        /* Тіл батырмаларының активті күйі */
        .lang-btn.active-lang {
            background-color: #ffc107;
            color: #000;
            border-color: #ffc107;
        }
        @media (max-width: 768px) {
            .navbar .btn {
                font-size: 12px;
                padding: 4px 8px;
                margin-bottom: 4px;
            }
            .navbar > .container {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }
            .navbar > .container > div {
                display: flex;
                flex-wrap: wrap;
                gap: 5px;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark p-3">
    <div class="container">

        <a class="navbar-brand fw-bold" href="/">
            ⚡ Electro Market
        </a>

        <div>

            @guest
                <a href="/login" class="btn btn-outline-light me-2">
                    {{ __('lang.login') }}
                </a>
                <a href="/register" class="btn btn-warning me-2">
                    {{ __('lang.register') }}
                </a>
            @endguest

            @auth
                <a href="/products" class="btn btn-outline-light me-2">
                    {{ __('lang.products') }}
                </a>
                <a href="/cart" class="btn btn-outline-warning me-2">
                    🛒 {{ __('lang.cart') }}
                </a>
                <a href="/profile" class="btn btn-outline-light me-2">
                    {{ __('lang.profile') }}
                </a>

                @role('admin')
                    <a href="/analytics" class="btn btn-danger me-2">
                        {{ __('lang.analytics') }}
                    </a>
                    <a href="/admin/orders" class="btn btn-warning me-2">
                        📋 {{ __('lang.orders') }}
                    </a>
                @endrole

                @role('admin|manager')
                    <a href="/products/create" class="btn btn-success me-2">
                        ➕
                    </a>
                @endrole

                <a href="/logout" class="btn btn-outline-secondary me-2">
                    {{ __('lang.logout') }}
                </a>
            @endauth

            {{-- Тіл таңдау батырмалары. Белсенді тіл жылтыр түспен белгіленеді. --}}
            @php $currentLang = app()->getLocale(); @endphp
            <a href="/lang/kk" class="btn btn-outline-light me-1 lang-btn {{ $currentLang === 'kk' ? 'active-lang' : '' }}">KK</a>
            <a href="/lang/ru" class="btn btn-outline-light me-1 lang-btn {{ $currentLang === 'ru' ? 'active-lang' : '' }}">RU</a>
            <a href="/lang/en" class="btn btn-outline-light lang-btn {{ $currentLang === 'en' ? 'active-lang' : '' }}">EN</a>

        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>
