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
<form method="POST" action="<?php echo e(url('create-exam')); ?>">
	<?php echo e(csrf_field()); ?>

	<div class="padded-full">
	    <h5 class="pull-right">Exam Name</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="name" value="<?php echo e(old('name')); ?>" autocomplete="off" placeholder="Exam Name i.e. End Term" autofocus>
	</div>
	<div class="padded-full">
		<select name="subject_id">
			<option disabled selected>Select a Subject</option>
			<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		    	<option value='<?php echo e($subject->id); ?>'><?php echo e($subject->name); ?></option>
		    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</select>
	</div>
	<div class="padded-full">
		<select name="stream_id">
			<option disabled selected>Select a Stream</option>
		    <?php $__currentLoopData = $streams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stream): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		    	<option value='<?php echo e($stream->id); ?>'><?php echo e($stream->name); ?></option>
		    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</select>
	</div>
	<div class="padded-full">
		<select name="period">
			<option disabled selected>Select a Term</option>
		    <option value='Term 1'>Term 1</option>
		   	<option value='Term 2'>Term 2</option>
		   	<option value='Term 3'>Term 3</option>
		</select>
	</div>
	<div class="padded-full">
		<select name="year">
			<option disabled>Select a Year</option>
			<?php for($i=0; $i<=80; $i++): ?> 
		   		<option value='<?php echo e(1970 + $i); ?>' <?php if( (1970 + $i)== date('Y') ): ?> selected <?php endif; ?>><?php echo e(1970 + $i); ?></option>
		   	<?php endfor; ?>
		</select>
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Create Exam</button>
		<a href="<?php echo e(url('exams')); ?>">
			<button class="btn fit-parent" style="margin-top: 10px;">Go Back</button>
		</a>
	</div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('partials-script'); ?>
<?php if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success')): ?>
<?php echo $__env->make('core.partials.notify-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('core.layout.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>