<?php

use Illuminate\Database\Seeder;
use App\QrCode;

class QrCodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $QrCode = new QrCode();
        $QrCode->QrCodeEstiba = "2345";
        $QrCode->QrCodeSrc = "App\Qr-01";
        $QrCode->FK_QrCodeSolSer = "3";
        $QrCode->save();

        $QrCode = new QrCode();
        $QrCode->QrCodeEstiba = "456";
        $QrCode->QrCodeSrc = "App\Qr-02";
        $QrCode->FK_QrCodeSolSer = "5";
        $QrCode->save();

        $QrCode = new QrCode();
        $QrCode->QrCodeEstiba = "234567";
        $QrCode->QrCodeSrc = "App\Qr-03";
        $QrCode->FK_QrCodeSolSer = "2";
        $QrCode->save();

        $QrCode = new QrCode();
        $QrCode->QrCodeEstiba = "12345";
        $QrCode->QrCodeSrc = "App\Qr-04";
        $QrCode->FK_QrCodeSolSer = "1";
        $QrCode->save();

        $QrCode = new QrCode();
        $QrCode->QrCodeEstiba = "23456";
        $QrCode->QrCodeSrc = "App\Qr-05";
        $QrCode->FK_QrCodeSolSer = "4";
        $QrCode->save();
    }
}
