<?php $__env->startSection('content'); ?>

<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-7">

        
        <div class="card p-4 text-center mb-4">
            <div style="font-size:60px;">👤</div>
            <h3 class="mt-2 fw-bold"><?php echo e($user->name); ?></h3>
            <p class="text-muted"><?php echo e($user->email); ?></p>
            <div class="mb-3">
                <strong><?php echo e(__('lang.role')); ?>:</strong>
                <span class="badge bg-primary ms-1">
                    <?php echo e($user->getRoleNames()->first() ?? 'N/A'); ?>

                </span>
            </div>
            <div class="d-flex gap-2 justify-content-center flex-wrap">
                <a href="/products" class="btn btn-outline-dark">🛍️ <?php echo e(__('lang.products')); ?></a>
                <a href="/cart" class="btn btn-outline-success">🛒 <?php echo e(__('lang.cart')); ?></a>
                <a href="/logout" class="btn btn-dark"><?php echo e(__('lang.logout')); ?></a>
            </div>
        </div>

        
        <h5 class="fw-bold mb-3">📦 <?php echo e(__('lang.my_orders')); ?></h5>

        <?php if($orders->isEmpty()): ?>
            <div class="alert alert-info"><?php echo e(__('lang.no_orders_yet')); ?></div>
        <?php else: ?>
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card p-3 mb-3">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <strong><?php echo e(__('lang.order')); ?> #<?php echo e($order->id); ?></strong>
                            <span class="text-muted ms-2"><?php echo e($order->created_at->format('d.m.Y')); ?></span>
                        </div>
                        <?php
                            $badge = match($order->status) {
                                'pending'    => 'warning',
                                'processing' => 'info',
                                'delivered'  => 'success',
                                'cancelled'  => 'danger',
                                default      => 'secondary'
                            };
                        ?>
                        <span class="badge bg-<?php echo e($badge); ?>"><?php echo e($order->status); ?></span>
                    </div>
                    <hr class="my-2">
                    <div class="d-flex justify-content-between">
                        <span><?php echo e($order->city); ?>, <?php echo e($order->address); ?></span>
                        <strong><?php echo e(number_format($order->total_price, 0, '.', ' ')); ?> тг</strong>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\777\Downloads\electromarket_fixed_v2\electromarket_fixed\resources\views/profile.blade.php ENDPATH**/ ?>