<?php $__env->startSection('content'); ?>

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card p-4 text-center">

            <h3 class="mb-3">👤 Profile</h3>

            <div class="mb-3">
                <h5><?php echo e($user->name); ?></h5>
                <p class="text-muted"><?php echo e($user->email); ?></p>
            </div>

            <!-- ROLE -->
            <div class="mb-3">
                <strong>Role:</strong>
                <span class="badge bg-primary">
                    <?php echo e($user->getRoleNames()->first()); ?>

                </span>
            </div>

            <!-- ACTIONS -->


            <a href="/logout" class="btn btn-dark w-100">Logout</a>

        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\777\Desktop\electromarket\resources\views/profile.blade.php ENDPATH**/ ?>