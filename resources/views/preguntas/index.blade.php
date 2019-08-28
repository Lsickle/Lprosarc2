@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.frequent questions') }}
@endsection
@section('contentheader_title')
<div class="text-center" style="font-size:31px; margin-top: 20px; margin-bottom: -5px;">
    <span >{{ trans('adminlte_lang::message.frequent questions') }}</span>
</div>
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
                                        <span> ¿Qué significa el asterisco (<strong class="text-danger"> * </strong>) en los formularios?</span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="question1">
                                <div class="panel-body">
                                    <span>
                                        {{ trans('adminlte_lang::message.question-1-description') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info" >
                            <div class="panel-heading" role="tab" id="question2">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                        <span>{{ trans('adminlte_lang::message.question-2-title') }}</span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question2">
                                <div class="panel-body">
                                    <span>
                                        {{ trans('adminlte_lang::message.question-2-description') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info" >
                            <div class="panel-heading" role="tab" id="question3">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                        <span> ¿Qué significan <i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>?</span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question3">
                                <div class="panel-body">
                                    <span>
                                        El ícono <i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i> muestra información adicional ya sea en un formulario para llenar correctamente un campo o en un lugar del aplicativo para brindar más detalles.
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info" >
                            <div class="panel-heading" role="tab" id="question4">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                        <span> {{ trans('adminlte_lang::message.question-4-title') }}</span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question4">
                                <div class="panel-body">
                                    <span>
                                        {{ trans('adminlte_lang::message.question-4-description') }}
                                        <br><br><strong> NOTA: </strong>El botón solo funciona una vez así que le recomedamos que lo haga una vez haya colocado todos sus datos.
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info" >
                            <div class="panel-heading" role="tab" id="question5">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                        <span> {{ trans('adminlte_lang::message.question-5-title') }}</span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question5">
                                <div class="panel-body">
                                    <span>
                                        {{ trans('adminlte_lang::message.question-5-description') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info" >
                            <div class="panel-heading" role="tab" id="question6">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                        <span> {{ trans('adminlte_lang::message.question-6-title') }}</span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question6">
                                <div class="panel-body">
                                    <span>
                                        {{ trans('adminlte_lang::message.question-6-description') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info" >
                            <div class="panel-heading" role="tab" id="question7">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                        <span> {{ trans('adminlte_lang::message.question-7-title') }} </span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question7">
                                <div class="panel-body">
                                    <span>
                                        {{ trans('adminlte_lang::message.question-7-description') }}
                                        <br><br><strong>NOTA: </strong>Si tiene alguna duda por favor comuniquese directamente con su Asesor Comercial 
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info" >
                            <div class="panel-heading" role="tab" id="question8">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                        <span>{{ trans('adminlte_lang::message.question-8-title') }}</span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question7">
                                <div class="panel-body">
                                    <span>
                                        {{ trans('adminlte_lang::message.question-8-description') }}
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