@extends('layouts.app')
@section('htmlheader_title')
	{{ trans('adminlte_lang::message.sclientsede') }}
@endsection
@section('contentheader_title')
	{{ trans('adminlte_lang::message.sclientsede') }}
@endsection	
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 col-xs-12">
		<!-- About Me Box -->
			<div class="box box-info">
				<div class="box-body box-profile">
					<h3 class="profile-username text-center">{{$Sede->SedeName}}</h3>
					@if (Auth::user()->UsRol === trans('adminlte_lang::message.Administrador'))
						<p class="text-muted text-center">{{$Cliente->CliShortname}}</p>
					@endif
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
                            <b>{{ trans('adminlte_lang::message.address') }}</b><button  class="btn btn-success SedeAddress">Copiar texto</button>
                            <a href="#" id="SedeAddress" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.address') }}" value="{{$Sede->SedeAddress}} - {{$Municipio->MunName}}, {{$Departamento->DepartName}}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Sede->SedeAddress}} - {{$Municipio->MunName}}, {{$Departamento->DepartName}}</p>">
                                {{$Sede->SedeAddress}} - {{$Municipio->MunName}}, {{$Departamento->DepartName}}
                            </a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.mobile') }}</b> <a class="pull-right">{{$Sede->SedeCelular}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.phone') }}</b> <a class="pull-right">{{$Sede->SedePhone1}} - {{$Sede->SedeExt1}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.phone') }} 2</b> <a class="pull-right">{{$Sede->SedePhone2}} - {{$Sede->SedeExt2}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.emailaddress') }}</b><button onclick="SedeEmail()" class="btn btn-success">Copiar texto</button><a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.emailaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Sede->SedeEmail}}</p>">{{$Sede->SedeEmail}}</a>
                        </li>
                    </ul>
                            <button class="copybtn">Copy</button>
				</div>
				<!-- /.box-body -->
			</div>
		<!-- /.tab-content -->
		</div>
		<!-- /.nav-tabs-custom -->
	</div>
	<!-- /.col -->
</div>
<script>
function copiarAlPortapapeles() {

// Crea un campo de texto "oculto"
var aux = document.createElement("input");

// Asigna el contenido del elemento especificado al valor del campo
aux.setAttribute("value", document.getElementById('SedeAddress').innerHTML);

// Añade el campo a la página
document.body.appendChild(aux);

// Selecciona el contenido del campo
aux.select();

// Copia el texto seleccionado
document.execCommand("copy");

// Elimina el campo de la página
document.body.removeChild(aux);

}
</script>
<script>
    var copyTextareaBtn = document.querySelector('.SedeAddress');
    
    copyTextareaBtn.addEventListener('click', function(event) {
        var copy_text = document.getElementById("SedeAddress");
        var range = document.createRange();
        range.selectNode(copy_text);
        window.getSelection().addRange(range);
    
        // try {
        // var successful = document.execCommand('copy');
        // var msg = successful ? 'successful' : 'unsuccessful';
        // console.log('Copying text command was ' + msg);
        // } catch (err) {
        // console.log('Oops, unable to copy');
        // }
    });
    </script>
@endsection