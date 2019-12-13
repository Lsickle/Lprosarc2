<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Create the tabs -->
	<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
		<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
		{{-- <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li> --}}
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<!-- Home tab content -->
		<div class="tab-pane active" id="control-sidebar-home-tab">
			<h3 class="control-sidebar-heading">{{ trans('adminlte_lang::message.panel') }}</h3>
			<ul class='control-sidebar-menu'>
				@if (in_array(Auth::user()->UsRol, Permisos::Jefes) || in_array(Auth::user()->UsRol2, Permisos::Jefes))
					<li>
						<a href='/permisos'>
							<i class="menu-icon fa fa-users bg-green"></i>
							<div class="menu-info">
								<h4 class="control-sidebar-subheading">{{ trans('adminlte_lang::message.Menuuser') }} Internos</h4>
								<p>{{ trans('adminlte_lang::message.userdescription') }}</p>
							</div>
						</a>
					</li>
				@endif
			{{-- 	@if (in_array(Auth::user()->UsRol, Permisos::Jefes) || in_array(Auth::user()->UsRol2, Permisos::Jefes))
					<li>
						<a href='/UsuariosExternos'>
							<i class="menu-icon fa fa-users bg-red"></i>
							<div class="menu-info">
								<h4 class="control-sidebar-subheading">{{ trans('adminlte_lang::message.Menuuser') }} Externos</h4>
								<p>{{ trans('adminlte_lang::message.userdescription') }}</p>
							</div>
						</a>
					</li>
				@endif --}}
				@if (Auth::user()->email == 'Sistemas@prosarc.com.co'||Auth::user()->email == 'Sistemas3@prosarc.com.co'||Auth::user()->email == 'Sistemas2@prosarc.com.co')
					<li>
							<a href='#'>
								<i class="menu-icon fa fa-user-tag bg-blue"></i>
								<div class="menu-info">
									<h4 class="control-sidebar-subheading">Rol Express</h4>
									<p>Cambio de roles para programador</p>
								</div>
							</a>
						<form action="/changeRol/{{Auth::user()->UsSlug}}" style="margin: 1em;" method="POST">
							@csrf
							<label for="Rol1">Rol 1</label>
							<select id="Rol1" name="UsRol1">
								<option {{ (Auth::user()->UsRol === 'Programador' ? "selected" : "" )}} value="Programador">Programador</option>
								<option {{ (Auth::user()->UsRol === 'AdministradorPlanta' ? "selected" : "" )}} value="AdministradorPlanta">AdministradorPlanta</option>
								<option {{ (Auth::user()->UsRol === 'Hseq' ? "selected" : "" )}} value="Hseq">Hseq</option>
								<option {{ (Auth::user()->UsRol === 'JefeLogistica' ? "selected" : "" )}} value="JefeLogistica">JefeLogistica</option>
								<option {{ (Auth::user()->UsRol === 'AsistenteLogistica' ? "selected" : "" )}} value="AsistenteLogistica">AsistenteLogistica</option>
								<option {{ (Auth::user()->UsRol === 'Conductor' ? "selected" : "" )}} value="Conductor">Conductor</option>
								<option {{ (Auth::user()->UsRol === 'JefeOperaciones' ? "selected" : "" )}} value="JefeOperaciones">JefeOperaciones</option>
								<option {{ (Auth::user()->UsRol === 'Supervisor' ? "selected" : "" )}} value="Supervisor">Supervisor</option>
								<option {{ (Auth::user()->UsRol === 'AdministradorBogota' ? "selected" : "" )}} value="AdministradorBogota">AdministradorBogota</option>
								<option {{ (Auth::user()->UsRol === 'JefeComercial' ? "selected" : "" )}} value="JefeComercial">JefeComercial</option>
								<option {{ (Auth::user()->UsRol === 'Tesorería' ? "selected" : "" )}} value="Tesorería">Tesorería</option>
								<option {{ (Auth::user()->UsRol === 'Comercial' ? "selected" : "" )}} value="Comercial">Comercial</option>
								<option {{ (Auth::user()->UsRol === 'AsistenteComercial' ? "selected" : "" )}} value="AsistenteComercial">AsistenteComercial</option>
								<option {{ (Auth::user()->UsRol === 'Cliente' ? "selected" : "" )}} value="Cliente">Cliente</option>
							</select>
							<label for="Rol2">Rol 2</label>
							<select id="Rol2" name="UsRol2">
								<option {{ (Auth::user()->UsRol2 === 'Programador' ? "selected" : "" )}} value="Programador">Programador</option>
								<option {{ (Auth::user()->UsRol2 === 'AdministradorPlanta' ? "selected" : "" )}} value="AdministradorPlanta">AdministradorPlanta</option>
								<option {{ (Auth::user()->UsRol2 === 'Hseq' ? "selected" : "" )}} value="Hseq">Hseq</option>
								<option {{ (Auth::user()->UsRol2 === 'JefeLogistica' ? "selected" : "" )}} value="JefeLogistica">JefeLogistica</option>
								<option {{ (Auth::user()->UsRol2 === 'AsistenteLogistica' ? "selected" : "" )}} value="AsistenteLogistica">AsistenteLogistica</option>
								<option {{ (Auth::user()->UsRol2 === 'Conductor' ? "selected" : "" )}} value="Conductor">Conductor</option>
								<option {{ (Auth::user()->UsRol2 === 'JefeOperaciones' ? "selected" : "" )}} value="JefeOperaciones">JefeOperaciones</option>
								<option {{ (Auth::user()->UsRol2 === 'Supervisor' ? "selected" : "" )}} value="Supervisor">Supervisor</option>
								<option {{ (Auth::user()->UsRol2 === 'AdministradorBogota' ? "selected" : "" )}} value="AdministradorBogota">AdministradorBogota</option>
								<option {{ (Auth::user()->UsRol2 === 'JefeComercial' ? "selected" : "" )}} value="JefeComercial">JefeComercial</option>
								<option {{ (Auth::user()->UsRol2 === 'Tesorería' ? "selected" : "" )}} value="Tesorería">Tesorería</option>
								<option {{ (Auth::user()->UsRol2 === 'Comercial' ? "selected" : "" )}} value="Comercial">Comercial</option>
								<option {{ (Auth::user()->UsRol2 === 'AsistenteComercial' ? "selected" : "" )}} value="AsistenteComercial">AsistenteComercial</option>
								<option {{ (Auth::user()->UsRol2 === 'Cliente' ? "selected" : "" )}} value="Cliente">Cliente</option>
							</select>
							<button style="margin: 1em;" type="submit" class="btn btn-success pull-right">Update Rol</button>
						</form>
					</li>
				@endif
				{{-- <li>
				 @if (in_array(Auth::user()->UsRol, Permisos::PersInter1) || in_array(Auth::user()->UsRol2, Permisos::PersInter1))
					<li>
						<a href='/audits'>
							<i class="menu-icon fas fa-user-secret bg-green"></i>
							<div class="menu-info">
								<h4 class="control-sidebar-subheading">{{ trans('adminlte_lang::message.Menuaudit') }}</h4>
								<p>{{ trans('adminlte_lang::message.auditdescription') }}</p>
							</div>
						</a>
				@endif
					</li> --}}
			</ul>

			{{-- <h3 class="control-sidebar-heading">{{ trans('adminlte_lang::message.progress') }}</h3>
			<ul class='control-sidebar-menu'>
				<li>
					<a href='javascript::;'>
						<h4 class="control-sidebar-subheading">
							{{ trans('adminlte_lang::message.customtemplate') }}
							<span class="label label-danger pull-right">70%</span>
						</h4>
						<div class="progress progress-xxs">
							<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
						</div>
					</a>
				</li>
			</ul> --}}

		</div>
		{{-- Stats tab content
		<div class="tab-pane" id="control-sidebar-stats-tab">{{ trans('adminlte_lang::message.statstab') }}</div>
		Settings tab content
		<div class="tab-pane" id="control-sidebar-settings-tab">
			<form method="post">
				<h3 class="control-sidebar-heading">{{ trans('adminlte_lang::message.generalset') }}</h3>
				<div class="form-group">
					<label class="control-sidebar-subheading">
						{{ trans('adminlte_lang::message.reportpanel') }}
						<input type="checkbox" class="pull-right" {{ trans('adminlte_lang::message.checked') }} />
					</label>
					<p>
						{{ trans('adminlte_lang::message.informationsettings') }}
					</p>
				</div>
			</form>
		</div> --}}
	</div>
</aside>

<!-- Add the sidebar's background. This div must be placed
	   immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>