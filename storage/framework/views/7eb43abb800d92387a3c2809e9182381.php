<?php $__env->startSection('content'); ?>

<style>
@media (max-width: 576px) {
    .checkout-summary { margin-top: 20px; }
}
</style>

<h2 class="fw-bold mb-4">💳 <?php echo e(__('lang.checkout')); ?></h2>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($err); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<div class="row g-4">

    
    <div class="col-12 col-lg-7">
        <div class="card p-4">

            <h5 class="fw-bold mb-3">📦 <?php echo e(__('lang.delivery_details')); ?></h5>

            <form method="POST" action="/checkout">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label class="form-label"><?php echo e(__('lang.full_name')); ?></label>
                    <input type="text" name="full_name" class="form-control"
                        value="<?php echo e(old('full_name', Auth::user()->name)); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><?php echo e(__('lang.phone')); ?></label>
                    <input type="text" name="phone" class="form-control"
                        placeholder="+7 (777) 000-00-00" value="<?php echo e(old('phone')); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><?php echo e(__('lang.city')); ?></label>
                    <input type="text" name="city" class="form-control"
                        placeholder="<?php echo e(__('lang.city')); ?>" value="<?php echo e(old('city')); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><?php echo e(__('lang.address')); ?></label>
                    <textarea name="address" class="form-control" rows="2"
                        placeholder="<?php echo e(__('lang.address_placeholder')); ?>" required><?php echo e(old('address')); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label"><?php echo e(__('lang.payment_method')); ?></label>
                    <select name="payment_method" class="form-select">
                        <option value="cash">💵 <?php echo e(__('lang.pay_cash')); ?></option>
                        <option value="card">💳 <?php echo e(__('lang.pay_card')); ?></option>
                        <option value="online">📱 <?php echo e(__('lang.pay_online')); ?></option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success w-100 mt-2" style="font-size:18px;">
                    ✅ <?php echo e(__('lang.place_order')); ?>

                </button>

            </form>
        </div>
    </div>

    
    <div class="col-12 col-lg-5 checkout-summary">
        <div class="card p-4">

            <h5 class="fw-bold mb-3">🧾 <?php echo e(__('lang.order_summary')); ?></h5>

            <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex justify-content-between mb-2">
                    <span>
                        <?php echo e($item->product->name); ?>

                        <span class="text-muted">×<?php echo e($item->quantity); ?></span>
                    </span>
                    <strong><?php echo e(number_format($item->product->price * $item->quantity, 0, '.', ' ')); ?> тг</strong>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <hr>

            <div class="d-flex justify-content-between">
                <h5><?php echo e(__('lang.total')); ?></h5>
                <h5 class="text-success"><?php echo e(number_format($total, 0, '.', ' ')); ?> тг</h5>
            </div>

            <a href="/cart" class="btn btn-outline-secondary btn-sm mt-3">
                ← <?php echo e(__('lang.edit_cart')); ?>

            </a>

        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\777\Downloads\electromarket_fixed_v2\electromarket_fixed\resources\views/checkout.blade.php ENDPATH**/ ?>