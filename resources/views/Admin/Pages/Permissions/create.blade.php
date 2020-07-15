@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
<h1>Permissões <a href="{{route('permissions.create')}}" class="btn btn-success">Adicionar - <i class="fas fa-plus-circle    "></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item "><a href="{{route('permissions.index')}}">Permissões</a></li>
    <li class="breadcrumb-item active"><a href="{{route('permissions.create')}}">Criar</a></li>
</ol>
@stop
@section('content')
    @include('Admin.Includes.alerts')
    <form action="{{route('permissions.store')}}" method="post">
    @csrf
    @method('POST')
    @include('Admin.Pages.permissions._Partials.form')
    <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
@endsection