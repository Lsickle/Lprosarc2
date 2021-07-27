@extends('layouts.appinvitado')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.clientcliente') }}
@endsection
@section('contentheader_title')
{{ 'Registro Express' }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
                <div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.smartwizzardtitle') }}</h3>
				</div>
                <div class="box box-info">
                    <form role="form" action="/sendregisterexpress" method="POST" enctype="multipart/form-data" data-toggle="validator">
                        {{csrf_field()}}
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <p>{{$error}}</p>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="box-body" id="readyTable">
                            <div class="tab-pane" id="addRowWizz">
                                <div class="smartwizard">
                                    <ul>
                                        <li><a href="#step-1"><b>{{ trans('adminlte_lang::message.Paso 1') }}</b><br /><small>{{ trans('adminlte_lang::message.client') }}</small></a></li>
                                        <li><a href="#step-2"><b>{{ trans('adminlte_lang::message.Paso 2') }}</b><br /><small>{{ trans('adminlte_lang::message.clientpers') }}</small></a></li>
                                    </ul>
                                    <div class="row">
                                        <div id="step-1" class="tab-pane step-content">
                                            <div id="form-step-0" role="form" data-toggle="validator">
                                                <div class="col-md-6 form-group ">
                                                    <label for="ClienteInputNit">{{ trans('adminlte_lang::message.clientNIT') }}</label><small class="help-block with-errors">*</small>
                                                    <input type="text" name="CliNit" class="form-control nit" id="ClienteInputNit" data-minlength="13" data-maxlength="13" placeholder="{{ trans('adminlte_lang::message.clientNITplacehoder') }}" value="{{ old('CliNit') }}" required>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="ClienteInputRazon">{{ trans('adminlte_lang::message.clirazonsoc') }}</label><small class="help-block with-errors">*</small>
                                                    <input type="text" name="CliName" class="form-control" id="ClienteInputRazon"  maxlength="100" required value="{{ old('CliName') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="departamentoExpress">{{ trans('adminlte_lang::message.departamento') }}</label><small class="help-block with-errors">*</small>
                                                    <select class="form-control select" id="departamentoExpress" name="departamento" required data-dependent="FK_SedeMun">
                                                        <option value="">{{ trans('adminlte_lang::message.select') }}</option>
                                                        @foreach ($Departamentos as $Departamento)
                                                            <option value="{{$Departamento->ID_Depart}}" {{ old('departamento') == $Departamento->ID_Depart ? 'selected' : '' }}>{{$Departamento->DepartName}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="municipio">{{ trans('adminlte_lang::message.municipio') }}</label><a class="load"></a>
                                                    <small class="help-block with-errors">*</small>
                                                    <select class="form-control select" id="municipio" name="FK_SedeMun" required>
                                                        @if (isset($Municipios))
                                                            @foreach ($Municipios as $Municipio)
                                                                <option value="{{$Municipio->ID_Mun}}" {{ old('FK_SedeMun') == $Municipio->ID_Mun ? 'selected' : '' }}>{{$Municipio->MunName}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group" id="SedeMapLocalidadContainer" hidden>
                                                    <label for="SedeMapLocalidad">Localidad</label><small class="help-block with-errors">*</small>
                                                    <select class="form-control select" id="SedeMapLocalidad" name="SedeMapLocalidad" required>
                                                            <option value="">Seleccione...</option>
                                                            <option value="Engativá" {{ old('SedeMapLocalidad') == 'Engativá'? 'selected' : '' }}>Engativá</option>
                                                            <option value="Kennedy" {{ old('SedeMapLocalidad') == 'Kennedy'? 'selected' : '' }}>Kennedy</option>
                                                            <option value="Suba" {{ old('SedeMapLocalidad') == 'Suba'? 'selected' : '' }}>Suba</option>
                                                            <option value="Usaquén" {{ old('SedeMapLocalidad') == 'Usaquén'? 'selected' : '' }}>Usaquén</option>
                                                            <option value="Fontibón" {{ old('SedeMapLocalidad') == 'Fontibón'? 'selected' : '' }}>Fontibón</option>
                                                            <option value="Puente Aranda" {{ old('SedeMapLocalidad') == 'Puente Aranda'? 'selected' : '' }}>Puente Aranda</option>
                                                            <option value="Rafael Uribe Uribe" {{ old('SedeMapLocalidad') == 'Rafael Uribe Uribe'? 'selected' : '' }}>Rafael Uribe Uribe</option>
                                                            <option value="Antonio Nariño" {{ old('SedeMapLocalidad') == 'Antonio Nariño'? 'selected' : '' }}>Antonio Nariño</option>
                                                            <option value="Santa Fe" {{ old('SedeMapLocalidad') == 'Santa Fe'? 'selected' : '' }}>Santa Fe</option>
                                                            <option value="Chapinero" {{ old('SedeMapLocalidad') == 'Chapinero'? 'selected' : '' }}>Chapinero</option>
                                                            <option value="Teusaquillo" {{ old('SedeMapLocalidad') == 'Teusaquillo'? 'selected' : '' }}>Teusaquillo</option>
                                                            <option value="Tunjuelito" {{ old('SedeMapLocalidad') == 'Tunjuelito'? 'selected' : '' }}>Tunjuelito</option>
                                                            <option value="Barrios Unidos" {{ old('SedeMapLocalidad') == 'Barrios Unidos'? 'selected' : '' }}>Barrios Unidos</option>
                                                            <option value="San Cristóbal" {{ old('SedeMapLocalidad') == 'San Cristóbal'? 'selected' : '' }}>San Cristóbal</option>
                                                            <option value="Bosa" {{ old('SedeMapLocalidad') == 'Bosa'? 'selected' : '' }}>Bosa</option>
                                                            <option value="Usme" {{ old('SedeMapLocalidad') == 'Usme'? 'selected' : '' }}>Usme</option>
                                                            <option value="Ciudad Bolívar" {{ old('SedeMapLocalidad') == 'Ciudad Bolívar'? 'selected' : '' }}>Ciudad Bolívar</option>
                                                            <option value="Los Mártires" {{ old('SedeMapLocalidad') == 'Los Mártires'? 'selected' : '' }}>Los Mártires</option>
                                                            <option value="La Candelaria" {{ old('SedeMapLocalidad') == 'La Candelaria'? 'selected' : '' }}>La Candelaria</option>
                                                            <option value="Sumapaz" {{ old('SedeMapLocalidad') == 'Sumapaz'? 'selected' : '' }}>Sumapaz</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="sedeinputaddress">Dirección de certificación</label><small class="help-block with-errors">*</small>
                                                    <input type="text" class="form-control" id="sedeinputaddress" name="SedeAddress" placeholder="{{ trans('adminlte_lang::message.addressplaceholder') }}" minlength="5" maxlength="128" required value="{{ old('SedeAddress') }}">
                                                </div>
                                                <!-- search input box -->
                                                <div class="form-group col-md-6 " id="SedeMapAddressContainer">
                                                    <label for="sedeinputaddress">Dirección de recolección (Mapa)</label><small class="help-block with-errors">*</small>
                                                    <div class="input-group">
                                                        <input type="text" id="search_location" name="SedeMapAddressSearch" class="form-control" placeholder="Search location" value="{{ old('SedeMapAddressSearch') }}">
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-default get_map" type="submit">
                                                                <i class="fas fa-map-marker-alt"></i> Ubicar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- display google map -->
                                                <div id="geomap" style="width: 100%;height: 400px;" ></div>

                                                <!-- display selected location information -->
                                                <div class="col-md-12 form-group">
                                                    <label for="sedeinputaddress">Detalles de la dirección</label><small class="help-block with-errors">*</small>
                                                    <p>Dirección: <input type="text" class="form-control search_addr" id="SedeMapAddressResult" value="{{ old('SedeMapAddressResult') }}" name="SedeMapAddressResult"></p>
                                                    <p>Latitud: <input type="text" class="form-control search_latitude" id="SedeMapLat" value="{{ old('SedeMapLat') }}" name="SedeMapLat"></p>
                                                    <p>Longitud: <input type="text" class="form-control search_longitude" id="SedeMapLong" value="{{ old('SedeMapLong') }}" name="SedeMapLong"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-2">
                                            <div id="form-step-1" role="form" data-toggle="validator">
                                                <div class="col-md-9">
                                                    <h2>{{ trans('adminlte_lang::message.personaltitleh2') }}</h2>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="PersFirstName">{{'Nombre'}}</label><small class="help-block with-errors">*</small>
                                                    <input type="text" class="form-control nombres" id="PersFirstName" name="PersFirstName" maxlength="25" required value="{{ old('PersFirstName') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="PersLastName">{{'Apellidos'}}</label><small class="help-block with-errors">*</small>
                                                    <input type="text" class="form-control inputText" id="PersLastName" name="PersLastName" maxlength="64" required value="{{ old('PersLastName') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="CliComercial">Correo electrónico</label><small class="help-block with-errors">*</small>
                                                    <input type="email" class="form-control" id="PersEmail" name="PersEmail" maxlength="255" required value="{{ old('PersEmail') }}" placeholder="{{ trans('adminlte_lang::message.emailplaceholder') }}">

                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="PersCellphone">{{ trans('adminlte_lang::message.mobile') }}</label><small class="help-block with-errors">*</small>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">(+57)</span>
                                                        <input type="text" class="form-control mobile" id="PersCellphone" name="PersCellphone" placeholder="{{ trans('adminlte_lang::message.mobileplaceholder') }}" data-minlength="12"  maxlength="12" value="{{ old('PersCellphone') }}" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="sedeinputphone1">{{ trans('adminlte_lang::message.phone') }}</label><small class="help-block with-errors"></small>
                                                    <input type="text" class="form-control phone tel" id="sedeinputphone1" name="SedePhone1" placeholder="{{ trans('adminlte_lang::message.phoneplaceholder') }}" data-minlength="11" value="{{ old('SedePhone1') }}">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="CliComercial">Comercial Asignado</label><small class="help-block with-errors">*</small>
                                                    <select class="form-control select" id="CliComercial" name="CliComercial" required>
                                                        <option value="">{{ trans('adminlte_lang::message.select') }}</option>
                                                        @foreach ($comerciales as $comercial)
                                                        <option value="{{$comercial->ID_Pers}}" {{ old('CliComercial') == $comercial->ID_Pers ? 'selected' : '' }}>{{ $comercial->PersFirstName }} {{$comercial->PersSecondName}} {{$comercial->PersLastName}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-success pull-right">{{ trans('adminlte_lang::message.register') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('NewScript')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY', 'YOUR_API_KEY')}}"></script>
<script>
var geocoder;
var map;
var marker;

/*
 * Google Map with marker
 */
function initialize() {
    var initialLat = $('.search_latitude').val();
    var initialLong = $('.search_longitude').val();
    initialLat = initialLat?initialLat:4.6831679;
    initialLong = initialLong?initialLong:-74.2717208;

    var latlng = new google.maps.LatLng(initialLat, initialLong);
    var options = {
        zoom: 16,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("geomap"), options);

    geocoder = new google.maps.Geocoder();

    marker = new google.maps.Marker({
        map: map,
        draggable: true,
        position: latlng
    });

    google.maps.event.addListener(marker, "dragend", function () {
        var point = marker.getPosition();
        map.panTo(point);
        geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                marker.setPosition(results[0].geometry.location);
                $('.search_addr').val(results[0].formatted_address);
                $('.search_latitude').val(marker.getPosition().lat());
                $('.search_longitude').val(marker.getPosition().lng());
            }
        });
    });

}

$(document).ready(function () {
    //load google map
    initialize();

    /*
     * autocomplete location search
     */
    var PostCodeid = '#search_location';
    $(function () {
        $(PostCodeid).autocomplete({
            source: function (request, response) {
                geocoder.geocode({
                    'address': request.term
                }, function (results, status) {
                    response($.map(results, function (item) {
                        return {
                            label: item.formatted_address,
                            value: item.formatted_address,
                            lat: item.geometry.location.lat(),
                            lon: item.geometry.location.lng()
                        };
                    }));
                });
            },
            select: function (event, ui) {
                $('.search_addr').val(ui.item.value);
                $('.search_latitude').val(ui.item.lat);
                $('.search_longitude').val(ui.item.lon);
                var latlng = new google.maps.LatLng(ui.item.lat, ui.item.lon);
                marker.setPosition(latlng);
                initialize();
            }
        });
    });

    /*
     * Point location on google map
     */
    $('.get_map').click(function (e) {
        var address = $(PostCodeid).val();
        geocoder.geocode({'address': address}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                marker.setPosition(results[0].geometry.location);
                $('.search_addr').val(results[0].formatted_address);
                $('.search_latitude').val(marker.getPosition().lat());
                $('.search_longitude').val(marker.getPosition().lng());
            } else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        });
        e.preventDefault();
    });

    //Add listener to marker for reverse geocoding
    google.maps.event.addListener(marker, 'drag', function () {
        geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    $('.search_addr').val(results[0].formatted_address);
                    $('.search_latitude').val(marker.getPosition().lat());
                    $('.search_longitude').val(marker.getPosition().lng());
                }
            }
        });
    });
    infoWindow = new google.maps.InfoWindow();
    const locationButton = document.createElement("button");
    locationButton.textContent = "Ubicación actual";
    locationButton.classList.add("custom-map-control-button");
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
    locationButton.addEventListener("click", (event) => {
        event.preventDefault();
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
            const pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
            };
            infoWindow.setPosition(pos);
            infoWindow.setContent("Location found.");
            infoWindow.open(map);
            map.setCenter(pos);
            },
            () => {
            handleLocationError(true, infoWindow, map.getCenter());
            }
        );
        } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
        }
    });
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(
        browserHasGeolocation
        ? "Error: The Geolocation service failed."
        : "Error: Your browser doesn't support geolocation."
    );
    infoWindow.open(map);
    }

});
</script>
<script type="text/javascript">
    $(document).ready(function(){
		$("#departamentoExpress").change(function(e){
            id=$("#departamentoExpress").val();

			e.preventDefault();
			$.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
			});
			$.ajax({
				url: "{{url('/muni-depart')}}/"+id,
				method: 'GET',
				data:{},
				beforeSend: function(){
					$(".load").append('<i class="fas fa-sync-alt fa-spin"></i>');
					$("#municipio").prop('disabled', true);
				},
				success: function(res){
					$("#municipio").empty();
					var municipio = new Array();
					for(var i = res.length -1; i >= 0; i--){
						if ($.inArray(res[i].ID_Mun, municipio) < 0) {
							$("#municipio").append(`<option value="${res[i].ID_Mun}">${res[i].MunName}</option>`);
							municipio.push(res[i].ID_Mun);
						}
                    }
				},
				complete: function(){
					$(".load").empty();
                    $("#municipio").prop('disabled', false);
                    if (id == 6) {
                        $("#SedeMapLocalidadContainer").attr('hidden', false);
                        $("#SedeMapLocalidad").attr('required', true);
                        $("#SedeMapAddressContainer").removeClass('col-md-6');
                        $("#SedeMapAddressContainer").addClass('col-md-12');
                    }else{
                        $("#SedeMapLocalidadContainer").attr('hidden', true);
                        $("#SedeMapLocalidad").attr('required', false);
                        $("#SedeMapLocalidad").val('No Definida');
                        $("#SedeMapAddressContainer").removeClass('col-md-12');
                        $("#SedeMapAddressContainer").addClass('col-md-6');
                    }
                    $('form[data-toggle="validator"]').validator('update');
				}
			})
		});
	});
</script>
@endsection
