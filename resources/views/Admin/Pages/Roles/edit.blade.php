@extends('adminlte::page')

@section('title', 'Regras')

@section('content_header')
<h1>Regras <a href="{{route('roles.create')}}" class="btn btn-success">Adicionar - <i class="fas fa-plus-circle    "></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item "><a href="{{route('roles.index')}}">Regras</a></li>
    <li class="breadcrumb-item active"><a href="{{route('roles.edit',$role->id)}}">Editar</a></li>
</ol>
@stop
@section('content')
    @include('Admin.Includes.alerts')
    <form action="{{route('roles.update',$role->id)}}" method="post">
    @csrf
    @method('PUT')
    @include('Admin.Pages.Roles._Partials.form')
    <button type="submit" class="btn btn-info">Salvar Alterações</button>
    </form>
@endsection