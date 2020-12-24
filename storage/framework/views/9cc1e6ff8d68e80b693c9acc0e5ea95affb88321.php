<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $__env->make('/components/head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></head>
<body>

    <?php echo $__env->make('/components/nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container">
        
                <form id="addProductForm" action="/api/add" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                      <label>Title</label>
                      <input name="title" id="title" type="text" class="form-control" placeholder="Enter title" value="<?php echo e(old('title')); ?>">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter description..."><?php echo e(old('description')); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input name="price" id="price" type="text" class="form-control" placeholder="Enter price" value="<?php echo e(old('price')); ?>">
                    </div>
                    <div class="form-group">
                        <label>Select Image</label>
                        <input id="image" name="image" type="file" class="form-control-file">
                        <input type="hidden" name="file" id="file" value="image6.png">
                    </div>
                    <button  type="submit" class="btn btn-primary">Add</button>
                </form>
        
    </div>

    
</body>
</html><?php /**PATH C:\laragon\www\food-delivery\resources\views/products/addProductApi.blade.php ENDPATH**/ ?>