@extends('layout')

@section('content')

<style>
.hero {
    background: linear-gradient(135deg, #141e30, #243b55);
    color: white;
    border-radius: 30px;
    padding: 5% 4%;
    text-align: center;
    animation: fadeIn 1s ease;
}
.hero h1 {
    font-size: clamp(28px, 5vw, 56px);
}
.hero p {
    font-size: clamp(14px, 2vw, 20px);
}
.category-card {
    border-radius: 25px;
    overflow: hidden;
    transition: 0.4s;
    position: relative;
}
.category-card:hover {
    transform: translateY(-10px) scale(1.03);
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
}
.category-img {
    width: 100%;
    max-width: 100%;
    height: 220px;
    object-fit: cover;
}
.overlay {
    position: absolute;
    bottom: 0;
    width: 100%;
    padding: 15px;
    background: rgba(0,0,0,0.6);
    color: white;
    text-align: center;
}
.section-title {
    font-size: clamp(20px, 3.5vw, 32px);
}
.promo-title {
    font-size: clamp(22px, 4vw, 36px);
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}
@media (max-width: 576px) {
    .hero { padding: 40px 20px; border-radius: 20px; }
    .category-img { height: 160px; }
    .overlay h5 { font-size: 14px; }
}
@media (min-width: 577px) and (max-width: 992px) {
    .category-img { height: 190px; }
}
</style>

{{-- HERO бөлімі --}}
<div class="hero mb-5">
    <h1 class="fw-bold">⚡ Electro Market</h1>
    <p class="mt-3">{{ __('lang.welcome') }}</p>

    @guest
        <a href="/login" class="btn btn-light me-2">{{ __('lang.login') }}</a>
        <a href="/register" class="btn btn-warning">{{ __('lang.register') }}</a>
    @endguest

    @auth
        <a href="/products" class="btn btn-warning">{{ __('lang.products') }}</a>
    @endauth
</div>

{{-- Танымал категориялар --}}
<h3 class="mb-4 fw-bold text-center section-title">
    🔥 {{ __('lang.popular_categories') }}
</h3>

<div class="row g-4">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card category-card shadow">
            <img src="/4.jpg" class="category-img" alt="Smartphones">
            <div class="overlay">
                <h5>📱 {{ __('lang.smartphones') }}</h5>
                <small>iPhone, Samsung</small>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card category-card shadow">
            <img src="/2.webp" class="category-img" alt="Laptops">
            <div class="overlay">
                <h5>💻 {{ __('lang.laptops') }}</h5>
                <small>MacBook, ASUS</small>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card category-card shadow">
            <img src="/6.jpg" class="category-img" alt="Headphones">
            <div class="overlay">
                <h5>🎧 {{ __('lang.headphones') }}</h5>
                <small>Sony, JBL</small>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card category-card shadow">
            <img src="/5.jpg" class="category-img" alt="Smart Watch">
            <div class="overlay">
                <h5>⌚ {{ __('lang.smart_watch') }}</h5>
                <small>Apple, Samsung</small>
            </div>
        </div>
    </div>
</div>

{{-- Арнайы ұсыныс --}}
<div class="card mt-5 p-5 text-center shadow" style="border-radius:25px;">
    <h2 class="fw-bold promo-title">🔥 {{ __('lang.special_offer') }}</h2>
    <p class="mt-2">{{ __('lang.discount_text') }}</p>
    <button class="btn btn-dark" onclick="showPromo()">{{ __('lang.show_promo') }}</button>
    <div id="promoBox" style="display:none;" class="mt-4">
        <img src="/7.jpg" style="width:100%; max-width:100%; border-radius:15px;" alt="Promo">
    </div>
</div>

<script>
function showPromo() {
    document.getElementById('promoBox').style.display = 'block';
}
</script>

@endsection
