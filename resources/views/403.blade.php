@extends('layouts.app')

@section('title', 'No Tienes permisos para acceder a este sitio')
@section('color-style', 'bg-primary')
@section('content')

<div class="container">

	<div class="col-sm-10 text-center" align="left">
		<img src="{{ Storage::url('public/denied.png') }}" width="400" class="text-left">

		<a class="btn btn-outline-info" href="{{ URL::previous() }}"><i class="ti-back-left"></i> Regresar a la pagina anterior</a>

	</div>



</div>


@endsection
