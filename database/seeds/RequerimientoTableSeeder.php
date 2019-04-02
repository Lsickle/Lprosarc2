<?php

use Illuminate\Database\Seeder;
use App\Requerimiento;

class RequerimientoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoCargue = "1"; 
        $Requerimiento->ReqFotoDescargue = NULL; 
        $Requerimiento->ReqFotoPesaje = NULL; 
        $Requerimiento->ReqFotoReempacado = NULL; 
        $Requerimiento->ReqFotoMezclado = NULL; 
        $Requerimiento->ReqFotoDestruccion = "1"; 
        $Requerimiento->ReqVideoCargue = NULL; 
        $Requerimiento->ReqVideoDescargue = NULL; 
        $Requerimiento->ReqVideoPesaje = NULL; 
        $Requerimiento->ReqVideoReempacado = NULL; 
        $Requerimiento->ReqVideoMezclado = NULL; 
        $Requerimiento->ReqVideoDestruccion = NULL; 
        $Requerimiento->ReqAuditoria = NULL; 
        $Requerimiento->ReqAuditoriaTipo = "Presencial"; 
        $Requerimiento->ReqDevolucion = NULL; 
        $Requerimiento->ReqDevolucionTipo = NULL; 
        $Requerimiento->ReqDatosPersonal = NULL; 
        $Requerimiento->ReqPlanillas = NULL; 
        $Requerimiento->ReqAlistamiento = "1"; 
        $Requerimiento->ReqCapacitacion = NULL; 
        $Requerimiento->ReqBascula = NULL; 
        $Requerimiento->ReqMasPerson = NULL; 
        $Requerimiento->ReqPlatform = "1"; 
        $Requerimiento->ReqCertiEspecial = "1"; 
        $Requerimiento->ReqSlug = "user01";
        $Requerimiento->FK_ReqRespel = "5";
<<<<<<< HEAD
        $Requerimiento->FK_ReqTrata = "5";
=======
        $Requerimiento->FK_ReqTarifa = "5";
>>>>>>> b28212de5c2584025665cf46d3e9b5206b7e1677
        $Requerimiento->save(); 

        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoCargue = "1"; 
        $Requerimiento->ReqFotoDescargue = "1"; 
        $Requerimiento->ReqFotoPesaje = "1"; 
        $Requerimiento->ReqFotoReempacado = "1"; 
        $Requerimiento->ReqFotoMezclado = "1"; 
        $Requerimiento->ReqFotoDestruccion = "1"; 
        $Requerimiento->ReqVideoCargue = "1"; 
        $Requerimiento->ReqVideoDescargue = "1"; 
        $Requerimiento->ReqVideoPesaje = "1"; 
        $Requerimiento->ReqVideoReempacado = "1"; 
        $Requerimiento->ReqVideoMezclado = "1"; 
        $Requerimiento->ReqVideoDestruccion = "1"; 
        $Requerimiento->ReqAuditoria = "1"; 
        $Requerimiento->ReqAuditoriaTipo = "Presencial"; 
        $Requerimiento->ReqDevolucion = "1"; 
        $Requerimiento->ReqDevolucionTipo = "1"; 
        $Requerimiento->ReqDatosPersonal = "1"; 
        $Requerimiento->ReqPlanillas = "1"; 
        $Requerimiento->ReqAlistamiento = "1"; 
        $Requerimiento->ReqCapacitacion = "1"; 
        $Requerimiento->ReqBascula = "1"; 
        $Requerimiento->ReqMasPerson = "1"; 
        $Requerimiento->ReqPlatform = "1"; 
        $Requerimiento->ReqCertiEspecial = "1"; 
        $Requerimiento->ReqSlug = "user02";
        $Requerimiento->FK_ReqRespel = "3";
<<<<<<< HEAD
        $Requerimiento->FK_ReqTrata = "4";
=======
        $Requerimiento->FK_ReqTarifa = "3";
>>>>>>> b28212de5c2584025665cf46d3e9b5206b7e1677
        $Requerimiento->save(); 

        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoCargue = NULL; 
        $Requerimiento->ReqFotoDescargue = NULL; 
        $Requerimiento->ReqFotoPesaje = NULL; 
        $Requerimiento->ReqFotoReempacado = NULL; 
        $Requerimiento->ReqFotoMezclado = NULL; 
        $Requerimiento->ReqFotoDestruccion = NULL; 
        $Requerimiento->ReqVideoCargue = NULL; 
        $Requerimiento->ReqVideoDescargue = NULL; 
        $Requerimiento->ReqVideoPesaje = NULL; 
        $Requerimiento->ReqVideoReempacado = NULL; 
        $Requerimiento->ReqVideoMezclado = NULL; 
        $Requerimiento->ReqVideoDestruccion = NULL; 
        $Requerimiento->ReqAuditoria = NULL; 
        $Requerimiento->ReqAuditoriaTipo = NULL; 
        $Requerimiento->ReqDevolucion = NULL; 
        $Requerimiento->ReqDevolucionTipo = NULL; 
        $Requerimiento->ReqDatosPersonal = NULL; 
        $Requerimiento->ReqPlanillas = NULL; 
        $Requerimiento->ReqAlistamiento = NULL; 
        $Requerimiento->ReqCapacitacion = NULL; 
        $Requerimiento->ReqBascula = NULL; 
        $Requerimiento->ReqMasPerson = NULL; 
        $Requerimiento->ReqPlatform = NULL; 
        $Requerimiento->ReqCertiEspecial = NULL; 
        $Requerimiento->ReqSlug = "user03";
        $Requerimiento->FK_ReqRespel = "1";
