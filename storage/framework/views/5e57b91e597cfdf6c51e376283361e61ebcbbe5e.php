

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('/components/banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="row justify-content-center">
                <?php for($j = 0; $j < 12; $j++): ?>
                    <?php echo $__env->make('products/cardExample', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\food-delivery\resources\views/home.blade.php ENDPATH**/ ?>