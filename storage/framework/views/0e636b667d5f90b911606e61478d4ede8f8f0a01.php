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
        <li><strong>Teacher:</strong> <?php echo e($assessment->teacher->name); ?></li>
        <li><strong>Period:</strong> <?php echo e($assessment->exam->period); ?>, <?php echo e($assessment->exam->year); ?></li>
        <li><strong>Out of:</strong> <?php echo e($assessment->out_of); ?> marks</li>
        <li><strong>Contribution:</strong> <?php echo e($assessment->contribution); ?> %</li>
    </ul>
</div>
<?php if($grades->count()>0): ?>
<div class="padded-full">
    <ul class="list">
        <li class="divider text-center"><p>Assessment Grades</p></li>
    </ul>
</div>
<div class="padded-full">
    <ul class="list">
        <?php $__currentLoopData = $grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>   
                <strong><?php echo e($grade->student->name); ?></strong> (Adm. No. <?php echo e($grade->student->admission->adm_no); ?>):
                    
                    <?php if($grade->status==0): ?>
                        <span style="color:green;">Pending</span>
                    <?php else: ?>
                        <?php echo e(number_format((float)$grade->marks, 0, '.', '')); ?> marks
                    <?php endif; ?>
                    <a href="<?php echo e(url('confirm-grade', $grade->id)); ?>" class="btn pull-right icon icon-close" style="margin:3px 3px 3px 3px;" title="Delete Grade"></a>
                    <a href="<?php echo e(url('edit-grade', $grade->id)); ?>" class="btn pull-right icon icon-edit" style="margin:3px 3px 3px 3px;" title="Edit Grade"></a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>
<div class="padded-full">
    <a href="<?php echo e(url('create-select-grades', $assessment->id)); ?>">
        <button class="btn fit-parent primary">Create Grade</button>
    </a>
    <a href="<?php echo e(url('edit-assessment', $assessment->id)); ?>">
        <button class="btn fit-parent primary" style="margin-top: 10px;">Edit Assessment</button>
    </a>
    <a href="<?php echo e(url('confirm-assessment', $assessment->id)); ?>">
        <button class="btn fit-parent negative" style="margin-top: 10px;">Delete Assessment</button>
    </a>
    <a href="<?php echo e(url('view-exam', $assessment->exam->id)); ?>">
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