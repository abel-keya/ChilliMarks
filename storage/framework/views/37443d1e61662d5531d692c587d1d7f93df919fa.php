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
		<a href="<?php echo e(url('school')); ?>">
	        <button class="btn fit-parent primary" style="margin-top: 10px;">School Settings</button>
	    </a>
	    <a href="<?php echo e(url('classes-settings')); ?>">
	        <button class="btn fit-parent primary" style="margin-top: 10px;">Classes Settings</button>
	    </a>
	    <a href="<?php echo e(url('groups-settings')); ?>">
	        <button class="btn fit-parent primary" style="margin-top: 10px;">Groups Settings</button>
	    </a>
	    <a href="<?php echo e(url('subjects')); ?>">
	        <button class="btn fit-parent primary" style="margin-top: 10px;">Subject Settings</button>
	    </a>
	    <?php if($school->school_type=='kenyan_secondary'): ?>
		    <a href="<?php echo e(url('classifications')); ?>">
		        <button class="btn fit-parent primary" style="margin-top: 10px;">Classifications</button>
		    </a>
	    <?php endif; ?>
	    <a href="<?php echo e(url('backup-settings')); ?>">
	        <button class="btn fit-parent primary" style="margin-top: 10px;">Backup Settings</button>
	    </a>
	    <a href="<?php echo e(url('about')); ?>">
	        <button class="btn fit-parent primary" style="margin-top: 10px;">About ChilliMarks</button>
	    </a>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('partials-script'); ?>
	<?php if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success')): ?>
		<?php echo $__env->make('core.partials.notify-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('core.layout.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>