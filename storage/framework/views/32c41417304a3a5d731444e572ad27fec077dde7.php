

<?php $__env->startSection('content'); ?>
    
<div class="container">
    <div class="row">
        <div class="col-sm-6 card p-4 m-4">
            <form id="addProductForm" action="add" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                <label>Title</label>
                <input name="title" id="title" type="text" class="form-control" placeholder="Enter title" value="<?php echo e($title); ?>">
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter description..."><?php echo e($description); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input name="price" id="price" type="text" class="form-control" placeholder="Enter price" value="<?php echo e($price); ?>">
                    <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group">
                    <label>Select Image</label>
                    <input id="image" name="image" type="file" class="form-control-file">
                </div>
                <input type="hidden" name="id" value="<?php echo e($id); ?>">
                <input type="hidden" name="imagePreview" value="<?php echo e($imagePreview); ?>">
                <input type="hidden" name="titlePreview" value="<?php echo e($titlePreview); ?>">
                <input type="hidden" name="descriptionPreview" value="<?php echo e($descriptionPreview); ?>">
                <input type="hidden" name="pricePreview" value="<?php echo e($pricePreview); ?>">

                <?php if($id == 'error'): ?>
                <div class="alert alert-danger">The title do not exist, please select ADD button</div>
                <?php endif; ?>
                <button type="submit" type="button" class="btn btn-primary" value="preview" name="submitButton">Preview</button>
                <?php if($id): ?>
                    <?php if($id == 'error'): ?>
                        <button type="submit" type="button" class="btn btn-primary" value="add" name="submitButton">Add</button>
                    <?php else: ?>
                        <button  type="submit" class="btn btn-primary" value="update" name="submitButton">Update</button>
                    <?php endif; ?>
                <?php else: ?>
                    <button type="submit" type="button" class="btn btn-primary" value="add" name="submitButton">Add</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col card p-4 m-4">
            <div class="card" style="width: 25rem;">
                <img id="previewFile" class="card-img-top" src="<?php echo e(asset($imagePreview)); ?>" alt="Card image cap">
                <div class="card-body">
                    <h2 id="previewTitle" class="card-title"><?php echo e($titlePreview); ?></h2>
                    <p id="previewDescription" class="card-text"><?php echo nl2br(e($descriptionPreview)); ?></p>
                    <p id="previewPrice" class="font-weight-bold text-right h4"><?php echo e($pricePreview); ?></p>
                    <a href="#" class="btn btn-primary btn-sm">Add cart</a>
                </div>
            </div>  
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\food-delivery\resources\views//products/addProduct.blade.php ENDPATH**/ ?>