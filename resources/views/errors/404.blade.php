@extends('errors::illustrated-layout')
@section('code', '404')
@section('title', __('Pagina no encontrada'))
@section('image')
<div style="background-image: url({{ asset('/svg/404.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection
@if($exception->getMessage())
	@section('message', $exception->getMessage())
@else
	@section('message', trans('adminlte_lang::message.notfindpage'))
@endif
