<?php $__env->startSection('htmlheader_title'); ?>
<?php echo e(trans('adminlte_lang::message.clientmenu')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de Contactos</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-compact table-bordered table-striped">
            <thead>
              <tr>
                <th>Categoria</th>
                <th>Nombre</th>
                <th>NIT</th>
                <th>Creado el</th>
                <th>Auditable</th>
                <th>Mas...</th>
                <th>Editar</th>
              </tr>
            </thead>
            <tbody  hidden onload="renderTable()" id="readyTable">
              
              <div class="fingerprint-spinner" id="loadingTable">
                <div class="spinner-ring"><b style="font-size: 1.8rem;">L</b></div>
                <div class="spinner-ring"><b style="font-size: 1.8rem;">o</b></div>
                <div class="spinner-ring"><b style="font-size: 1.8rem;">a</b></div>
                <div class="spinner-ring"><b style="font-size: 1.8rem;">d</b></div>
                <div class="spinner-ring"><b style="font-size: 1.8rem;">i</b></div>
                <div class="spinner-ring"><b style="font-size: 1.8rem;">n</b></div>
                <div class="spinner-ring"><b style="font-size: 1.8rem;">g</b></div>
                <div class="spinner-ring"><b style="font-size: 1.8rem;">.</b></div>
                <div class="spinner-ring"><b style="font-size: 1.8rem;">.</b></div>
              </div>
              
              <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($cliente->CliCategoria); ?></td>
                <td><?php echo e($cliente->CliShortname); ?></td>
                <td><?php echo e($cliente->CliNit); ?></td>
                <td><?php echo e($cliente->created_at); ?></td>
                <?php if($cliente->CliAuditable==1): ?>
                <td>Si</td>
                <?php else: ?>
                <td>NO</td>
                <?php endif; ?>
                <td><?php echo e($cliente->CliSlug); ?></td>
                <td><?php echo e($cliente->CliSlug); ?></td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>