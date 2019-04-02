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
        $Movimiento->MovTipo = "Asignar";
        $Movimiento->FK_ActPerson = "1";
        $Movimiento->FK_MovInv = "3";
        $Movimiento->MovActDelete = 0;
        $Movimiento->save();

        $Movimiento = new MovimientoActivo();
        $Movimiento->MovTipo = "Entrada";
        $Movimiento->FK_ActPerson = NULL;
        $Movimiento->FK_MovInv = "1";
        $Movimiento->MovActDelete = 0;
        $Movimiento->save();

        $Movimiento = new MovimientoActivo();
        $Movimiento->MovTipo = "Salida";
        $Movimiento->FK_ActPerson = NULL;
        $Movimiento->FK_MovInv = "5";
        $Movimiento->MovActDelete = 0;
        $Movimiento->save();

        $Movimiento = new MovimientoActivo();
        $Movimiento->MovTipo = "Asignar";
        $Movimiento->FK_ActPerson = "5";
        $Movimiento->FK_MovInv = "4";
        $Movimiento->MovActDelete = 0;
        $Movimiento->save();

        $Movimiento = new MovimientoActivo();
        $Movimiento->MovTipo = "Entrada";
        $Movimiento->FK_ActPerson = NULL;
        $Movimiento->FK_MovInv = "2";
        $Movimiento->MovActDelete = 0;
        $Movimiento->save();
    }
}
