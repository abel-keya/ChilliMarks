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

<form method="POST" action="<?php echo e(url('search-students')); ?>">
	<div class="padded-full">
		<?php echo e(csrf_field()); ?>

		<input type="text" name="search" placeholder="Search Students" autocomplete="off" autofocus/>
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Search</button>
	</div>
</form>
<div class="padded-full">
	<a href="<?php echo e(url('create-student')); ?>">
		<button class="btn fit-parent primary">Add New Student</button>
	</a>
	<a href="<?php echo e(url('student-bulk-actions')); ?>">
		<button class="btn fit-parent primary" style="margin-top: 10px;">Bulk actions</button>
	</a>	
</div>
<div class="padded-full">
	<ul class="list" style="padding: 20px 0px 20px 0px;">
		<li class="divider text-center"><p>All Students</p></li>
	</ul>
</div>
<div class="padded-full">
	<ul class="list">
		<?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li>
				<a href="<?php echo e(url('view-student', $student->id)); ?>">
					<?php $__currentLoopData = $student->streams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stream): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
						<strong><?php echo e($stream->abbr); ?>:</strong> 
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php echo e($student->name); ?> <?php echo e($student->class); ?> Adm. <?php echo e($student->admission->adm_no); ?> <?php if(count($student->kcpe)>0): ?> <?php echo e($student->kcpe->marks); ?> <?php endif; ?>
				</a>

			</li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('partials-script'); ?>
<?php if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success')): ?>
<?php echo $__env->make('core.partials.notify-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('core.layout.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>