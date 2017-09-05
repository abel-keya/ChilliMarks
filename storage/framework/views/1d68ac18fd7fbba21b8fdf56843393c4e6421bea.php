<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>>
    <head>
        <meta charset="utf-8" />
        <meta name="format-detection" content="telephone=no" />
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />
        <link rel="icon" href="<?php echo e(asset('chealth.ico')); ?>" type="image/x-icon" />

        <title>ChilliMarks - Using Data Science to foster learners' academic growth</title>

        <link rel="stylesheet" href="<?php echo e(asset('css/phonon.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('css/components/side-panels.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/components/forms.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/components/lists.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/theme.css')); ?>">

        <!-- scripts -->
        <script src="<?php echo e(asset('js/phonon.js')); ?>"></script>
        <script src="<?php echo e(asset('js/components/side-panels.js')); ?>"></script>
        <script src="<?php echo e(asset('js/components/forms.js')); ?>"></script>
        <script src="<?php echo e(asset('js/components/notifications.js')); ?>"></script>
    </head>
    <body>
        <?php if(Auth::check()): ?>
        <div class="side-panel side-panel-left" data-expose-aside="left" data-disable="right" data-page="home" id="side-panel-identifier">
            <header class="header-bar">
                <button class="btn pull-right icon icon-close show-for-phone-only" data-side-panel-close="true"></button>
                <div class="pull-left">
                    <h4 class="title">ChilliMarks Menu</h4>
                </div>
            </header>
            <div class="content">
                <ul class="list">
                    <?php if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')): ?>
                        <li><a class="padded-list" href="<?php echo e(url('exams')); ?>">Exams</a></li>
                        <li><a class="padded-list" href="<?php echo e(url('teachers')); ?>">Teachers</a></li>
                        <li><a class="padded-list" href="<?php echo e(url('students')); ?>">Students</a></li>
                        <li><a class="padded-list" href="<?php echo e(url('reports')); ?>">Reports</a></li>
                        <li><a class="padded-list" href="<?php echo e(url('messages')); ?>">Messaging</a></li>
                        <li><a class="padded-list" href="<?php echo e(url('settings')); ?>">Settings</a></li>      
                    <?php endif; ?>
                    <?php if(Auth::user()->hasRole('teacher')): ?>
                        <li><a class="padded-list" href="<?php echo e(url('teacher-assessments')); ?>">My Assessments</a></li>    
                    <?php endif; ?>
                    <li><a class="padded-list" href="<?php echo e(url('signout')); ?>">Sign Out</a></li>
                </ul>
            </div>
        </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('partials'); ?>

        <home data-page="true">
            <header class="header-bar">
                <?php if(Auth::check()): ?>
                    <button class="btn icon icon-menu pull-left show-for-phone-only" data-side-panel-id="side-panel-identifier"></button>
                <?php endif; ?>
                <div class="center">
                    <h1 class="title"><?php echo e(ucfirst($page)); ?></h1>
                </div>
            </header>
            <div class="content">
                <?php echo $__env->yieldContent('body'); ?>
            </div>
        </home>

        <!-- our app config -->
        <script src="<?php echo e(asset('js/app.js')); ?>"></script>
        <?php echo $__env->yieldContent('partials-script'); ?>
    </body>
</html>