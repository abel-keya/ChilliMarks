<?php $__env->startSection('body'); ?>
    <div class="padded-full">
        <p class="text-center">Are you sure you want to delete this stream <strong><?php echo e($stream->name); ?></strong>?</p>
    </div>
    <form method="POST" action="<?php echo e(url('delete-stream', $stream->id)); ?>">
		<?php echo e(csrf_field()); ?>

	    <div class="padded-full">
	        <button type="submit" class="btn fit-parent negative">Yes, Delete Stream</button>
	    </div>
	</form>
	<div class="padded-full">
	    <a href="<?php echo e(url('view-stream', $stream->id)); ?>"><button class="btn fit-parent">No, Go Back</button></a>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('core.layout.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>