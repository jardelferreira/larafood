@extends('adminlte::page')

@section('title', 'Adicionar Permissões')

@section('content_header')
<h1>Permissões para {{$profile->name}}</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('profiles.index')}}">Perfis</a></li>
    <li class="breadcrumb-item "><a href="{{route('permissions.index')}}">Permissões</a></li>
    <li class="breadcrumb-item active"><a href="{{route('profiles.permissions.create',$profile->id)}}">Este perfil</a></li>
</ol>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('profiles.permissions.create',$profile->id)}}" method="POST" class="form form-inline">
            @csrf
            @method('POST')
            <input type="text" name="filter" value="{{$filters['filter'] ?? ''}}" placeholder="Pesquisar...">
            <button type="submit" class="btn btn-secondary"><i class="fas fa-search    "></i></button>
        </form>
        @if (isset($filters))
            <a href="{{route('permissions.index')}}" class="btn btn-success">Resetar</a>
        @endif
    </div>
    <div class="card-body">
    @include('Admin.Includes.alerts')
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <form action="{{route('profiles.permissions.store',$profile->id)}}" method="post">
                    @csrf
                    @method('POST')
                <tr>
                    <th><button type="submit" class="btn btn-success">Salvar</button></th>
                    <th>Nome</th>
                    <th>Descrição</th>
                </tr>
                </thead>
                <tbody>
                        @foreach ($permissions as $permission)     
                    <tr>
                        <td class="input-group"><div class="input-group-prepend">
                            <label class=" input-group-text">
                                <input class="ml-3" type="checkbox" name="permissions[]" value="{{$permission->id}}">
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
        {!! $permissions->appends($filters)->links() !!}
        @else
        {!! $permissions->links() !!}
        @endif
    </div>
</div>
@endsection