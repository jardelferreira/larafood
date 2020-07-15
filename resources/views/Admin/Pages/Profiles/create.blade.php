@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')
<h1>Perfis <a href="{{route('profiles.create')}}" class="btn btn-success">Adicionar - <i class="fas fa-plus-circle    "></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item "><a href="{{route('profiles.index')}}">Perfis</a></li>
    <li class="breadcrumb-item active"><a href="{{route('profiles.create')}}">Criar</a></li>
</ol>
@stop
@section('content')
    @include('Admin.Includes.alerts')
    <form action="{{route('profiles.store')}}" method="post">
    @csrf
    @method('POST')
    @include('Admin.Pages.Profiles._Partials.form')
    <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
@endsection