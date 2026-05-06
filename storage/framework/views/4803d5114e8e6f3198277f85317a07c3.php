<?php $__env->startSection('content'); ?>

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

<h2 class="mb-4 page-title">🛍️ <?php echo e(__('lang.products')); ?></h2>

<?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin|manager')): ?>
    <a href="/products/create" class="btn btn-primary mb-3">
        ➕ <?php echo e(__('lang.add_product')); ?>

    </a>
<?php endif; ?>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if($products->isEmpty()): ?>
    <div class="alert alert-info text-center">
        <span style="font-size:50px;">📦</span>
        <p class="mt-2"><?php echo e(__('lang.no_products')); ?></p>
    </div>
<?php endif; ?>

<div class="row g-4">
<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="card p-3 text-center h-100 d-flex flex-column">

            <?php if($product->image): ?>
                <a href="/products/<?php echo e($product->id); ?>">
                    <img src="<?php echo e(asset($product->image)); ?>" class="product-img mb-2" alt="<?php echo e($product->name); ?>">
                </a>
            <?php endif; ?>

            <h5 class="product-card-title">
                <a href="/products/<?php echo e($product->id); ?>" class="text-dark text-decoration-none">
                    <?php echo e($product->name); ?>

                </a>
            </h5>

            <p class="text-success fw-bold">
                <?php echo e(number_format($product->price, 0, '.', ' ')); ?> тг
            </p>

            <div class="mt-auto d-flex flex-column gap-2">

                <a href="/products/<?php echo e($product->id); ?>" class="btn btn-outline-dark btn-sm">
                    👁️ <?php echo e(__('lang.view')); ?>

                </a>

                <?php if(auth()->guard()->check()): ?>
                    <form method="POST" action="/cart/add">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                        <button class="btn btn-success w-100 btn-sm">
                            🛒 <?php echo e(__('lang.add_to_cart')); ?>

                        </button>
                    </form>
                <?php endif; ?>

                <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin|manager')): ?>
                    <form method="POST" action="/products/<?php echo e($product->id); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-danger btn-sm w-100">
                            🗑️ <?php echo e(__('lang.delete')); ?>

                        </button>
                    </form>
                <?php endif; ?>

            </div>
        </div>
    </div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\777\Downloads\electromarket_fixed_v2\electromarket_fixed\resources\views/products.blade.php ENDPATH**/ ?>