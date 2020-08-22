@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
<h1>{{$role->name}}</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Regras</a></li>
    <li class="breadcrumb-item active"><a href="{{route('roles.show',$role->id)}}">{{$role->name}}</a></li>
</ol>
@stop

@section('content')
@include('Admin.Includes.alerts')

    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{$role->name}} </h5>
            </div>
            <p class="mb-1">Descrição:</p>
            <small>{{$role->description}}</small>
        </a>
    </div>
    <form action="{{route('roles.destroy',$role->id)}}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger mx-2 my-2">Deletar - <i class="fas fa-trash-alt"></i></button>
    </form>
@endsection