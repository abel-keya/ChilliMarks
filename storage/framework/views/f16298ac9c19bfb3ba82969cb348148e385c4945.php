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
<form method="POST" action="<?php echo e(url('update-teacher', $teacher->id)); ?>">
	<?php echo e(csrf_field()); ?>

	<div class="padded-full">
	    <h5 class="pull-right">Name</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="name" value="<?php echo e($teacher->name); ?>" autocomplete="off" placeholder="Enter Teacher Name" autofocus>
	</div>
	<div class="padded-full">
	    <h5 class="pull-right">Phone</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="phone" value="<?php echo e($teacher->phone); ?>" autocomplete="off" placeholder="Enter Phone No.">
	</div>
	<div class="padded-full">
		<h5 class="pull-right">Year</h5>
	</div>
	<div class="padded-full">
		<select name="year">
			<option disabled>Select a Year</option>
			<?php for($y = 0; $y < count($years); $y++): ?>
				<option value='<?php echo e($years[$y]); ?>' <?php if($teacher_year==$years[$y]): ?> selected <?php endif; ?>><?php echo e($years[$y]); ?></option>
			<?php endfor; ?>
		</select>
	</div>
	<div class="padded-full">
		<ul class="list">
			<li class="">
				<label class="checkbox">
				<input type="checkbox" name="oldpassword" value="1" checked>
					Check to use old password
					<span></span>
				</label>
			</li>
		</ul>
	</div>
	<div class="padded-full">
	    <h5 class="pull-right">Password</h5>
	</div>
	<div class="padded-full">
		<input type="password" name="password" autocomplete="off">
	</div>
	<div class="padded-full">
	    <h5 class="pull-right">Re-type Password</h5>
	</div>
	<div class="padded-full">
		<input type="password" name="password_confirm" autocomplete="off">
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Update Teacher</button>
	</div>
</form>
<div class="padded-full">
	<a href="<?php echo e(url('teachers')); ?>">
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