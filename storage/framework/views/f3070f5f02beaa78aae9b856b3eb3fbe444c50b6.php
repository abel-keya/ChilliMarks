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
<form method="POST" action="<?php echo e(url('update-grade', $grade->id)); ?>">
    <?php echo e(csrf_field()); ?>

    <div class="padded-full">
        <ul class="list">
            <li><strong>Name:</strong> <?php echo e($grade->student->name); ?>, (Adm. No:<?php echo e($grade->student->adm_no); ?>)</li>
            <li><strong>Out of:</strong> <?php echo e($grade->assessment->out_of); ?> marks</li>
        </ul>
    </div>
    <div class="padded-full">
        <h5 class="pull-right">marks</h5>
    </div>
    <div class="padded-full">
        <input type="text" name="marks" value="<?php echo e($grade->marks); ?>" autocomplete="off" placeholder="Enter Marks" autofocus>
    </div>
    <div class="padded-full">
        <button type="submit" class="btn fit-parent primary">Update Grade</button>
    </div>
</form>
<div class="padded-full">
    <a href="<?php echo e(url('view-assessment', $grade->assessment->id)); ?>">
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