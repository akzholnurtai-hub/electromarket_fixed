<?php $__env->startSection('content'); ?>

<div class="row justify-content-center">
    <div class="col-12 col-md-7 col-lg-6">

        <div class="card p-4">

            <h3 class="fw-bold mb-4">➕ <?php echo e(__('lang.add_product')); ?></h3>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div><?php echo e($err); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <form action="/products" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label class="form-label fw-semibold"><?php echo e(__('lang.name')); ?></label>
                    <input type="text" name="name" class="form-control"
                        placeholder="<?php echo e(__('lang.name')); ?>" value="<?php echo e(old('name')); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold"><?php echo e(__('lang.price')); ?> (тг)</label>
                    <input type="number" name="price" class="form-control"
                        placeholder="0" value="<?php echo e(old('price')); ?>" required min="0">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold"><?php echo e(__('lang.description')); ?></label>
                    <textarea name="description" class="form-control" rows="3"
                        placeholder="<?php echo e(__('lang.description')); ?>"><?php echo e(old('description')); ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold"><?php echo e(__('lang.image')); ?></label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-dark flex-grow-1">
                        <?php echo e(__('lang.save')); ?>

                    </button>
                    <a href="/products" class="btn btn-outline-secondary">
                        <?php echo e(__('lang.back')); ?>

                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\777\Downloads\electromarket_fixed_v2\electromarket_fixed\resources\views/products/create.blade.php ENDPATH**/ ?>