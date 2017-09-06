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
<form method="POST" action="<?php echo e(url('search-exams')); ?>">
	<div class="padded-full">
		<?php echo e(csrf_field()); ?>

		<input type="text" name="search" placeholder="Search Exams" autocomplete="off" required/>
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Search</button>
	</div>
</form>
<div class="padded-full">
	<a href="<?php echo e(url('create-exam')); ?>">
		<button class="btn fit-parent primary" style="margin-top: 10px;">Add New Exam</button>
	</a>	
</div>

<div class="padded-full">
	<ul class="list" style="padding: 20px 0px 20px 0px;">
		<li class="divider text-center"><p>All Exams</p></li>
	</ul>
</div>

<div class="padded-full">
	<ul class="list">
		<?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<li>
			<a class="padded-list" href="<?php echo e(url('view-exam', $exam->id)); ?>">
				<strong><?php echo e($exam->stream->abbr); ?></strong>, <?php echo e($exam->name); ?>, <?php echo e($exam->subject->abbr); ?>

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