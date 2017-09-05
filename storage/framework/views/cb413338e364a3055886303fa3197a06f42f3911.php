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
	<form method="POST" action="<?php echo e(url('edit-school')); ?>">
		<?php echo e(csrf_field()); ?>

		<?php if($school): ?>
			<input type="hidden" name="school_id" value="<?php echo e($school->id); ?>" />
		<?php endif; ?>
		<div class="padded-full">
		    <h5 class="pull-right">School Name</h5>
		</div>
		<div class="padded-full">
			<input type="text" name="name" <?php if($school): ?> value="<?php echo e($school->name); ?>" <?php endif; ?> placeholder="School Name" autofocus>
		</div>
		<div class="padded-full">
		    <h5 class="pull-right">Address</h5>
		</div>
		<div class="padded-full">
			<input type="text" name="address" <?php if($school): ?> value="<?php echo e($school->address); ?>" <?php endif; ?> placeholder="Address">
		</div>
		<div class="padded-full">
		    <h5 class="pull-right">Phone</h5>
		</div>
		<div class="padded-full">
			<input type="text" name="phone" <?php if($school): ?> value="<?php echo e($school->phone); ?>" <?php endif; ?> placeholder="Phone">
		</div>
		<div class="padded-full">
		    <h5 class="pull-right">School Type</h5>
		</div>
		<div class="padded-full">
			<select name="school_type">
				<option disabled>Select a School Type</option>
			    <option value='kenyan_primary' <?php if($school->school_type=='kenyan_primary'): ?> selected <?php endif; ?>>Kenyan Primary</option>
			    <!-- <option value='kenyan_secondary' >Kenyan Secondary</option>
			    <option value='kenyan_university' >Kenyan University</option> -->
			</select>
		</div>
		<div class="padded-full">
			<button type="submit" class="btn fit-parent primary">Save Settings</button>
		</div>
	</form>
	<div class="padded-full">
	    <a href="<?php echo e(url('settings')); ?>"><button class="btn fit-parent">Go Back</button></a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('partials-script'); ?>
	<?php if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success')): ?>
		<?php echo $__env->make('core.partials.notify-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('core.layout.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>