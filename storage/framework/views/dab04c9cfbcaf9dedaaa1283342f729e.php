<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="UTF-8">
    <title>Electro Market</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #eef2f7;
        }

        .navbar {
            border-radius: 0 0 15px 15px;
        }

        .card {
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .btn {
            border-radius: 10px;
        }

        .hero {
            background: linear-gradient(135deg, #1f2c3a, #2e4a62);
            color: white;
            border-radius: 25px;
            padding: 40px;
        }

        .product-img {
            height: 200px;
            object-fit: cover;
            border-radius: 15px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark bg-dark p-3">
    <div class="container">

        <a class="navbar-brand fw-bold" href="/">
            ⚡ Electro Market
        </a>

        <div>

            <?php if(auth()->guard()->check()): ?>
                <a href="/profile" class="btn btn-outline-light me-2">
                    <?php echo e(__('lang.profile')); ?>

                </a>
            <?php endif; ?>

            <?php if(auth()->guard()->guest()): ?>

                <a href="/login" class="btn btn-outline-light me-2">
                    <?php echo e(__('lang.login')); ?>

                </a>

                <a href="/register" class="btn btn-warning me-2">
                    <?php echo e(__('lang.register')); ?>

                </a>

            <?php endif; ?>

            <?php if(auth()->guard()->check()): ?>

                <a href="/products" class="btn btn-outline-light me-2">
                    <?php echo e(__('lang.products')); ?>

                </a>

                <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>

                    <a href="/analytics" class="btn btn-danger me-2">
                        <?php echo e(__('lang.analytics')); ?>

                    </a>

                <?php endif; ?>

                <a href="/logout" class="btn btn-warning me-2">
                    <?php echo e(__('lang.logout')); ?>

                </a>

            <?php endif; ?>

            <a href="/lang/kk" class="btn btn-outline-light me-1">
                KK
            </a>

            <a href="/lang/ru" class="btn btn-outline-light me-1">
                RU
            </a>

            <a href="/lang/en" class="btn btn-outline-light">
                EN
            </a>

        </div>

    </div>
</nav>

<div class="container mt-4">
    <?php echo $__env->yieldContent('content'); ?>
</div>

</body>
</html><?php /**PATH C:\Users\777\Desktop\electromarket\resources\views/layout.blade.php ENDPATH**/ ?>