@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
<h1>Empresas <a href="{{route('tenants.create')}}" class="btn btn-success">Adicionar - <i class="fas fa-plus-circle"></i></a></h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item "><a href="{{route('tenants.index')}}">Empresas</a></li>
    <li class="breadcrumb-item active"><a href="{{route('tenants.create')}}">Criar</a></li>
</ol>
@stop
@section('content')
    @include('Admin.Includes.alerts')
    <form action="{{route('tenants.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
      @include('Admin.Pages.Tenants._partials.form')
    <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
@endsection