<?php if(count($errors) > 0): ?>
<div class="notification" id="notify-chealth" data-timeout="5000">
	<div class="progress">
		<div class="determinate"></div>
	</div>
	<ol>
		<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<li><?php echo e($error); ?></li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ol>
</div>
<?php endif; ?>