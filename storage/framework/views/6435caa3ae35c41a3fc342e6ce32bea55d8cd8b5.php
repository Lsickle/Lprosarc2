<?php $__env->startSection('htmlheader_title'); ?>
    Register
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<body class="hold-transition register-page style="background-image:url(<?php echo e(url('resources/assets/img/registerbackground.jpg')); ?>)">
    <div id="app" v-cloak>
        <div class="register-box">
            <div class="register-logo">
                <a href="<?php echo e(url('/home')); ?>"><b>SiG</b>ReS</a>
            </div>

            <?php if(count($errors) > 0): ?>
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> <?php echo e(trans('adminlte_lang::message.someproblems')); ?><br><br>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="register-box-body">
                <p class="login-box-msg"><?php echo e(trans('adminlte_lang::message.registermember')); ?></p>

                <register-form></register-form>

                

                <a href="<?php echo e(url('/login')); ?>" class="btn btn-info btn-sm"><i class="fas fa-sign-in-alt"></i></a><a href="<?php echo e(url('/login')); ?>">¿Ya estas registrado?</a>
            </div><!-- /.form-box -->
        </div><!-- /.register-box -->
    </div>

    <?php echo $__env->make('adminlte::layouts.partials.scripts_auth', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('adminlte::auth.terms', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>