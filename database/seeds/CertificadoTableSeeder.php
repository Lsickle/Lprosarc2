<?php

use Illuminate\Database\Seeder;
use App\Certificado;

class CertificadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $certificados = new Certificado();
        $certificados->CertNumero = "0001";
        $certificados->CertiEspName = "Estibas";
        $certificados->CertiEspValue = "2667238";
        $certificados->CertObservacion = "Ninguna Observacion";
        $certificados->CertSrc = "app\certificado\certificado1.pdf";
        $certificados->CertAuthJo = "1";
        $certificados->CertAuthJl = "0";
        $certificados->CertAuthDp = "1";
        $certificados->CertAnexo = "app\certificado";
        $certificados->FK_CertSolser = "1";
        $certificados->save();

        $certificados = new Certificado();
        $certificados->CertNumero = "0456";
        $certificados->CertiEspName = "Gasolina";
        $certificados->CertiEspValue = "38732";
        $certificados->CertObservacion = "Precaucion";
        $certificados->CertSrc = "app\certificado\certificado2.pdf";
        $certificados->CertAuthJo = "0";
        $certificados->CertAuthJl = "1";
        $certificados->CertAuthDp = "1";
        $certificados->CertAnexo = "app\certificado";
        $certificados->FK_CertSolser = "4";
        $certificados->save();

        $certificados = new Certificado();
        $certificados->CertNumero = "9832";
        $certificados->CertiEspName = "Madera";
        $certificados->CertiEspValue = "49321";
        $certificados->CertObservacion = "N\A";
        $certificados->CertSrc = "app\certificado\certificado3.pdf";
        $certificados->CertAuthJo = "0";
        $certificados->CertAuthJl = "0";
        $certificados->CertAuthDp = "1";
        $certificados->CertAnexo = "app\certificado";
        $certificados->FK_CertSolser = "2";
        $certificados->save();

        $certificados = new Certificado();
        $certificados->CertNumero = "3421";
        $certificados->CertiEspName = "Tecnologico";
        $certificados->CertiEspValue = "342545";
        $certificados->CertObservacion = "Ninguna Observacion";
        $certificados->CertSrc = "app\certificado\certificado4.pdf";
        $certificados->CertAuthJo = "0";
        $certificados->CertAuthJl = "0";
        $certificados->CertAuthDp = "0";
        $certificados->CertAnexo = "app\certificado";
        $certificados->FK_CertSolser = "3";
        $certificados->save();

        $certificados = new Certificado();
        $certificados->CertNumero = "2342";
        $certificados->CertiEspName = "Papel";
        $certificados->CertiEspValue = "21353";
        $certificados->CertObservacion = "Ninguna Observacion";
        $certificados->CertSrc = "app\certificado\certificado5.pdf";
        $certificados->CertAuthJo = "1";
        $certificados->CertAuthJl = "1";
        $certificados->CertAuthDp = "1";
        $certificados->CertAnexo = "app\certificado";
        $certificados->FK_CertSolser = "5";
        $certificados->save();
    }
}
