<?php $__env->startSection('htmlheader_title','Asistencia'); ?>

<?php $__env->startSection('contentheader_title', 'Asistencia'); ?>

<?php $__env->startSection('main-content'); ?>
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-16 col-md-offset-0">
        <!-- /.box -->
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Asistencia del personal</h3>
            <h1><?php echo e(date('Y-m-d',strtotime(date('Y-m-d')."-1 days"))); ?></h1>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="AssistancesTable1" class="table table-compact table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Documento</th>
                  <th>Entrada</th>
                  <th>Salida</th>
                  <th>Revision</th>
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
                   <?php $__currentLoopData = $personal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $persona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $Llegada = 0; $Salida = 1;?>
                    <?php $__currentLoopData = $Asistencias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Asistencia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <?php if($persona->ID_Pers == $Asistencia->FK_AsisPers): ?>
                          <?php $Llegada = 1; $id=$Asistencia->ID_Asis; $Salida = 0;?>
                          <?php if($Asistencia->AsisSalida != null): ?>
                            <?php $Salida = 1; $Llegada = 1;?>
                          <?php endif; ?>
                       <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($Llegada."  ".$Salida."<br>"); ?>

                      <?php if($Llegada == 1 AND $Salida == 1): ?>
                      <?php else: ?>
                        <?php if($Llegada == 0 AND $Salida == 1): ?>
                            <tr>
                              <td><?php echo e($persona->PersFirstName." ".$persona->PersLastName); ?></td>
                              <td><?php echo e($persona->PersDocNumber); ?></td>
                              <td>
                                <form id="readyform" action="/asistencia" method="POST">
                                  <?php echo csrf_field(); ?>
                                  <input type="hidden"  value="<?php echo e($persona->ID_Pers); ?>" name='AsisPers'>
                                  <input type='submit' id='readyform' class='btn btn-block btn-success' value='Llego'>
                                </form>
                              </td>
                              <td>
                                <input type='submit' id='readyform' class='btn btn-block btn-success disabled' value='Salio'>
                              </td>
                              <td><?php echo e($Llegada.' Y '.$Salida); ?></td>
                            <tr>
                        <?php elseif($Llegada == 1 AND $Salida == 0): ?>
                            <tr>
                              <td><?php echo e($persona->PersFirstName." ".$persona->PersLastName); ?></td>
                              <td><?php echo e($persona->PersDocNumber); ?></td>
                              <td>
                                <input type='submit' id='readyform' class='btn btn-block btn-success disabled' value='Entro'>
                              </td>
                              <td>
                                <form id="readyform" action="/asistencia/<?php echo e($id); ?>" method="POST">
                                  <?php echo method_field('PUT'); ?>
                                  <?php echo csrf_field(); ?>
                                  <input type="hidden"  value="<?php echo e($id); ?>" name='AsisPers'>
                                  <input type='submit' id='readyform' class='btn btn-block btn-success' value='Sefue'>
                                </form>
                              </td>
                              <td><?php echo e($Llegada.' Y '.$Salida); ?></td>
                            </tr>
                        <?php endif; ?>
                      <?php endif; ?>
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