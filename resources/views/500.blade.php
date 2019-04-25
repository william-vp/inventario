@extends('layouts.error')

@section('title', 'Pagina no encontrada')
@section('color-style', 'bg-primary')
@section('content')


	<div class="col-sm-10 text-center" align="left">
		<img src="{{ Storage::url('public/error500.png') }}" width="400" class="text-left">

		<a class="btn btn-outline-info" href="{{ URL::previous() }}"><i class="ti-back-left"></i> Regresar a la pagina anterior</a>

	</div>

@endsection
