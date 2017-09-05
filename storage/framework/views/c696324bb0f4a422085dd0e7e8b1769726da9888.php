<?php $__env->startSection('body'); ?>
    <div class="padded-full text-center">
        <p>
        	Are you sure you want to delete this assessment <strong><?php echo e($assessment->name); ?></strong>?
        </p>
        <p>
        	<strong>Note:</strong> All associated grades will be deleted.
        </p>
    </div>
    <form method="POST" action="<?php echo e(url('delete-assessment', $assessment->id)); ?>">
		<?php echo e(csrf_field()); ?>

	    <div class="padded-full">
	        <button type="submit" class="btn fit-parent negative">Yes, Delete Assessment</button>
	    </div>
	</form>
	<div class="padded-full">
	    <a href="<?php echo e(url('view-exam', $assessment->exam->id)); ?>"><button class="btn fit-parent">No, Go Back</button></a>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('core.layout.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>