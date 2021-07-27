@php
	use App\Personal;
	use App\Cliente;
	use App\Http\Controllers\userController;
	
	$cliente = Cliente::where('ID_Cli', userController::IDClienteSegunUsuario())->first();
@endphp
<!-- Main Header -->
<header class="main-header" style="height: 50px;">

	<!-- Logo -->
	<a href="{{ url('/home') }}" class="logo" style="height: 100%;">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><img src="/img/LogoProsarc.png" style="width: 60%; margin: 5px; border-radius: 50%;"></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>{{ trans('adminlte_lang::message.Appname') }}</b><img src="/img/LogoProsarc.png" style="width: 1.8em; margin: 5px; border-radius: 50%;"></span>
	</a>

	<!-- Header Navbar -->
	@switch(Route::currentRouteName())
		@case('programacion-express.index')
		@case('programacion-express.create')
		@case('programacion-express.show')
		@case('programacion-express.edit')
		@case('serviciosexpress.index')
		@case('serviciosexpress.create')
		@case('serviciosexpress.show')
		@case('serviciosexpress.edit')
		@case('respels.indexExpress')
		@case('clientes.clientesExpress')
		@php
			$navColor = 'background-image: linear-gradient(40deg, #367fa9, #00913a);';
		@endphp
			@break
		@default
		@php
			$navColor = 'background-image: linear-gradient(40deg, #367fa9, rgb(48, 63, 159));';
		@endphp
	@endswitch
	<nav id="topLogo" class="navbar navbar-static-top" role="navigation" style="height: 100%;{{$navColor}}">
		<!-- Sidebar toggle button-->
		<a href="#" class="fas fa-bars" data-toggle="push-menu" role="button" style="cursor: pointer; color: #ffffff; font-size: 20px; margin: 15px">
			
		</a>
		{{-- <a href="#" class="fa fa-bars" data-toggle="push-menu" role="button" style="cursor: pointer; font-size: 14px; box-sizing: border-box; padding: 15px 15px; overflow: visible; color:#FFFFFF; float: left;">
			<i class="fas fa-bars"></i>
		</a> --}}
		<!-- Navbar Right Menu -->
		<div class="navbar-custom-menu" style="height: 100%;">
			<ul class="nav navbar-nav" style="height: 100%;">
				<!-- Messages: style can be found in dropdown.less-->
				{{-- <li class="dropdown messages-menu">
					<!-- Menu toggle button -->
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-envelope"></i>
						<span class="label label-success">10    </span>
					</a>
					<ul class="dropdown-menu">
						<li class="header">{{ trans('adminlte_lang::message.tabmessages') }}</li>
						<li>
							<!-- inner menu: contains the messages -->
							<ul class="menu">
								<li><!-- start message -->
									<a href="#">
										<div class="pull-left">
											<!-- User Image -->
											<img src="../../../images/{{ Auth::user()->UsAvatar }}" class="img-circle" alt="User Image"/>
										</div>
										<!-- Message title and timestamp -->
										<h4>
											{{ trans('adminlte_lang::message.supteam') }}
											<small><i class="fa fa-clock"></i> 5 mins</small>
										</h4>
										<!-- The message -->
										<p>{{ trans('adminlte_lang::message.awesometheme') }}</p>
									</a>
								</li><!-- end message -->
							</ul><!-- /.menu -->
						</li>
						<li class="footer"><a href="#">c</a></li>
					</ul>
				</li> --}}<!-- /.messages-menu -->

				<!-- Notifications Menu -->
				{{-- <li class="dropdown notifications-menu">
					<!-- Menu toggle button -->
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-bell"></i>
						<span class="label label-warning">10</span>
					</a>
					<ul class="dropdown-menu">
						<li class="header">{{ trans('adminlte_lang::message.notifications') }}</li>
						<li>
							<!-- Inner Menu: contains the notifications -->
							<ul class="menu">
								<li><!-- start notification -->
									<a href="#">
										<i class="fa fa-users text-aqua"></i> {{ trans('adminlte_lang::message.newmembers') }}
									</a>
								</li><!-- end notification -->
							</ul>
						</li>
						<li class="footer"><a href="#">{{ trans('adminlte_lang::message.viewall') }}</a></li>
					</ul>
				</li> --}}
				<!-- Tasks Menu -->
				{{-- <li class="dropdown tasks-menu">
					<!-- Menu Toggle Button -->
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-flag"></i>
						<span class="label label-danger">9</span>
					</a>
					<ul class="dropdown-menu">
						<li class="header">{{ trans('adminlte_lang::message.tasks') }}</li>
						<li>
							<!-- Inner menu: contains the tasks -->
							<ul class="menu">
								<li><!-- Task item -->
									<a href="#">
										<!-- Task title and progress text -->
										<h3>
											{{ trans('adminlte_lang::message.tasks') }}
											<small class="pull-right">20%</small>
										</h3>
										<!-- The progress bar -->
										<div class="progress xs">
											<!-- Change the css width attribute to simulate progress -->
											<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
												<span class="sr-only">20% {{ trans('adminlte_lang::message.complete') }}</span>
											</div>
										</div>
									</a>
								</li><!-- end task item -->
							</ul>
						</li>
						<li class="footer">
							<a href="#">{{ trans('adminlte_lang::message.alltasks') }}</a>
						</li>
					</ul>
				</li> --}}
			   {{--  @if (Auth::guest())
					<li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
					<li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
				@else --}}
					
					<!-- User Account Menu -->
					@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) && isset(Auth::user()->FK_UserPers))
					<li class="dropdown" style="max-width: 280px; height: 100%; white-space: nowrap;">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="height: 100%;">
							<i class="fas fa-address-book" style="font-size: 1.5em"></i>
						</a>
						<div id="ContactComercial" class="dropdown-menu box box-solid box-info" style="padding-top: 0;">
							<div class="box-header with-border" style="text-align: center;">
								<p><b>Asesor Comercial</b></p>
							</div>
							<div class="box-body" style="white-space: normal;text-align: center;">
								@if($cliente->CliComercial <> null)
									@php
										$personal = Personal::where('ID_Pers', $cliente->CliComercial)->first();
										$nombre = $personal->PersFirstName.' '.$personal->PersLastName;
										$telefono = $personal->PersCellphone;
										$correo = $personal->PersEmail;
									@endphp
								<label>Nombre:</label><br>
								{{$nombre}}<br>
								<label>Telefono</label><br>
								{{$telefono}}<br>
								<label>Correó Electronico</label><a title="Copiar" onclick="copiarAlPortapapeles('correocomercial')"> <i class="far fa-copy"></i></a><br>
								<a id="correocomercial" href="mailto:{{$correo}}">{{$correo}}</a><br>
								@else
								<h4>en breve se le asignara un <b>Asesor Comercial</b> y podrá ver sus datos de contacto aqui</h4>
								@endif
							</div>
						</div>
					</li>
					@endif
					<li class="dropdown user user-menu" id="user_menu" style="max-width: 280px; height: 100%; white-space: nowrap;">
						<!-- Menu Toggle Button -->
						{{-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="max-width: 280px;white-space: nowrap;overflow: hidden;overflow-text: ellipsis; height: 100%;" title="{{ Auth::user()->name }}"> --}}
						<a href="/profile/{{Auth::user()->UsSlug}}" style="max-width: 280px;white-space: nowrap;overflow: hidden;overflow-text: ellipsis; height: 100%;" title="{{ Auth::user()->name }}">
							<!-- The user image in the navbar-->
							@if(file_exists(public_path().'/img/ImagesProfile/'.Auth::user()->UsAvatar) && Auth::user()->UsAvatar <> null)
								<img class="user-image" src="../../../img/ImagesProfile/{{Auth::user()->UsAvatar }}" alt="User Image">
							@else
								<img class="user-image" src="../../../img/robot400x400.gif" alt="User Image">
							@endif
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<span class="hidden-xs" data-toggle="tooltip">{{ Auth::user()->name }}</span>
						</a>

						{{-- <ul class="dropdown-menu" id="profilewindows">
							<!-- The user image in the menu -->
							<li class="user-header">
								@if(file_exists(public_path().'/img/ImagesProfile/'.Auth::user()->UsAvatar) && Auth::user()->UsAvatar <> null)
									<img class="img-circle" src="../../../img/ImagesProfile/{{Auth::user()->UsAvatar }}" alt="User Image">
								@else
									<img class="img-circle" src="../../../img/defaultuser.png" alt="User Image">
								@endif
								<p>
									<span data-toggle="tooltip" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</span>
									<small>{{ trans('adminlte_lang::message.login') }} Nov. 2012</small>
								</p>
							</li>
							<!-- Menu Body -->
							<li class="user-body">
								<div class="col-xs-4 text-center">
									<a href="#">{{ trans('adminlte_lang::message.followers') }}</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#">{{ trans('adminlte_lang::message.sales') }}</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#">{{ trans('adminlte_lang::message.friends') }}</a>
								</div>
							</li>
							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<a href="/profile/{{Auth::user()->UsSlug}}" class="btn btn-info" style="background-color: #5bc0de;">{{ trans('adminlte_lang::message.profile') }}</a>
								</div>
								<div class="pull-right">
									<a href="{{ url('/logout') }}" class="btn btn-danger" id="logout"
									   onclick="event.preventDefault();
												 document.getElementById('logout-form').submit();" style="background-color: #d9534f;">
										{{ trans('adminlte_lang::message.signout') }}
									</a>

									<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
										{{ csrf_field() }}
										<input type="submit" value="logout" style="display: none;">
									</form>

								</div>
							</li>
						</ul> --}}
					</li>
					<li style="height: 100%;">
						<a href="/preguntas-frecuentes" style="height: 100%;" title="Preguntas Frecuentes"><i class="fas x2 fa-question-circle" style="font-size: 1.5em"></i></a>
					</li>
					@if ((in_array(Auth::user()->UsRol, Permisos::TODOPROSARC) || in_array(Auth::user()->UsRol, Permisos::TODOPROSARC)))
					<li style="height: 100%;">
						<a href="{{ url('/solicitud-servicio') }}" style="height: 100%; font-size: 1.2em;" title="Servicios"><i style="color: #cbaeda; font-size: 1.2em;" class="fas fa-people-carry"></i><b> Servicios</b></a>
					</li>
					@endif
					
					<li style="height: 100%;">
						<a href="{{ url('/logout') }}" id="logout"
						   onclick="event.preventDefault();
									 document.getElementById('logout-form').submit();" style="height: 100%;" title="Salir">
							<i class="fas fa-sign-out-alt" style="font-size: 1.5em"></i>
						</a>

						<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
							<input type="submit" value="logout" style="display: none;">
						</form>
					</li>
					
				{{-- @endif --}}
				
				@if((in_array(Auth::user()->UsRol, Permisos::Jefes) || in_array(Auth::user()->UsRol, Permisos::Jefes)) || (Auth::user()->email == 'Sistemas@prosarc.com.co'||Auth::user()->email == 'Sistemas3@prosarc.com.co'||Auth::user()->email == 'Sistemas2@prosarc.com.co'))
				<!-- Control Sidebar Toggle Button -->
					<li>
						<a href="#" data-toggle="control-sidebar"><i class="fa fa-cogs"></i></a>
					</li>
				@endif
			</ul>
		</div>
	</nav>
</header>