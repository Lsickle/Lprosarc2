<?php $__env->startSection('htmlheader_title','Personal'); ?>

<?php $__env->startSection('contentheader_title', 'Personal'); ?>

<?php $__env->startSection('main-content'); ?>
	<div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-16 col-md-offset-0">
        <!-- /.box -->
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Lista de personal</h3>
            <a href="personal/create" class="btn btn-primary" style="float: right;">Crear</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="PersonalsTable" class="table table-compact table-bordered table-striped">
              <thead>
                <tr>
                  <th>Doctype</th>
                  <th>Documento</th>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Telefono</th>
                  <th>Cargo</th>
                  <th>Ver más..</th>
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
                <?php $__currentLoopData = $Personals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Personal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($Personal->PersDocType); ?></td>
                  <td><?php echo e($Personal->PersDocNumber); ?></td>
                  <td><?php echo e($Personal->PersFirstName." ".$Personal->PersSecondName." ".$Personal->PersLastName); ?></td>
                  <td><?php echo e($Personal->PersEmail); ?></td>
                  <td><?php echo e($Personal->PersCellphone); ?></td>
                  <td><?php echo e($Personal->CargName); ?></td>
                  <td><?php echo e($Personal->PersSlug); ?></td>
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