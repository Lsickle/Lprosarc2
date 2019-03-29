<div class="form-group">
	<label>Nombre</label>
	<input name="name" value="{{$user->name}}" type="text" class="form-control" placeholder="Nombre de usuario" required>
</div>
<div class="form-group">
	<label>Email</label>
	<input name="email" value="{{$user->email}}" type="text" class="form-control" placeholder="Correo electornico de usuario" required>
</div>

<div class="form-group">
	<label>Fecha de registro</label>
	<input name="created_at" value="{{$user->created_at}}" type="text" class="form-control" disabled>
</div>
<div class="form-group">
	<label>Ultima Actualizacion</label>
	<input name="updated_at" value="{{$user->updated_at}}" type="text" class="form-control" disabled>
</div>
<div class="form-group">
	<label>Tipo de usuario</label>
	<select name="UsType" value="{{$user->UsUsType}}" class="form-control" placeholder="usuario interno/externo de Prosarc S.A.">
		<option>Interno</option>
		<option>Externo</option>
	</select>
</div>

<div class="form-group">
	<label>Propietario</label>
	<select id="selectconfiltro"  name="FK_UserPers" class="form-control" placeholder="Persona a la cual esta asignado el Usuario">
		@foreach($personas as $persona)
			<option value="{{$persona->ID_Pers}}">{{$persona->PersFirstName}} {{$persona->PersSecondName}} {{$persona->PersLastName}} {{$persona->PersDocType}} {{$persona->PersDocNumber}}</option>
		@endforeach
	</select>
</div>

<div class="form-group">
	<label>Avatar</label>
	<input name="UsAvatar" value="{{$user->UsAvatar}}" type="file" class="form-control" style="padding: 0px;">
</div>