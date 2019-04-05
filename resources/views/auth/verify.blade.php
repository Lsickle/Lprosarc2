@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifica tu correo electrónico</div>

                <div class="card-body">
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