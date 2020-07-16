@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
<h1>Permissões <a href="{{route('permissions.create')}}" class="btn btn-success">Adicionar - <i class="fas fa-plus-circle    "></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{route('permissions.index')}}">Permissões</a></li>
</ol>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('permissions.search')}}" method="POST" class="form form-inline">
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
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        
                    <tr>
                    <td scope="row">{{$permission->name}}</td>
                    <td>{{$permission->description}}</td>
                     <td>
                         <a href="{{route('permissions.show',$permission->id)}}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                         <a href="{{route('permissions.edit',$permission->id)}}" class="btn btn-info"><i class="fas fa-edit    "></i></a>
                         <a href="{{route('permissions.profiles',$permission->id)}}" class="btn btn-primary"><i class="fas fa-users    "></i></a>
                    </td>  
                    </tr>
                    @endforeach
                    
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