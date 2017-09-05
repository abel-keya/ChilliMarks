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
<form method="POST" action="<?php echo e(url('create-assessment', $id)); ?>">
	<?php echo e(csrf_field()); ?>

	<div class="padded-full">
		<h5 class="pull-right">Assessment</h5>
	</div>
	<div class="padded-full">
		<select name="assessment_name">
			<option disabled selected>Select an Assessment</option>
		    <?php $__currentLoopData = $codes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		    	<option value='<?php echo e($code); ?>'><?php echo e($code); ?></option>
		    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</select>
	</div>
	<div class="padded-full">
		<select name="teacher_id">
			<option disabled selected>Select a Teacher</option>
		    <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		    	<option value='<?php echo e($teacher->id); ?>'><?php echo e($teacher->name); ?></option>
		    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</select>
	</div>

	<?php if($school->school_type=='kenyan_secondary'): ?> 
	<div class="padded-full">
		<h5 class="pull-right">Out of Marks</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="out_of" value="<?php echo e(old('out_of')); ?>" autocomplete="off" placeholder="Enter Out of Marks">
	</div>
	<div class="padded-full">
		<h5 class="pull-right">Contribution (%) of Total</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="contribution" value="<?php echo e(old('contribution')); ?>" autocomplete="off" placeholder="Enter Contribution Marks">
	</div>
	<?php endif; ?>

	<div class="padded-full">
		<ul class="list">
			<li class="padded-for-list">
				<label class="radio">
					<input type="radio" name="grades" value="allstudents" checked>
					Create for All Students
					<span></span>
				</label>
			</li>
			<li class="padded-for-list">
				<label class="radio">
					<input type="radio" name="grades" value="selectstudents">
					Create for Select Students
					<span></span>
				</label>
			</li>
		</ul>
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Create Assessment</button>
	</div>
</form>
<div class="padded-full">
	<a href="<?php echo e(url('view-exam', $id)); ?>">
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