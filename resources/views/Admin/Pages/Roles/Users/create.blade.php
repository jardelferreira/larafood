@extends('adminlte::page')

@section('title', 'Adicionar Usuários')

@section('content_header')
<h1>Usuários para {{$role->name}}</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Cargos</a></li>
    <li class="breadcrumb-item "><a href="{{route('users.index')}}">Usuários</a></li>
    <li class="breadcrumb-item active"><a href="{{route('users.roles.create',$role->id)}}">Este perfil</a></li>
</ol>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('users.roles.create',$role->id)}}" method="POST" class="form form-inline">
            @csrf
            @method('POST')
            <input type="text" name="filter" value="{{$filters['filter'] ?? ''}}" placeholder="Pesquisar...">
            <button type="submit" class="btn btn-secondary"><i class="fas fa-search    "></i></button>
        </form>
        @if (isset($filters))
            <a href="{{route('users.index')}}" class="btn btn-success">Resetar</a>
        @endif
    </div>
    <div class="card-body">
    @include('Admin.Includes.alerts')
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <form action="{{route('users.roles.store',$role->id)}}" method="post">
                    @csrf
                    @method('POST')
                <tr>
                    <th><button type="submit" class="btn btn-success">Salvar</button></th>
                    <th>Nome</th>
                    <th>Descrição</th>
                </tr>
                </thead>
                <tbody>
                        @foreach ($users as $permission)     
                    <tr>
                        <td class="input-group"><div class="input-group-prepend">
                            <label class=" input-group-text">
                                <input class="ml-3" type="checkbox" name="users[]" value="{{$permission->id}}">
                            </label>
                        </div></td>
                        <td scope="row">{{$permission->name}}</td>
                        <td>{{$permission->description}}</td>
                    </tr>
                    @endforeach
                    </form>
                    
                </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if(isset($filters))
        {!! $users->appends($filters)->links() !!}
        @else
        {!! $users->links() !!}
        @endif
    </div>
</div>
@endsection