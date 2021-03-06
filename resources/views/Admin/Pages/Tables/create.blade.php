@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
<h1>Mesas <a href="{{route('tables.create')}}" class="btn btn-success">Adicionar - <i class="fas fa-plus-circle"></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item "><a href="{{route('tables.index')}}">Mesas</a></li>
    <li class="breadcrumb-item active"><a href="{{route('tables.create')}}">Criar</a></li>
</ol>
@stop
@section('content')
    @include('Admin.Includes.alerts')
    <form action="{{route('tables.store')}}" method="post">
    @csrf
    @method('POST')
      @include('Admin.Pages.Tables._partials.form')
    <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
@endsection