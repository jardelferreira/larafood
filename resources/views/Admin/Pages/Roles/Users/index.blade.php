@extends('adminlte::page')

@section('title', 'Usuários do Cargo')

@section('content_header')
<h1>Usuários para {{$role->name}}<a href="{{route('roles.users.create',$role->id)}}" class=" ml-1 btn btn-success">Adicionar - <i class="fas fa-plus-circle    "></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Cargos</a></li>
    <li class="breadcrumb-item active"><a href="{{route('users.index')}}">Usuários</a></li>
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
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        
                    <tr>
                    <td scope="row">{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                     <td>
                         <a href="{{route('roles.users.destroy',[$role->id,$user->id])}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                    </td>  
                    </tr>
                    @endforeach
                    
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