<!-- Laravel App -->
<script type="text/javascript" src="{{ url (mix('/js/app.js')) }}"></script>
{{-- Dependencias Package.json --}}
<script type="text/javascript" src="{{ url (mix('/js/dependencias.js')) }}"></script>
{{-- script para quitar el loader --}}
<script type="text/javascript">
	window.onload =function(){
		$('#contenedor_carga').css('opacity', '0');
		$('#contenido').fadeIn(2000);
		setTimeout(function(){
			$('#contenedor_carga').remove();
		}, 2000);
	}
</script>

@yield('NewScript')