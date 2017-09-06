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
            <li><strong>Exam Name:</strong> <?php echo e($assessment->exam->name); ?>, <?php echo e($assessment->name); ?></li>
            <li><strong>Out of:</strong> <?php echo e($assessment->out_of); ?> marks</li>
            <li><strong>Exam Contribution:</strong> <?php echo e($assessment->contribution); ?>%</li>
            <li><strong>Teacher:</strong> <?php echo e($assessment->teacher->name); ?></li>
            <li><strong>Class:</strong> <?php echo e($assessment->exam->stream->name); ?></li>
            <li><strong>Period:</strong> <?php echo e($assessment->exam->period); ?>, <?php echo e($assessment->exam->year); ?></li>

            <?php if($assessment->status==1): ?> 
            <li><strong>Exam Mean:</strong> <?php echo e(round($grades->avg('marks'), 2)); ?> Marks</li>
            <?php endif; ?>
            <li>    
                <strong>Status:</strong>
                <?php if($assessment->status==1): ?> 
                    <span style="color:green;"> &#10003; Submitted</span> 
                <?php else: ?>   
                    <span style="color:blue;">&#x2715; Pending</span> 
                <?php endif; ?>
            </li>
        </ul>
    </div>

    <div class="padded-full">
        <ul class="list">
            <li class="divider text-center"><p>All Grades</p></li>
        </ul>
    </div>
    <?php if($assessment->status != 1): ?>
        <form method="POST" action="<?php echo e(url('submit-grades', $assessment->id)); ?>">
            <?php echo e(csrf_field()); ?>

            <?php $__currentLoopData = $grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="padded-full">
                    <h5><?php echo e($grade->student->name); ?></h5>
                </div>
                <div class="padded-full">
                    <input type="text" name="grades[]" value="<?php echo e(old('grades[]')); ?>" autocomplete="off" placeholder="Enter Marks Here..." autofocus>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="padded-full">
                <button type="submit" class="btn fit-parent primary">Submit Marks</button>
            </div>
        </form>
    <?php else: ?>
        <div class="padded-full">
            <ul class="list">
                <?php $__currentLoopData = $grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <strong><?php echo e(++$key); ?>) <?php echo e($grade->student->name); ?>:</strong> <?php echo e($grade->marks); ?> Marks
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="padded-full">
        <a href="<?php echo e(url('teacher-assessments')); ?>">
            <button class="btn fit-parent">Go Back</button>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('partials-script'); ?>
<?php if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success')): ?>
<?php echo $__env->make('core.partials.notify-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('core.layout.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>