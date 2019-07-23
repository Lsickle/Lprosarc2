@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.frequent questions') }}
@endsection
@section('contentheader_title')
<h2 class="text-center">{{ trans('adminlte_lang::message.frequent questions') }}</h2>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-warning">
                <div class="box-body" id="readyTable">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="question1">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                        <span> Que significan el asterisco (<strong class="text-danger"> * </strong>) en los formularios </span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="question1">
                                <div class="panel-body">
                                    <span>
                                        Cada asterisco significa que el campo que lo tiene es de caracter obligatorio y no lo dejara avanzar hasta que lo complete. 
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info" >
                            <div class="panel-heading" role="tab" id="question2">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                        <span> ¿Porque no puedo asignar residuos a mi Generador?</span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question2">
                                <div class="panel-body">
                                    <span>
                                        Los residuos no se podran asignar hasta que hayan sido aprobados por Prosarc S.A ESP.
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info" >
                            <div class="panel-heading" role="tab" id="question3">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                        <span> ¿Que significan <i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>?</span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question3">
                                <div class="panel-body">
                                    <span>
                                        El icono <i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i> muestra informacion adicional ya sea en un formulario para llenar correctamente un campo o en un lugar del aplicativo para brindar información relevante.
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info" >
                            <div class="panel-heading" role="tab" id="question4">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                        <span> Soy un generador y no quiero ingresar de nuevo mis datos del registro. ¿Ay una forma de hacerlo mas facíl?</span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question4">
                                <div class="panel-body">
                                    <span>
                                        Al dar clic en "Lista de Generadores" aparece en la parte superior un boton que dice "Soy Generador", al pulsarlo todos los datos que usted lleno de su empresa al registrarse pasaran a ser como las de un nuevo generador, sin perder los de su empresa.
                                        <br><br><strong> NOTA: </strong>El boton solo funciona una vez así que le recomedamos que lo haga una vez haya colocado todos sus datos.
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info" >
                            <div class="panel-heading" role="tab" id="question5">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                        <span> Para que necesito ingresar datos de mi personal</span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question5">
                                <div class="panel-body">
                                    <span>
                                        En la solicitud de Servicio los va a requerir para que Prosarc S.A. ESP pueda contartar con la persona que le asigno y así saber el futuro de sus residuos.
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info" >
                            <div class="panel-heading" role="tab" id="question6">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                        <span> Porque no puede marcar los requerimientos de los reiduos</span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question6">
                                <div class="panel-body">
                                    <span>
                                        Los requerimientos los habilita Prosarc S.A. ESP dependiendo de los residuos que tenga. 
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info" >
                            <div class="panel-heading" role="tab" id="question7">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                        <span> Como puedo saber en que paso va mi Solicitud de Servicio sin tener que llamar a Prosarc S.A. ESP</span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question7">
                                <div class="panel-body">
                                    <span>
                                        Cada nuevo cambio que tenga su Solicitud de Servicio adentro de Prosarc S.A. ESP, se le notificara con un correo electrónico automatico.
                                        <br><br><strong>NOTA: </strong>Si tiene una duda por favor comunicarse con su acesor comercial y no reenviar un correo electronico porque no sera respondido. 
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info" >
                            <div class="panel-heading" role="tab" id="question8">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                        <span>Donde puedo ver las Fotos y/o videos que requerí en la Solicitud de Servicio</span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question7">
                                <div class="panel-body">
                                    <span>
                                        En la Solicitud de Sevicio en "Ver mas", luego llendo a la parte inferior donde aparecen los residuos y tras esto dar clic en "Ver Detalles" apareceran los datos de los residuos en la parte superior y en la parte inferior apareceran las fotos y/o videos una vez que el residuos haya sido tratado.     
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection