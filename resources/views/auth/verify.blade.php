@extends('layouts.app')

@section('htmlheader_title','Verificación')
@section('contentheader_title','Verificación de Correo ELectrónico')

@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box">
                <div class="box-header">
                        <h3 class="box-title">Verifica tu correo electrónico</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                Se ha enviado un nuevo enlace de verificación a su correo electrónico.
                            </div>
                            @endif
                            Por favor, verifique su Cuenta con el enlace que le fue enviado a su correo electrónico.
                            <br><br>
                            Si no ha recibido el correo electrónico:
                            <ul style="margin-left: 2rem;">
                                <li>Revise en su correo la carpeta de "Correo no Deseado" o "SPAM".</li>
                                <li>Revise que haya escrito correctamente su correo durante el registro.</li>
                                <li>Haga click en el botón para solicitar otro.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a class=" pull-left btn btn-primary" href="/profile/{{Auth::user()->UsSlug}}/edit">Editar Correo</a>
                    <a class=" pull-right btn btn-success" href="{{ route('verification.resend') }}">reenviar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection