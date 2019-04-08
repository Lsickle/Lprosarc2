@extends('layouts.app')

@section('htmlheader_title','Verificación')
@section('contentheader_title','Verificación de Correo ELectrónico')

@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Verifica tu correo electrónico</h3>

                <div class="box-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Se ha enviado un nuevo enlace de verificación a su correo electrónico.
                        </div>
                    @endif

                    Antes de continuar, por favor, confirme su correo electrónico con el enlace de verificación que le fue enviado.
                    Si no ha recibido el correo electrónico, haga <a href="{{ route('verification.resend') }}">clic aquí</a> para solicitar otro.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection