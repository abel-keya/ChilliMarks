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
<form method="POST" action="<?php echo e(url('search-stream-reports')); ?>">
	<div class="padded-full">
		<?php echo e(csrf_field()); ?>

		<input type="text" name="search" placeholder="Search Steam Reports" autocomplete="off" autofocus/>
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Search</button>
	</div>
</form>
<div class="padded-full">
	<a href="<?php echo e(url('create-stream-report')); ?>">
		<button class="btn fit-parent primary" style="margin-top: 10px;">New Stream Report</button>
	</a>	
</div>
<div class="padded-full">
	<ul class="list">
		<li class="divider text-center"><p>All Stream Reports</p></li>
	</ul>
</div>
<div class="padded-full">
	<ul class="list">
		<?php $__currentLoopData = $streamreports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $streamreport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<li class="padded-list">
			<?php echo e($streamreport->name); ?> (<?php echo e($streamreport->exams->count()); ?> Exams)
			<a href="<?php echo e(url('confirm-stream-report', $streamreport->id)); ?>" class="btn pull-right icon icon-close" style="margin:3px 3px 3px 3px;" title="Delete Stream Report"></a>
            <a href="<?php echo e(url('edit-stream-report', $streamreport->id)); ?>" class="btn pull-right icon icon-edit" style="margin:3px 3px 3px 3px;" title="Edit Stream Report"></a>
            <a href="<?php echo e(url('view-stream-report', $streamreport->id)); ?>" class="btn pull-right icon icon-more-horiz" style="margin:3px 3px 3px 3px;" title="View Stream Report"></a>
            <a href="<?php echo e(url('download-stream-report', $streamreport->id)); ?>" class="btn pull-right icon icon-expand-more" style="margin:3px 3px 3px 3px;" title="Download Stream Report"></a>
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