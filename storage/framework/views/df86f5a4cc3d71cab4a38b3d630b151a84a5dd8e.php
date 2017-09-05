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
        <li><strong>Assessment:</strong> <?php echo e($assessment->exam->name); ?>, <?php echo e($assessment->name); ?></li>
        <li><strong>Subject:</strong> <?php echo e($assessment->exam->subject->name); ?></li>
        <li><strong>Period:</strong> <?php echo e($assessment->exam->period); ?>, <?php echo e($assessment->exam->year); ?></li>
    </ul>
</div>
<?php if($students->count()>0): ?>
<div class="padded-full">
    <ul class="list">
        <li class="divider text-center"><p><?php echo e($assessment->exam->stream->name); ?> Students</p></li>
    </ul>
</div>
<form method="POST" action="<?php echo e(url('create-select-grades', $assessment->id)); ?>">
    <?php echo e(csrf_field()); ?>

    <div class="padded-full">
        <ul class="list">
            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="padded-for-list">
                    <label class="checkbox">
                        <input type="checkbox" name="students[]" value="<?php echo e($student->id); ?>">
                        <?php echo e($student->name); ?> (Adm. No: <?php echo e($student->admission->adm_no); ?>)
                        <span></span>
                    </label>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <div class="padded-full">
        <button type="submit" class="btn fit-parent primary">Create Grades</button>
    </div>
</form>
<?php else: ?> 
    <div class="padded-full">
        <p class="text-center">All students in the <strong>Stream <?php echo e($assessment->exam->stream->name); ?></strong> have grade records for this assessment.</p>
    </div>
<?php endif; ?>
<div class="padded-full">
    <a href="<?php echo e(url('view-assessment', $assessment->id)); ?>">
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