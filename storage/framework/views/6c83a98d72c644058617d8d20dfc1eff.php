<?php $__env->startSection('content'); ?>

<h2 class="fw-bold mb-4">📋 <?php echo e(__('lang.all_orders')); ?></h2>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if($orders->isEmpty()): ?>
    <div class="alert alert-info"><?php echo e(__('lang.no_orders')); ?></div>
<?php else: ?>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th><?php echo e(__('lang.customer')); ?></th>
                    <th><?php echo e(__('lang.phone')); ?></th>
                    <th><?php echo e(__('lang.city')); ?></th>
                    <th><?php echo e(__('lang.total')); ?></th>
                    <th><?php echo e(__('lang.payment_method')); ?></th>
                    <th><?php echo e(__('lang.status')); ?></th>
                    <th><?php echo e(__('lang.date')); ?></th>
                    <th><?php echo e(__('lang.action')); ?></th>
                </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($order->id); ?></td>
                    <td>
                        <strong><?php echo e($order->full_name); ?></strong><br>
                        <small class="text-muted"><?php echo e($order->user->email); ?></small>
                    </td>
                    <td><?php echo e($order->phone); ?></td>
                    <td><?php echo e($order->city); ?></td>
                    <td><?php echo e(number_format($order->total_price, 0, '.', ' ')); ?> тг</td>
                    <td>
                        <?php if($order->payment_method === 'cash'): ?> 💵
                        <?php elseif($order->payment_method === 'card'): ?> 💳
                        <?php else: ?> 📱
                        <?php endif; ?>
                        <?php echo e($order->payment_method); ?>

                    </td>
                    <td>
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
                    </td>
                    <td><?php echo e($order->created_at->format('d.m.Y')); ?></td>
                    <td>
                        
                        <form method="POST" action="/admin/orders/<?php echo e($order->id); ?>/status">
                            <?php echo csrf_field(); ?>
                            <select name="status" class="form-select form-select-sm"
                                onchange="this.form.submit()">
                                <option value="pending"    <?php echo e($order->status==='pending'    ? 'selected' : ''); ?>>pending</option>
                                <option value="processing" <?php echo e($order->status==='processing' ? 'selected' : ''); ?>>processing</option>
                                <option value="delivered"  <?php echo e($order->status==='delivered'  ? 'selected' : ''); ?>>delivered</option>
                                <option value="cancelled"  <?php echo e($order->status==='cancelled'  ? 'selected' : ''); ?>>cancelled</option>
                            </select>
                        </form>
                    </td>
                </tr>

                
                <?php if($order->items->count()): ?>
                <tr class="table-light">
                    <td colspan="9">
                        <small>
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            📦 <?php echo e($item->product->name); ?> ×<?php echo e($item->quantity); ?>

                            (<?php echo e(number_format($item->price * $item->quantity, 0, '.', ' ')); ?> тг)
                            <?php if(!$loop->last): ?> &nbsp;|&nbsp; <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </small>
                    </td>
                </tr>
                <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\777\Downloads\electromarket_fixed_v2\electromarket_fixed\resources\views/admin/orders.blade.php ENDPATH**/ ?>