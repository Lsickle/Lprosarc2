<?php

use Illuminate\Database\Seeder;
use App\MovimientoActivo;

class MovimientoActivoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Movimiento = new MovimientoActivo();
        $Movimiento->MovTipo = "Asignado";
        $Movimiento->FK_ActPerson = "1";
        $Movimiento->FK_MovInv = "3";
        $Movimiento->save();

        $Movimiento = new MovimientoActivo();
        $Movimiento->MovTipo = "Entrada";
        $Movimiento->FK_ActPerson = "4";
        $Movimiento->FK_MovInv = "1";
        $Movimiento->save();

        $Movimiento = new MovimientoActivo();
        $Movimiento->MovTipo = "Salida";
        $Movimiento->FK_ActPerson = "2";
        $Movimiento->FK_MovInv = "5";
        $Movimiento->save();

        $Movimiento = new MovimientoActivo();
        $Movimiento->MovTipo = "Asignado";
        $Movimiento->FK_ActPerson = "5";
        $Movimiento->FK_MovInv = "4";
        $Movimiento->save();

        $Movimiento = new MovimientoActivo();
        $Movimiento->MovTipo = "Entrada";
        $Movimiento->FK_ActPerson = "3";
        $Movimiento->FK_MovInv = "2";
        $Movimiento->save();
    }
}
