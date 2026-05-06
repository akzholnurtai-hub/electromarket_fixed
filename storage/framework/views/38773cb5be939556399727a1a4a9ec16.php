<?php $__env->startSection('content'); ?>

<style>
.cart-img {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 10px;
}

@media (max-width: 576px) {
    .cart-img {
        width: 50px;
        height: 50px;
    }
    .cart-row td {
        font-size: 13px;
    }
}
</style>

<h2 class="fw-bold mb-4">🛒 <?php echo e(__('lang.cart')); ?></h2>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if($cartItems->isEmpty()): ?>

    <div class="card p-5 text-center">
        <span style="font-size:60px;">🛒</span>
        <h4 class="mt-3"><?php echo e(__('lang.cart_empty')); ?></h4>
        <a href="/products" class="btn btn-dark mt-3">
            <?php echo e(__('lang.go_shopping')); ?>

        </a>
    </div>

<?php else: ?>

    <div class="card p-3 p-md-4">

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-dark">
                    <tr>
                        <th><?php echo e(__('lang.product')); ?></th>
                        <th><?php echo e(__('lang.price')); ?></th>
                        <th><?php echo e(__('lang.quantity')); ?></th>
                        <th><?php echo e(__('lang.subtotal')); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="cart-row">
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <?php if($item->product->image): ?>
                                    <img src="<?php echo e(asset($item->product->image)); ?>" class="cart-img" alt="<?php echo e($item->product->name); ?>">
                                <?php else: ?>
                                    <span style="font-size:40px;">📦</span>
                                <?php endif; ?>
                                <div>
                                    <strong><?php echo e($item->product->name); ?></strong>
                                </div>
                            </div>
                        </td>
                        <td><?php echo e(number_format($item->product->price, 0, '.', ' ')); ?> тг</td>
                        <td>
                            <form method="POST" action="/cart/update/<?php echo e($item->id); ?>" class="d-flex align-items-center gap-2">
                                <?php echo csrf_field(); ?>
                                <input type="number" name="quantity" value="<?php echo e($item->quantity); ?>"
                                    min="0" class="form-control" style="width:70px;">
                                <button class="btn btn-sm btn-outline-secondary">↻</button>
                            </form>
                        </td>
                        <td><?php echo e(number_format($item->product->price * $item->quantity, 0, '.', ' ')); ?> тг</td>
                        <td>
                            <form method="POST" action="/cart/remove/<?php echo e($item->id); ?>">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-sm btn-danger">✕</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mt-3">
            <h4 class="fw-bold">
                <?php echo e(__('lang.total')); ?>: <?php echo e(number_format($total, 0, '.', ' ')); ?> тг
            </h4>
            <div class="d-flex gap-2">
                <a href="/products" class="btn btn-outline-secondary">
                    ← <?php echo e(__('lang.continue_shopping')); ?>

                </a>
                <a href="/checkout" class="btn btn-success">
                    💳 <?php echo e(__('lang.checkout')); ?>

                </a>
            </div>
        </div>

    </div>

<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\777\Downloads\electromarket_fixed_v2\electromarket_fixed\resources\views/cart.blade.php ENDPATH**/ ?>