<<<<<<< HEAD
        $Requerimiento->FK_ReqTrata = "2";
=======
        $Requerimiento->FK_ReqTarifa = "1";
>>>>>>> b28212de5c2584025665cf46d3e9b5206b7e1677
        $Requerimiento->save(); 

        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoCargue = "1"; 
        $Requerimiento->ReqFotoDescargue = NULL; 
        $Requerimiento->ReqFotoPesaje = NULL; 
        $Requerimiento->ReqFotoReempacado = NULL; 
        $Requerimiento->ReqFotoMezclado = NULL; 
        $Requerimiento->ReqFotoDestruccion = "1"; 
        $Requerimiento->ReqVideoCargue = NULL; 
        $Requerimiento->ReqVideoDescargue = NULL; 
        $Requerimiento->ReqVideoPesaje = NULL; 
        $Requerimiento->ReqVideoReempacado = NULL; 
        $Requerimiento->ReqVideoMezclado = NULL; 
        $Requerimiento->ReqVideoDestruccion = NULL; 
        $Requerimiento->ReqAuditoria = NULL; 
        $Requerimiento->ReqAuditoriaTipo = "Virtual"; 
        $Requerimiento->ReqDevolucion = NULL; 
        $Requerimiento->ReqDevolucionTipo = NULL; 
        $Requerimiento->ReqDatosPersonal = NULL; 
        $Requerimiento->ReqPlanillas = NULL; 
        $Requerimiento->ReqAlistamiento = "1"; 
        $Requerimiento->ReqCapacitacion = "1"; 
        $Requerimiento->ReqBascula = "1"; 
        $Requerimiento->ReqMasPerson = "1"; 
        $Requerimiento->ReqPlatform = "1"; 
        $Requerimiento->ReqCertiEspecial = "1"; 
        $Requerimiento->ReqSlug = "user04";
        $Requerimiento->FK_ReqRespel = "2";
<<<<<<< HEAD
        $Requerimiento->FK_ReqTrata = "3";
=======
        $Requerimiento->FK_ReqTarifa = "2";
>>>>>>> b28212de5c2584025665cf46d3e9b5206b7e1677
        $Requerimiento->save(); 

        $Requerimiento = new Requerimiento();
        $Requerimiento->ReqFotoCargue = "1"; 
        $Requerimiento->ReqFotoDescargue = NULL; 
        $Requerimiento->ReqFotoPesaje = "1"; 
        $Requerimiento->ReqFotoReempacado = NULL; 
        $Requerimiento->ReqFotoMezclado = "1"; 
        $Requerimiento->ReqFotoDestruccion = NULL; 
        $Requerimiento->ReqVideoCargue = "1"; 
        $Requerimiento->ReqVideoDescargue = NULL; 
        $Requerimiento->ReqVideoPesaje = "1"; 
        $Requerimiento->ReqVideoReempacado = NULL; 
        $Requerimiento->ReqVideoMezclado = "1"; 
        $Requerimiento->ReqVideoDestruccion = NULL; 
        $Requerimiento->ReqAuditoria = "1"; 
        $Requerimiento->ReqAuditoriaTipo = NULL; 
        $Requerimiento->ReqDevolucion = "1"; 
        $Requerimiento->ReqDevolucionTipo = NULL; 
        $Requerimiento->ReqDatosPersonal = "1"; 
        $Requerimiento->ReqPlanillas = NULL; 
        $Requerimiento->ReqAlistamiento = "1"; 
        $Requerimiento->ReqCapacitacion = NULL; 
        $Requerimiento->ReqBascula = "1"; 
        $Requerimiento->ReqMasPerson = NULL; 
        $Requerimiento->ReqPlatform = "1"; 
        $Requerimiento->ReqCertiEspecial = NULL; 
        $Requerimiento->ReqSlug = "user05";
        $Requerimiento->FK_ReqRespel = "4";      
<<<<<<< HEAD
        $Requerimiento->FK_ReqTrata = "1";      
=======
        $Requerimiento->FK_ReqTarifa = "4";     
>>>>>>> b28212de5c2584025665cf46d3e9b5206b7e1677
        $Requerimiento->save(); 
    }
}
