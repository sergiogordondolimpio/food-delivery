<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $__env->make('/components/head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></head>
<body>

    <?php echo $__env->make('/components/nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row justify-content-md-center mt-5 ">
        <h1>Succesfull registration</h1>
        <h3><?php echo e($name); ?></h3>
        <h3><?php echo e($email); ?></h3>
        <h3><?php echo e($telephone); ?></h3>
    </div>

</body><?php /**PATH C:\laragon\www\food-delivery\resources\views/auth/succesfull-registration.blade.php ENDPATH**/ ?>