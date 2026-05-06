<?php $__env->startSection('content'); ?>

<style>
/* ✅ Media Queries — login формасы (Slide 17) */
@media (max-width: 576px) {
    .login-card {
        margin: 0 10px;
    }
}
</style>


<div class="row justify-content-center mt-5">

    <div class="col-12 col-sm-8 col-md-5 col-lg-4 login-card">

        <div class="card p-4">

            <h3 class="text-center mb-3">
                <?php echo e(__('lang.login')); ?>

            </h3>

            <form method="POST" action="/login">

                <?php echo csrf_field(); ?>

                <input
                    type="email"
                    name="email"
                    class="form-control mb-2"
                    placeholder="<?php echo e(__('lang.email')); ?>"
                >

                <input
                    type="password"
                    name="password"
                    class="form-control mb-3"
                    placeholder="<?php echo e(__('lang.password')); ?>"
                >

                
                <button class="btn btn-dark w-100">
                    <?php echo e(__('lang.login')); ?>

                </button>

            </form>

            <?php if(session('message')): ?>

                <div class="alert alert-danger mt-3">
                    <?php echo e(session('message')); ?>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\777\Downloads\electromarket_fixed_v2\electromarket_fixed\resources\views/login.blade.php ENDPATH**/ ?>