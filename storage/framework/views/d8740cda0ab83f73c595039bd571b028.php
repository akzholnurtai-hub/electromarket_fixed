

<?php $__env->startSection('content'); ?>

<style>
/* HERO */
.hero {
    background: linear-gradient(135deg, #141e30, #243b55);
    color: white;
    border-radius: 30px;
    padding: 70px 40px;
    text-align: center;
    animation: fadeIn 1s ease;
}

.hero h1 {
    font-size: 48px;
}

/* CARD */
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

/* IMAGE FIX */
.category-img {
    width: 100%;
    height: 220px;
    object-fit: cover;
}

/* OVERLAY */
.overlay {
    position: absolute;
    bottom: 0;
    width: 100%;
    padding: 15px;
    background: rgba(0,0,0,0.6);
    color: white;
    text-align: center;
}

/* ANIMATION */
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}
</style>

<!-- HERO -->
<div class="hero mb-5">

    <h1 class="fw-bold">
        ⚡ Electro Market
    </h1>

    <p class="mt-3">
        <?php echo e(__('lang.welcome')); ?>

    </p>

    <?php if(auth()->guard()->guest()): ?>

        <a href="/login" class="btn btn-light me-2">
            <?php echo e(__('lang.login')); ?>

        </a>

        <a href="/register" class="btn btn-warning">
            <?php echo e(__('lang.register')); ?>

        </a>

    <?php endif; ?>

    <?php if(auth()->guard()->check()): ?>

        <a href="/products" class="btn btn-warning">
            <?php echo e(__('lang.products')); ?>

        </a>

    <?php endif; ?>

</div>

<!-- CATEGORIES -->

<h3 class="mb-4 fw-bold text-center">
    🔥 <?php echo e(__('lang.popular_categories')); ?>

</h3>

<div class="row g-4">

    <!-- PHONE -->
    <div class="col-md-3">
        <div class="card category-card shadow">

            <img src="4.jpg" class="category-img">

            <div class="overlay">
                <h5>📱 <?php echo e(__('lang.smartphones')); ?></h5>
                <small>iPhone, Samsung</small>
            </div>

        </div>
    </div>

    <!-- LAPTOP -->
    <div class="col-md-3">
        <div class="card category-card shadow">

            <img src="2.webp" class="category-img">

            <div class="overlay">
                <h5>💻 <?php echo e(__('lang.laptops')); ?></h5>
                <small>MacBook, ASUS</small>
            </div>

        </div>
    </div>

    <!-- HEADPHONES -->
    <div class="col-md-3">
        <div class="card category-card shadow">

            <img src="6.jpg" class="category-img">

            <div class="overlay">
                <h5>🎧 <?php echo e(__('lang.headphones')); ?></h5>
                <small>Sony, JBL</small>
            </div>

        </div>
    </div>

    <!-- WATCH -->
    <div class="col-md-3">
        <div class="card category-card shadow">

            <img src="5.jpg" class="category-img">

            <div class="overlay">
                <h5>⌚ <?php echo e(__('lang.smart_watch')); ?></h5>
                <small>Apple, Samsung</small>
            </div>

        </div>
    </div>

</div>

<!-- PROMO -->

<div class="card mt-5 p-5 text-center shadow" style="border-radius:25px;">

    <h2 class="fw-bold">
        🔥 <?php echo e(__('lang.special_offer')); ?>

    </h2>

    <p class="mt-2">
        <?php echo e(__('lang.discount_text')); ?>

    </p>

    <button class="btn btn-dark" onclick="showPromo()">
        <?php echo e(__('lang.show_promo')); ?>

    </button>

    <div id="promoBox" style="display:none;" class="mt-4">

        <img src="7.jpg"
             class="img-fluid rounded shadow">

    </div>

</div>

<script>
function showPromo() {
    document.getElementById("promoBox").style.display = "block";
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\777\Desktop\electromarket\resources\views/home.blade.php ENDPATH**/ ?>