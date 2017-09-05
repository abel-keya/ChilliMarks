<?php $__env->startSection('partials'); ?>

<?php if(Session::has('info')): ?>
<?php echo $__env->make('core.partials.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<?php if(Session::has('success')): ?>
<?php echo $__env->make('core.partials.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<?php if(Session::has('error')): ?>
<?php echo $__env->make('core.partials.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<?php if(Session::has('errors')): ?>
<?php echo $__env->make('core.partials.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
    <div class="padded-full">
        <ul class="list">
            <li><strong>Class Name:</strong> <?php echo e($class->name); ?></li>
            <li><strong>Year:</strong> <?php echo e($class->year); ?></li>
        </ul>
    </div>
    <?php if($streams->count()>0): ?>
    <div class="padded-full">
        <ul class="list">
            <li class="divider text-center"><p>Streams</p></li>
        </ul>
    </div>
    <?php endif; ?>
    <div class="padded-full">
        <ul class="list">
            <?php $__currentLoopData = $streams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stream): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php echo e(url('view-stream', $stream->id)); ?>"><strong>Stream Name:</strong> <?php echo e($stream->name); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <div class="padded-full">
        <a href="<?php echo e(url('create-stream', $class->id)); ?>">
            <button class="btn fit-parent primary">Add a Stream</button>
        </a>
        <a href="<?php echo e(url('edit-class', $class->id)); ?>">
            <button class="btn fit-parent primary" style="margin-top:10px;">Edit Class</button>
        </a>
        <a href="<?php echo e(url('confirm-class', $class->id)); ?>">
            <button class="btn fit-parent negative" style="margin-top:10px;">Delete Class</button>
        </a>
        <a href="<?php echo e(url('classes')); ?>">
            <button class="btn fit-parent" style="margin-top:10px;">Go Back</button>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('partials-script'); ?>
<?php if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success')): ?>
<?php echo $__env->make('core.partials.notify-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('core.layout.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>