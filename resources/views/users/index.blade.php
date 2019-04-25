@extends('layouts.app')

@section('title', 'Lista de Usuarios')
@section('color-style', 'bg-success')
@section('content')
    <table id="tablaUsers" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th class="text-center"><i class="ti-image"></i></th>
            <th>Nombre</th>
            <th>Cargo</th>
            <th>E-mail</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id</th>
            <th class="text-center"><i class="ti-image"></i></th>
            <th>Nombre</th>
            <th>Cargo</th>
            <th>E-mail</th>
            <th>Acciones</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td><img width="60" src="{{ Storage::url($user->avatar) }}" alt=""></td>
                <td>{{$user->name}}</td>
                <td>{{$user->type}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <!--<a href="{ route('users.destroy', $user->id) }}"  data-toggle="tooltip" title="Eliminar Usuario" onclick="return confirm('¿Seguro quieres eliminar a este Usuario?')" class="btn btn-danger"><i class="ti-trash"></i></a>-->
                    <a href="{{ route('users.edit', $user->id) }}"  data-toggle="tooltip" title="Editar datos de usuario." class="btn btn-warning"><i class="ti-pencil text-white"></i></a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <script src="{{asset('js/scripts/auth.js')}}"></script>
    <script type="text/javascript">
        $('#tablaUsers').DataTable({
            "order": [[1, "asc"]]
        });
    </script>
@endsection
