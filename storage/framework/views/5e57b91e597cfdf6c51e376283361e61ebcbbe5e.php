

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('/components/banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="row justify-content-center">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center mt-5">
                    <div class="card" style="min-width: 300px;">
                        <img class="card-img-top" style="width: 100%;" src='<?php echo e(asset("storage/docs/$product->file")); ?>' alt="Card image cap">
                        <div class="card-body">
                            <h2 class="card-title"><?php echo e($product->title); ?></h2>
                            <p class="card-text"><?php echo e($product->description); ?></p>
                            <p class="font-weight-bold text-right h4"><?php echo e($product->price); ?></p>
                            <a href="/cart/<?php echo e($product->id); ?>" class="btn btn-primary btn-sm">Add cart</a>
                        </div>
                    </div>
                </div>  
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\food-delivery\resources\views/home.blade.php ENDPATH**/ ?>