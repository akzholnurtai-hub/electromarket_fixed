<?php $__env->startSection('content'); ?>

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

    
    <div class="col-12 col-md-6">
        <?php if($product->image): ?>
            <img src="<?php echo e(asset($product->image)); ?>" class="detail-img shadow" alt="<?php echo e($product->name); ?>">
        <?php else: ?>
            <div class="bg-secondary d-flex align-items-center justify-content-center detail-img text-white rounded">
                <span style="font-size:80px;">📦</span>
            </div>
        <?php endif; ?>
    </div>

    
    <div class="col-12 col-md-6">
        <div class="card p-4 h-100">

            <h2 class="fw-bold"><?php echo e($product->name); ?></h2>

            <h3 class="text-success mt-3">
                <?php echo e(number_format($product->price, 0, '.', ' ')); ?> тг
            </h3>

            <?php if($product->description): ?>
                <p class="text-muted mt-3"><?php echo e($product->description); ?></p>
            <?php endif; ?>

            <hr>

            <?php if(auth()->guard()->check()): ?>
                <form method="POST" action="/cart/add">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                    <button class="btn btn-success w-100 mb-2" style="font-size:18px;">
                        🛒 <?php echo e(__('lang.add_to_cart')); ?>

                    </button>
                </form>

                <a href="/checkout" class="btn btn-warning w-100">
                    ⚡ <?php echo e(__('lang.order_now')); ?>

                </a>

                <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin|manager')): ?>
                    <form method="POST" action="/products/<?php echo e($product->id); ?>" class="mt-3">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-danger btn-sm">
                            🗑️ <?php echo e(__('lang.delete')); ?>

                        </button>
                    </form>
                <?php endif; ?>

            <?php endif; ?>

            <?php if(auth()->guard()->guest()): ?>
                <a href="/login" class="btn btn-dark w-100">
                    🔒 <?php echo e(__('lang.login')); ?>

                </a>
            <?php endif; ?>

            <div class="mt-3">
                <a href="/products" class="btn btn-outline-secondary btn-sm">
                    ← <?php echo e(__('lang.back')); ?>

                </a>
            </div>

        </div>
    </div>

</div>

<?php if(session('success')): ?>
    <div class="alert alert-success mt-3"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\777\Downloads\electromarket_fixed_v2\electromarket_fixed\resources\views/product-detail.blade.php ENDPATH**/ ?>