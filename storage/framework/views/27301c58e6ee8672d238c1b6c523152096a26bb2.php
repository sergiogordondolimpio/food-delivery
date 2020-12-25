

<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row justify-content-center">
        
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center mt-5">
                    <div class="card" style="min-width: 300px;">
                        <img class="card-img-top" style="width: 100%;" src="<?php echo e(asset('storage/docs/'.$product->file)); ?>" alt="Card image cap">
                        <div class="card-body">
                            <h2 class="card-title"> <?php echo e($product->title); ?> </h2>
                            <p class="card-text"> <?php echo nl2br(e($product->description)); ?> </p>
                            <p class="font-weight-bold text-right h4"> <?php echo e($product->price); ?> </p>
                            <a href=<?php echo e("/".$product->id); ?> class="btn btn-primary btn-sm">Edit</a>
                            <a href=<?php echo e("/delete/".$product->id); ?> class="btn btn-primary btn-sm">Delete</a>
                        </div>
                    </div>
                </div>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="d-flex flex-column">
                    <div class="card-header mt-3">
                        <h2>There is no products</h2>
                    </div>
                    <?php echo $__env->make('products/cardExample', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            <?php endif; ?>
            
        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\food-delivery\resources\views/Products/listProducts.blade.php ENDPATH**/ ?>