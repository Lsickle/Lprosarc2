@section('main-content')
	{{-- {{$Km}} --}}
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('adminlte_lang::message.progvehiclist') }} - <b>Hoy y Mañana</b></h3>
                        @if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC) || in_array(Auth::user()->UsRol2, Permisos::TODOPROSARC))
                            <a href="/vehicle-programacion/create" class="btn btn-info pull-right"><i class="fas fa-calendar-alt"></i> {{ trans('adminlte_lang::message.progvehiccreatetext') }}</a>
                        @endif
                    </div>
                    <div class="box box-info">
                        <div class="box-body">
                            <table id="ProgVehicleTable" class="table table-compact table-bordered table-striped" data-order='[[ 1, "desc"]]'>
                                <thead>
                                    <tr>
                                        <th>{{ trans('adminlte_lang::message.progvehicclient') }}</th>
                                        <th>{{ trans('adminlte_lang::message.progvehicfech') }}</th>
                                        <th>{{ trans('adminlte_lang::message.progvehicvehic') }}</th>
                                        <th>{{ trans('adminlte_lang::message.progvehicsalida') }}</th>
                                        <th>{{ trans('adminlte_lang::message.progvehicayudan') }}</th>
                                        {{-- @if(Auth::user()->UsRol <> trans('adminlte_lang::message.Conductor') || Auth::user()->UsRol2 <> trans('adminlte_lang::message.Conductor')) --}}
                                        <th>{{ trans('adminlte_lang::message.progvehicconduc') }}</th>
                                        <th>Puntos de recolección</th>
                                        <th>{{ trans('adminlte_lang::message.progvehicllegada') }}</th>
                                        <th>{{ trans('adminlte_lang::message.progvehictype') }}</th>
                                        <th>Autorización</th>
                                        {{-- @endif --}}
                                        @if(in_array(Auth::user()->UsRol, Permisos::CONDUCTOR) || in_array(Auth::user()->UsRol2, Permisos::CONDUCTOR))
                                        <th>ver programación</th>
                                        @endif
                                        <th>{{ trans('adminlte_lang::message.progvehicservi2') }}</th>
                                        @if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2))
                                        <th>{{ trans('adminlte_lang::message.edit') }}</th>
                                        @endif
                                        @if(in_array(Auth::user()->UsRol, Permisos::SolSerCertifi) || in_array(Auth::user()->UsRol2, Permisos::SolSerCertifi))
                                        <th>{{ trans('adminlte_lang::message.progvehicserauth') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody id="readyTable">
                                    @foreach($programacions as $programacion)
                                    @php
                                        if($programacion->ProgVehtipo == 1){
                                            foreach($personals as $personal){
                                                if($programacion->FK_ProgAyudante == $personal->ID_Pers){
                                                    $ayudante = $personal->PersFirstName.' '.$personal->PersLastName;
                                                }
                                            }
                                            foreach($personals as $personal){
                                                if($programacion->FK_ProgConductor == $personal->ID_Pers){
                                                    $conductor = $personal->PersFirstName.' '.$personal->PersLastName;
                                                }
                                            }
                                            foreach ($vehiculos as $vehiculo) {
                                                if($programacion->FK_ProgVehiculo == $vehiculo->ID_Vehic){
                                                    $vehiculoPlaca = $vehiculo->VehicPlaca;
                                                }
                                            }
                                        }
                                        elseif($programacion->ProgVehtipo == 2){
                                            foreach($personals as $personal){
                                                if($programacion->FK_ProgAyudante == $personal->ID_Pers){
                                                    $ayudante = $personal->PersFirstName.' '.$personal->PersLastName;
                                                }
                                            }
                                            $conductor = 'No aplica';
                                            foreach ($vehiculos as $vehiculo) {
                                                if($programacion->FK_ProgVehiculo == $vehiculo->ID_Vehic){
                                                    $vehiculoPlaca = $vehiculo->VehicPlaca;
                                                }
                                            }
                                        }
                                        else{
                                            $ayudante = 'No aplica';
                                            $conductor = $programacion->SolSerConductor;
                                            $vehiculoPlaca = $programacion->SolSerVehiculo;
                                        }
                                    @endphp
                                    <tr style="{{$programacion->ProgVehDelete === 1 ? 'color: red' : ''}}">
                                        <td>{{$programacion->CliName}}</td>
                                        <td>{{$programacion->ProgVehFecha}}</td>
                                        <td>{{$vehiculoPlaca}}</td>
                                        <td>{{date('h:i A', strtotime($programacion->ProgVehSalida))}}</td>
                                        <td>{{$ayudante}}</td>
                                        {{-- @if(Auth::user()->UsRol <> trans('adminlte_lang::message.Conductor')) --}}
                                            <td>{{$conductor}}</td>
                                            <td><ul class="list-group">
                                                @foreach($programacion->puntosderecoleccion as $Punto)
                                                <li data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Dirección de los Puntos</b>" data-content="<p style='width: 50%'>
                                                    <ul class='list-group'>
                                                        <li class='list-group-item'><b>Generador:</b>{{$Punto->generadors->GenerName}}<br><b>Sede:</b>{{$Punto->GSedeName}}<br><b>Dirección:</b>{{$Punto->GSedeAddress}}<br><b>Cel:</b>{{$Punto->GSedeCelular}}</li>
                                                    </ul>
                                                    <br>Para mas detalles comuníquese con su <b>Jefe de Logistica</b> </p>" class="list-group-item">{{$Punto->GSedeName}}</li>
                                                @endforeach
                                            </ul></td>
                                            <td>{{$programacion->ProgVehEntrada <> null ? date('h:i A', strtotime($programacion->ProgVehEntrada)) : ''}}</td>
                                            <td>{{$programacion->ProgVehtipo == 1 ? 'Interno' : ($programacion->ProgVehtipo == 2 ? 'Alquilado': 'Externo')}}</td>
                                            <td>{{$programacion->ProgVehStatus}}</td>
                                        {{-- @endif --}}
                                        @if(in_array(Auth::user()->UsRol, Permisos::CONDUCTOR) || in_array(Auth::user()->UsRol2, Permisos::CONDUCTOR))
                                            <td><a method='get' href='/vehicle-programacion/{{$programacion->ID_ProgVeh}}' class='btn btn-info btn-block'><i class="fas fa-search"></i> <b>Datos</b></a></td>
                                        @endif
                                        <td><a href="/solicitud-servicio/{{$programacion->SolSerSlug}}"class='btn btn-info btn-block' title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i> #{{$programacion->ID_SolSer}}</a></td>
                                        @if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2))
                                            <td><a method='get' href='/vehicle-programacion/{{$programacion->ID_ProgVeh}}/edit' class='btn btn-warning btn-block'><i class="fas fa-edit"></i> <b>{{trans('adminlte_lang::message.edit')}}</b></a></td>
                                        @endif
                                        @if(in_array(Auth::user()->UsRol, Permisos::SolSerCertifi) || in_array(Auth::user()->UsRol2, Permisos::SolSerCertifi))
                                        <td><a href="/vehicle-programacion/{{$programacion->ID_ProgVeh}}/updateStatus" class='btn btn-success btn-block' title="{{ trans('adminlte_lang::message.progvehicserauth')}}"><i class="fas fa-sign-out-alt"></i></a></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
@endsection
@section('NewScript')
	
@endsection