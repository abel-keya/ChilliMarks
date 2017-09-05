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
		<li><strong>Teacher Name:</strong> <?php echo e($teacher->name); ?></li>
		<li><strong>Phone:</strong> <?php echo e($teacher->phone); ?></li>
		<li><strong>Year:</strong> <?php echo e($teacher->year); ?></li>
		<?php if($teacher->streams->count()>0): ?>
		<li>
			<strong>Streams:</strong> 
			<?php $__currentLoopData = $teacher->streams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stream): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php echo e($stream->name); ?><?php if($teacher->streams->count()>1): ?>. <?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
		</li>
		<?php endif; ?>

		<?php if($teacher->groups->count()>0): ?>
		<li>
			<strong>Groups:</strong> 
			<?php $__currentLoopData = $teacher->groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php echo e($group->name); ?><?php if($teacher->groups->count()>1): ?>. <?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
		</li>
		<?php endif; ?>

		<?php if($teacher->subjects->count()>0): ?>
		<li>
			<strong>Subjects:</strong> 
			<?php $__currentLoopData = $teacher->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php echo e($subject->name); ?><?php if($teacher->subjects->count()>1): ?>. <?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
		</li>
		<?php endif; ?>
	</ul>
</div>
<div class="padded-full">
	<a href="<?php echo e(url('edit-teacher', $teacher->id)); ?>">
		<button class="btn fit-parent primary">Edit Teacher</button>
	</a>
	<a href="<?php echo e(url('select-attach-stream', $teacher->id)); ?>">
		<button class="btn fit-parent primary" style="margin-top: 10px;">Assign Stream</button>
	</a>
	<a href="<?php echo e(url('select-detach-stream', $teacher->id)); ?>">
		<button class="btn fit-parent primary" style="margin-top: 10px;">Detach Stream</button>
	</a>
	<a href="<?php echo e(url('assign-subject-teacher', $teacher->id)); ?>">
		<button class="btn fit-parent primary" style="margin-top: 10px;">Assign Subject</button>
	</a>
	<a href="<?php echo e(url('detach-subject-teacher', $teacher->id)); ?>">
		<button class="btn fit-parent primary" style="margin-top: 10px;">Detach Subject</button>
	</a>
	<a href="<?php echo e(url('select-attach-group', $teacher->id)); ?>">
		<button class="btn fit-parent primary" style="margin-top: 10px;">Assign Group</button>
	</a>
	<a href="<?php echo e(url('select-detach-group', $teacher->id)); ?>">
		<button class="btn fit-parent primary" style="margin-top: 10px;">Detach Group</button>
	</a>
	<a href="<?php echo e(url('confirm-teacher', $teacher->id)); ?>">
		<button class="btn fit-parent negative" style="margin-top: 10px;">Delete Teacher</button>
	</a>
	<a href="<?php echo e(url('teachers')); ?>">
		<button class="btn fit-parent" style="margin-top: 10px;">Go Back</button>
	</a>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('partials-script'); ?>
<?php if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success')): ?>
<?php echo $__env->make('core.partials.notify-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('core.layout.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>