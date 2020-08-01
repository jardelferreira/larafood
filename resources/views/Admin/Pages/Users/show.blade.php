@extends('adminlte::page')

@section('title', 'Usuário')

@section('content_header')
<h1>{{$user->name}}</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('users.index')}}">Usuário</a></li>
    <li class="breadcrumb-item active"><a href="{{route('users.show',$user->id)}}">{{$user->name}}</a></li>
</ol>
@stop

@section('content')
@include('Admin.Includes.alerts')

    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{$user->name}} </h5>
            </div>
            <p class="mb-1">Descrição:</p>
            <small>{{$user->email}}</small>
        </a>
    </div>
    <form action="{{route('users.destroy',$user->id)}}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger mx-2 my-2">Deletar - <i class="fas fa-trash-alt"></i></button>
    </form>
@endsection