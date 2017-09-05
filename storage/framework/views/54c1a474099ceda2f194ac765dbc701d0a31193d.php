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
			<?php if($school->school_type=='kenyan_primary'): ?>
				<li><a href="<?php echo e(url('stream-reports')); ?>">Stream Reports</a></li>
				<li><a href="<?php echo e(url('class-reports')); ?>">Class Reports</a></li>
				<li><a href="<?php echo e(url('report-forms')); ?>">Report Forms</a></li>
			<?php elseif($school->school_type=='kenyan_secondary'): ?>
				<li><a href="">Term Stream Reports</a></li>
				<li><a href="">Term Class Reports</a></li>
				<li><a href="">Exam Stream Reports</a></li>
				<li><a href="">Exam Class Reports</a></li>
				<li><a href="<?php echo e(url('secondary-report-forms')); ?>">Report Forms</a></li>
				<li><a href="">Overall Subject Analysis</a></li>
				<li><a href="">All Classes Analysis Term</a></li>
				<li><a href="">Stream Report Results</a></li>
				<li><a href="">Class Grade per subject distribution</a></li>
				<li><a href=""></a>Exam Grade Analysis</li>
				<li><a href="">All Subject Grade Analysis</a></li>
				<li><a href="<?php echo e(url('group-reports')); ?>">Group Reports</a></li>
			<?php endif; ?>
		</ul>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('partials-script'); ?>
	<?php if(Session::has('success')): ?>
		<?php echo $__env->make('core.partials.notify-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('core.layout.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>