<?php

use Illuminate\Database\Seeder;
use App\Horario;

class HorariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Horario = new Horario();
        $Horario->HorarioFecha = "2019-02-28 11:47:18";
        $Horario->Horariotipo = "Trabaja";
        $Horario->HorariotipoOther = "";
        $Horario->HorarioFeriado = "1";
        $Horario->HorarioEntrada = "2019-02-28 04:47:18";
        $Horario->HorarioSalida = "2019-02-28 17:47:18";
        $Horario->HoraPermisoInicio = "2019-01-28 17:47:18";
        $Horario->HoraPermisoFin = "2019-01-28 19:47:18";
        $Horario->FK_HoraPers = "3";
        $Horario->save();

        $Horario = new Horario();
        $Horario->HorarioFecha = "2019-02-28 11:47:18";
        $Horario->Horariotipo = "Descanza";
        $Horario->HorariotipoOther = "";
        $Horario->HorarioFeriado = "0";
        $Horario->HorarioEntrada = "2019-02-28 04:47:18";
        $Horario->HorarioSalida = "2019-02-28 17:47:18";
        $Horario->HoraPermisoInicio = "2019-01-28 17:47:18";
        $Horario->HoraPermisoFin = "2019-01-28 19:47:18";
        $Horario->FK_HoraPers = "1";
        $Horario->save();

        $Horario = new Horario();
        $Horario->HorarioFecha = "2019-02-28 11:47:18";
        $Horario->Horariotipo = "Capacitacion";
        $Horario->HorariotipoOther = "";
        $Horario->HorarioFeriado = "0";
        $Horario->HorarioEntrada = "2019-02-28 04:47:18";
        $Horario->HorarioSalida = "2019-02-28 17:47:18";
        $Horario->HoraPermisoInicio = "2019-01-28 17:47:18";
        $Horario->HoraPermisoFin = "2019-01-28 19:47:18";
        $Horario->FK_HoraPers = "2";
        $Horario->save();

        $Horario = new Horario();
        $Horario->HorarioFecha = "2019-02-28 11:47:18";
        $Horario->Horariotipo = "Examen";
        $Horario->HorariotipoOther = "";
        $Horario->HorarioFeriado = "1";
        $Horario->HorarioEntrada = "2019-02-28 04:47:18";
        $Horario->HorarioSalida = "2019-02-28 17:47:18";
        $Horario->HoraPermisoInicio = "2019-01-28 17:47:18";
        $Horario->HoraPermisoFin = "2019-01-28 19:47:18";
        $Horario->FK_HoraPers = "5";
        $Horario->save();

        $Horario = new Horario();
        $Horario->HorarioFecha = "2019-02-28 11:47:18";
        $Horario->Horariotipo = "Otro";
        $Horario->HorariotipoOther = "Fin";
        $Horario->HorarioFeriado = "1";
        $Horario->HorarioEntrada = "2019-02-20 04:47:18";
        $Horario->HorarioSalida = "2019-02-28 17:47:18";
        $Horario->HoraPermisoInicio = "2019-01-21 17:47:18";
        $Horario->HoraPermisoFin = "2019-01-22 19:47:18";
        $Horario->FK_HoraPers = "4";
        $Horario->save();
    }
}
