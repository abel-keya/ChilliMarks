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
<form method="POST" action="<?php echo e(url('update-subject', $subject->id)); ?>">
	<?php echo e(csrf_field()); ?>

	<div class="padded-full">
	    <h5 class="pull-right">Subject Name</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="name" value="<?php echo e($subject->name); ?>" autocomplete="off" placeholder="Enter Subject Name" autofocus>
	</div>
	<div class="padded-full">
	    <h5 class="pull-right">Subject Abbreviation</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="abbr" value="<?php echo e($subject->abbr); ?>" autocomplete="off" placeholder="Enter Subject Abbreviation">
	</div>
	<div class="padded-full">
	    <h5 class="pull-right">Subject Code</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="code" value="<?php echo e($subject->code); ?>" autocomplete="off" placeholder="Enter Subject Code">
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Save Edit</button>
	</div>
</form>
<div class="padded-full">
	<a href="<?php echo e(url('view-subject', $subject->id)); ?>">
		<button class="btn fit-parent">Go Back</button>
	</a>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('partials-script'); ?>
<?php if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success')): ?>
<?php echo $__env->make('core.partials.notify-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('core.layout.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>