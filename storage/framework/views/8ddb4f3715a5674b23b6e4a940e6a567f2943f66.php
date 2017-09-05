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
        <li><strong>Exam Name:</strong> <?php echo e($exam->name); ?></li>
        <li><strong>Subject:</strong> <?php echo e($exam->subject->name); ?></li>
        <li><strong>Class:</strong> <?php echo e($exam->stream->name); ?></li>
        <li><strong>Period:</strong> <?php echo e($exam->period); ?>, <?php echo e($exam->year); ?></li>
    </ul>
</div>
<div class="padded-full">
    <ul class="list">
        <li class="divider text-center"><p>Assessments</p></li>
    </ul>
</div>
<div class="padded-full">
    <ul class="list">
        <?php $__currentLoopData = $assessments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assessment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><a href="<?php echo e(url('view-assessment', $assessment->id)); ?>"> <strong><?php echo e($assessment->name); ?>:</strong> Out of <?php echo e($assessment->out_of); ?> marks 
            (<?php echo e(number_format((float)$assessment->contribution,0, '.', '')); ?>%)</a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<div class="padded-full"> 

    <?php if($can_create_assessment): ?>
    <a href="<?php echo e(url('create-assessment', $exam->id)); ?>">
        <button class="btn fit-parent primary">Create Assessment</button>
    </a>
    <?php endif; ?>

    <a href="<?php echo e(url('edit-exam', $exam->id)); ?>">
        <button class="btn fit-parent primary" style="margin-top: 10px;">Edit Exam</button>
    </a>
    <a href="<?php echo e(url('confirm-exam', $exam->id)); ?>">
        <button class="btn fit-parent negative" style="margin-top: 10px;">Delete Exam</button>
    </a>
    <a href="<?php echo e(url('exams')); ?>">
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